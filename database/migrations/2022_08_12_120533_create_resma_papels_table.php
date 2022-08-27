<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResmaPapelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resma_papels', function (Blueprint $table) {
            $table->id();
            $table->String('nome');
            $table->String('setor');
            $table->String("quant_papel")->nullable();
            $table->String("status_solicitacao")->nullable();
            $table->dateTime('date_solicitacao_aberto')->nullable();
            $table->dateTime('date_solicitacao_fechado')->nullable();
            $table->foreignId('user_id')
            ->nullable()
            ->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resma_papels');
    }
}
