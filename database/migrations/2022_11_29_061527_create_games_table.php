<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->double('price', 10, 2);
            $table->string('description');

            $table->unsignedBigInteger('genre_id')->index('genres');
            $table->foreign('genre_id')
                ->references('id')
                ->on('genres')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table->string('img');
            $table->enum('platform',['console','PC','PC and console'])->default('console');
            $table->integer('stocks');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('games_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('g_id')->index('games');
            $table->foreign('g_id')
                ->references('id')
                ->on('games')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->unsignedBigInteger('c_id')->index('users');
            $table->foreign('c_id')
                ->references('id')
                ->on('users')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->integer('rating')->nullable();
            $table->string('comment',9999)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
};
