<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJurosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juros', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data');
            $table->decimal('valor',10,2);
            $table->enum('situacao',['aberto','pago'])->default('aberto');
            $table->string('referencia',200);
            $table->integer('id_data_ps')->unsigned();
            $table->foreign("id_data_ps")->references('id')->on('data_ps')->onDelete('cascade');
            $table->integer('id_promissorias')->unsigned();
            $table->foreign("id_promissorias")->references('id')->on('promissorias')->onDelete('cascade');
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
        Schema::dropIfExists('juros');
    }
}
