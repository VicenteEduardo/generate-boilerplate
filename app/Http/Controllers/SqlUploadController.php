<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SqlUploadController extends Controller
{
    public function index()
    {
        return view('upload-sql');
    }

    protected $ignoredTables = ['migrations', 'password_resets', 'sessions', 'failed_jobs'];


    public function process(Request $request)
    {
        $request->validate([
            'sql_file' => 'required|mimes:sql,txt',
        ]);

        $sqlContent = file_get_contents($request->file('sql_file')->getRealPath());

        preg_match_all('/CREATE TABLE `(.*?)`\s*\((.*?)\);/si', $sqlContent, $matches, PREG_SET_ORDER);

        foreach ($matches as $table) {
            $tableName = $table[1];

            // Ignorar tabelas padrão
            if (in_array($tableName, $this->ignoredTables)) {
                continue;
            }

            $columnsRaw = $table[2];

            // Remover arquivos anteriores
            $this->deleteGeneratedFiles($tableName);

            // Gerar migration, model, controller e rota
            $this->generateAll($tableName, $columnsRaw);
        }

        return redirect()->back()->with('create', '1');
    }


    protected function generateAll($tableName, $columnsRaw)
    {
        $migrationPath = $this->generateMigration($tableName, $columnsRaw);
        $this->generateModel($tableName);
        $this->generateRequestValidator($tableName, $columnsRaw); // Adicionado
        $this->generateController($tableName);
        $this->registerRoute($tableName);
    }

    protected function deleteGeneratedFiles($tableName)
    {
        $studlyName = Str::studly($tableName);

        File::delete(app_path("Models/{$studlyName}.php"));
        File::delete(app_path("Http/Controllers/{$studlyName}Controller.php"));

        foreach (File::files(database_path('migrations')) as $file) {
            if (str_contains($file->getFilename(), $tableName)) {
                File::delete($file->getPathname());
            }
        }
    }

    protected function generateMigration($tableName, $columnsRaw)
    {
        $columns = $this->parseColumns($columnsRaw);
        $className = 'Create' . Str::studly($tableName) . 'Table';
        $migrationName = date('Y_m_d_His') . '_create_' . $tableName . '_table.php';
        $filePath = database_path("migrations/$migrationName");

        // Remove a coluna 'id' da lista de colunas geradas, se presente
        $columns = array_filter($columns, function($column) {
            return !str_contains($column, 'id');
        });

        // Remove colunas duplicadas
        $columns = array_unique($columns);

        $content = "<?php

    use Illuminate\\Database\\Migrations\\Migration;
    use Illuminate\\Database\\Schema\\Blueprint;
    use Illuminate\\Support\\Facades\\Schema;

    return new class extends Migration {
        public function up()
        {
            Schema::create('$tableName', function (Blueprint \$table) {
                " . implode("\n", array_map(fn($line) => "            $line", $columns)) . "
            });
        }

        public function down()
        {
            Schema::dropIfExists('$tableName');
        }
    };
    ";
        file_put_contents($filePath, $content);
        return $filePath;
    }


    protected function generateModel($tableName)
    {
        $studlyName = Str::studly($tableName);
        Artisan::call('make:model', ['name' => $studlyName]);

        $modelPath = app_path("Models/$studlyName.php");
        $content = "<?php

namespace App\\Models;

use Illuminate\\Database\\Eloquent\\Factories\\HasFactory;
use Illuminate\\Database\\Eloquent\\Model;
use Illuminate\\Database\\Eloquent\\SoftDeletes;

class $studlyName extends Model
{
    use HasFactory, SoftDeletes;

    protected \$table = '$tableName';
    protected \$guarded = ['id'];
    protected \$dates = ['deleted_at'];
}
";
        file_put_contents($modelPath, $content);
    }


    protected function generateRequestValidator($tableName, $columnsRaw)
    {
        $studlyName = Str::studly($tableName);
        $requestName = "Store{$studlyName}Request";

        Artisan::call('make:request', ['name' => $requestName]);

        $fields = $this->extractFieldValidationRules($columnsRaw);

        $rulesContent = '';
        foreach ($fields as $field => $rule) {
            $rulesContent .= "\n            '$field' => '$rule',";
        }

        $requestPath = app_path("Http/Requests/{$requestName}.php");

        $content = file_get_contents($requestPath);
        $content = preg_replace('/public function rules\(\)\n    \{\n        return \[\];\n    \}/', "public function rules()\n    {\n        return [$rulesContent\n        ];\n    }", $content);

        file_put_contents($requestPath, $content);
    }





protected function extractFieldValidationRules($columnsRaw)
{
    $lines = preg_split('/,\s*(?![^()]*\))/', trim($columnsRaw));
    $rules = [];

    foreach ($lines as $line) {
        if (preg_match('/^`(.+?)`\s+([a-zA-Z]+)(\([0-9,]+\))?/', trim($line), $matches)) {
            $name = $matches[1];
            $type = strtolower($matches[2]);

            switch ($type) {
                case 'int':
                case 'tinyint':
                case 'integer':
                    $rules[$name] = 'required|integer';
                    break;
                case 'varchar':
                case 'char':
                    $rules[$name] = 'required|string|max:255';
                    break;
                case 'text':
                    $rules[$name] = 'required|string';
                    break;
                case 'decimal':
                    $rules[$name] = 'required|numeric';
                    break;
                case 'date':
                    $rules[$name] = 'required|date';
                    break;
                default:
                    $rules[$name] = 'required';
            }
        }
    }

    return $rules;
}

protected function generateController($tableName)
{
    $studlyName = Str::studly($tableName);
    $requestName = "Store{$studlyName}Request";
    $requestClass = "App\\Http\\Requests\\$requestName";

    Artisan::call('make:controller', [
        'name' => "{$studlyName}Controller",
        '--resource' => true
    ]);

    $controllerPath = app_path("Http/Controllers/{$studlyName}Controller.php");

    $content = "<?php

namespace App\\Http\\Controllers;

use App\\Models\\$studlyName;
use $requestClass;
use Illuminate\\Http\\Request;

class {$studlyName}Controller extends Controller
{
    public function index()
    {
        return response()->json($studlyName::all());
    }

    public function store($requestName \$request)
    {
        \$item = $studlyName::create(\$request->validated());
        return response()->json(\$item, 201);
    }

    public function show(\$id)
    {
        return response()->json($studlyName::findOrFail(\$id));
    }

    public function update($requestName \$request, \$id)
    {
        \$item = $studlyName::findOrFail(\$id);
        \$item->update(\$request->validated());
        return response()->json(\$item);
    }

    public function destroy(\$id)
    {
        $studlyName::destroy(\$id);
        return response()->json(null, 204);
    }
}
";

    // Substituir $requestName pelas classes reais
    $content = str_replace('$requestName', $requestName, $content);

    file_put_contents($controllerPath, $content);
}


    protected function registerRoute($tableName)
    {
        $studlyName = Str::studly($tableName);
        $routeLine = "Route::resource('" . Str::snake(Str::plural($tableName)) . "', App\\Http\\Controllers\\{$studlyName}Controller::class);";

        $routePath = base_path('routes/web.php');
        $content = file_get_contents($routePath);

        if (!str_contains($content, $routeLine)) {
            File::append($routePath, "\n$routeLine\n");
        }
    }

    protected function parseColumns($columnsRaw)
    {
        $lines = preg_split('/,\s*(?![^()]*\))/', trim($columnsRaw));
        $schemaLines = [];

        foreach ($lines as $line) {
            $line = trim($line);
            if (preg_match('/^(`(.+?)`)\s+([a-zA-Z]+)(\([0-9,]+\))?.*$/', $line, $matches)) {
                $name = $matches[2];
                $type = strtolower($matches[3]);
                $length = $matches[4] ?? null;

                switch ($type) {
                    case 'int':
                    case 'integer':
                        $schemaLines[] = "\$table->integer('$name');";
                        break;

                    case 'varchar':
                    case 'char':
                        $len = $length ? preg_replace('/[()]/', '', $length) : 255;
                        $schemaLines[] = "\$table->string('$name', $len);";
                        break;
                    case 'text':
                        $schemaLines[] = "\$table->text('$name');";
                        break;
                    case 'timestamp':
                        $schemaLines[] = "\$table->timestamp('$name');";
                        break;
                    case 'decimal':
                        $schemaLines[] = "\$table->decimal('$name', 8, 2);";
                        break;
                    case 'datetime':
                        $schemaLines[] = "\$table->dateTime('$name');";
                        break;
                    case 'date':
                        $schemaLines[] = "\$table->date('$name');";
                        break;
                    case 'boolean':
                    case 'tinyint':
                        $schemaLines[] = "\$table->boolean('$name');";
                        break;
                    default:
                        $schemaLines[] = "\$table->string('$name');";
                }
            }
        }

        if (str_contains($columnsRaw, 'created_at') && str_contains($columnsRaw, 'updated_at')) {
            $schemaLines[] = "\$table->timestamps();";
            $schemaLines[] = "\$table->softDeletes();";
        }

        return $schemaLines;
    }
}
