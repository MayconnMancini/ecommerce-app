<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendaItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venda_item', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('venda_id');
            $table->foreignUuid('produto_id');
            $table->integer('quantidade');
            $table->float('preco', 15, 2);
            $table->float('subtotal', 15, 2);
            $table->timestamps();

            $table->foreign('venda_id')->references('id')->on('vendas')->onDelete('cascade');
            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendas_item');
    }
}
