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
            $table->string('nome', 254);
            $table->integer('categoria_id')->index()->unsigned()->foreign()->references('id')->on('categorias.categorias')->onDelete('cascade');
            $table->integer('user_id')->index()->unsigned()->foreign()->references('id')->on('users')->onDelete('cascade');
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
