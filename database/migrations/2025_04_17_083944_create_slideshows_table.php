<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        public function up()
        {
            Schema::create('slideshows', function (Blueprint $table) {
                            $table->string('path', 255);
            $table->string('title', 255);
            $table->string('description', 255);
            $table->string('link', 255);
            $table->string('name', 255);
            $table->timestamps();
            $table->softDeletes();
            });
        }

        public function down()
        {
            Schema::dropIfExists('slideshows');
        }
    };
    