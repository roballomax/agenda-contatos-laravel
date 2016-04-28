<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCategoriasWithSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = "CREATE SCHEMA IF NOT EXISTS categorias;";
        DB::connection()->getPdo()->exec($sql);

        Schema::create('categorias.categorias', function (Blueprint $table) {
            $table->increments('id');
            $table->string("nome", 254);
            $table->text('descricao')->nullable();
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
        Schema::drop('categorias.categorias');
    }
}
