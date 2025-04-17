<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        public function up()
        {
            Schema::create('users', function (Blueprint $table) {
                            $table->string('name', 255);
            $table->string('photo', 255);
            $table->string('email', 255);
            $table->string('status', 255);
            $table->string('level', 40);
            $table->timestamp('email_verified_at');
            $table->string('password', 255);
            $table->timestamps();
            $table->softDeletes();
            });
        }

        public function down()
        {
            Schema::dropIfExists('users');
        }
    };
    