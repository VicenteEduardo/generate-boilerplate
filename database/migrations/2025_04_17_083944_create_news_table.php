<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        public function up()
        {
            Schema::create('news', function (Blueprint $table) {
                            $table->string('title');
            $table->string('state', 25);
            $table->string('typewriter', 255);
            $table->string('body');
            $table->date('date');
            $table->timestamps();
            $table->softDeletes();
            });
        }

        public function down()
        {
            Schema::dropIfExists('news');
        }
    };
    