<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataPsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_ps', function (Blueprint $table) {
            $table->increments('id');
            $table->date('datasP');
            $table->enum('situacao',['aberta','pago'])->default('aberta');
            $table->integer('mesesAtrasado')->default(0);
            $table->decimal('valorParcela',5,2);
            $table->integer('id_promissoria')->unsigned();
            $table->foreign('id_promissoria')->references('id')->on('promissorias')->onDelete('cascade');
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
        Schema::dropIfExists('data_ps');
    }
}
