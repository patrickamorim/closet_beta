<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValoresfixosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valoresfixos', function (Blueprint $table) {
            $table->increments('id')->default(1);
            $table->decimal('juros',5,2)->default(2);
            $table->smallinteger('mesesParaCobrar')->default(2);
            $table->smallinteger('fonte')->default(1);
            $table->decimal('comissao',5,2)->default(2);
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
        Schema::dropIfExists('valoresfixos');
    }
}
