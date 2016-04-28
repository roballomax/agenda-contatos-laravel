<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableContatosWithSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $sql = "CREATE SCHEMA IF NOT EXISTS contatos;";
        DB::connection()->getPdo()->exec($sql);

        Schema::create('contatos.contatos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 254);
            $table->string('email', 254);
            $table->text("descricao")->nullable();
            $table->string('foto', 11)->nullable();
            $table->integer('subcategoria_id')->index()->unsigned()->foreign()->references('id')->on('categorias.subcategorias');
            $table->integer('user_id')->index()->unsigned()->foreign()->references('id')->on('users');
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
        Schema::drop('contatos.contatos');
    }
}
