<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {

            $table->increments('id');
            $table->string('cpf',11)->unique();
            $table->enum('situacao',['cancelada','apto'])->default('apto');
            $table->string('nome',50);
            $table->string('observacao',200)->nullable();
            $table->string('rg',10);
            $table->date('nascimento');
            $table->decimal('limite',10,2)->default(500);
            $table->string('rua',50);
            $table->string('cidade',30)->nullable();
            $table->string('bairro',15);
            $table->string('numero',9);
            $table->string('telefone',10)->nullable();
            $table->string('celular',11)->nullable();
            $table->string('email',50)->nullable();
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
        Schema::dropIfExists('clientes');
    }
}
