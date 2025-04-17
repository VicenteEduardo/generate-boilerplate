<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        public function up()
        {
            Schema::create('configurations', function (Blueprint $table) {
                            $table->string('telefone', 255);
            $table->string('email', 255);
            $table->string('address', 255);
            $table->string('facebook', 255);
            $table->string('youtube', 255);
            $table->string('linkedin', 255);
            $table->timestamps();
            $table->softDeletes();
            });
        }

        public function down()
        {
            Schema::dropIfExists('configurations');
        }
    };
    