<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSubcategorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias.subcategorias', function (Blueprint $table) {
            $table->increments('id');
            $this->string('nome', 254);
            $table->integer('categoria_id')->index()->unsigned()->foreign()->references('id')->on('categorias.categorias');
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
        Schema::drop('categorias.subcategorias');
    }
}
