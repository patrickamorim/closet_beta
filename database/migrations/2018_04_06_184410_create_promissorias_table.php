<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromissoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promissorias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vendedora',50)->nullable();
            $table->date('data');
            $table->decimal('valor',10,2)->nullable();
            $table->decimal('desconto',10,2)->nullable();  //trabalhar isso depois
            $table->integer('promocao')->nullable(); //trabalhar isso depois
            $table->integer('numeroPecas')->unsigned()->default(0);
            $table->enum('status',['aberta','fechada'])->default('aberta');
            $table->smallinteger('parcelas');
            $table->integer('id_cliente')->unsigned();
            $table->integer('id_vendedora')->unsigned(); //nullable até ajeitar o relatorio de vendedoras
            $table->foreign('id_cliente')->references('id')->on('clientes');//->onDelete('cascade')
            $table->foreign('id_vendedora')->references('id')->on('vendedoras');//->onDelete('cascade')



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
        Schema::dropIfExists('promissorias');
    }
}
