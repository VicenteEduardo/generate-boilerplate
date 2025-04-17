<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        public function up()
        {
            Schema::create('password_resets', function (Blueprint $table) {
                            $table->string('email', 255);
            $table->string('photo', 255);
            $table->string('name', 255);
            $table->string('phone', 255);
            $table->string('code', 255);
            $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('password_resets');
        }
    };
    