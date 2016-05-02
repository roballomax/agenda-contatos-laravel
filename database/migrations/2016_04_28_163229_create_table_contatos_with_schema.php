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
            $table->string('telefone', 254);
            $table->string('email', 254)->nullable();
            $table->text("descricao")->nullable();
            $table->string('foto', 254)->nullable();
            $table->integer('categoria_id')->index()->unsigned()->foreign()->references('id')->on('categorias.categorias')->onDelete('set null')->nullable();
            $table->integer('subcategoria_id')->index()->unsigned()->foreign()->references('id')->on('categorias.subcategorias')->onDelete('set null')->nullable();
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
        Schema::dropIfExists('contatos.contatos');
    }
}
