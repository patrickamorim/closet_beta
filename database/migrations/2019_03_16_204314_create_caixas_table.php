<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaixasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caixas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('obs',200)->nullable();
            $table->string('user',25);
            $table->decimal('dinheiro',10,2)->nullable();
            $table->decimal('cartao',10,2)->nullable();
            $table->decimal('outros',10,2)->nullable();
            $table->timestamp('abertura')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('fechamento')->nullable();
            $table->enum('status',['aberto','fechado','fechado com ressalvas'])->default('aberto');

          

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
        Schema::dropIfExists('caixas');
    }
}
