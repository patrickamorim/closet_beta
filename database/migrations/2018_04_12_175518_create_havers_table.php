<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHaversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('havers', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('valor',10,2);
            $table->enum('status',['HAVER','QUITAÇÃO'])->default('HAVER');
            $table->string('formaPag',25)->default('Dinheiro');
            $table->date('dataP');
            $table->timestamp('dataRecebido')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('id_promissoria')->unsigned();
            $table->foreign('id_promissoria')->references('id')->on('promissorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('havers');
    }
}
