<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('refeicao_id');
            $table->foreign('refeicao_id')->references('id')->on('refeicaos');

            $table->unsignedBigInteger('assistido_id');
            $table->foreign('assistido_id')->references('id')->on('users');
            
            $table->unsignedBigInteger('emissor_id');
            $table->foreign('emissor_id')->references('id')->on('users');

            $table->double('valor');

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
        Schema::drop('tickets');
    }
}
