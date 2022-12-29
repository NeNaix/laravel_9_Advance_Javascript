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

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('c_id');
            $table->foreign('c_id')
                ->references('id')
                ->on('users')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            // $table->unsignedBigInteger('e_id');
            // $table->foreign('e_id')
            //     ->references('id')
            //     ->on('users')
            //     ->onUpdate('CASCADE')
            //     ->onDelete('CASCADE');
            $table->double('total_amount', 10, 2);
            $table->enum('status',['pending','completed'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('orderlines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('t_id')->index('transactions');
            $table->foreign('t_id')
                ->references('id')
                ->on('transactions')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table->unsignedBigInteger('g_id')->index('games');
            $table->int('qty');
            $table->double('total', 10, 2);
            $table->foreign('g_id')
                ->references('id')
                ->on('games')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
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
        Schema::dropIfExists('transactions');
    }
};
