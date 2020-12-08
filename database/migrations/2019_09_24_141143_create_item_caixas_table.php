<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemCaixasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_caixas', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('valor',10,2);
            $table->string('tipoEpag', 25)->default('Troco');
            $table->integer('parcelas')->unsigned()->nullable();;
            $table->integer('numeroPecas')->unsigned()->nullable();
            $table->timestamp('time')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('vendedora',50)->nullable();
            $table->string('cliente',50)->nullable();
            $table->string('observacao',200)->nullable();
            $table->integer('id_caixa')->unsigned();
            $table->foreign("id_caixa")->references('id')->on('caixas')->onDelete('cascade');
            $table->integer('id_vendedora')->unsigned()->nullable(); //nullable até ajeitar o relatorio de vendedoras
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
        Schema::dropIfExists('item_caixas');
    }
}
