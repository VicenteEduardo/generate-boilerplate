<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        public function up()
        {
            Schema::create('contacts', function (Blueprint $table) {
                            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('level');
            $table->string('REMOTE_ADDR', 255);
            $table->string('PATH_INFO', 255);
            $table->string('USER_NAME', 255);
            $table->string('USER_ID', 255);
            $table->timestamps();
            $table->softDeletes();
            });
        }

        public function down()
        {
            Schema::dropIfExists('contacts');
        }
    };
    