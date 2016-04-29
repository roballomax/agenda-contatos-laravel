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

        self::valores_default();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorias.categorias');
    }

    private function valores_default(){
        \App\Categoria::create([
            'nome' => 'Família',
            'descricao' => 'Integrantes da minha família.',
            'user_id' => 1
        ]);

        \App\Categoria::create([
            'nome' => 'Amigos',
            'descricao' => 'Amigos pessoais.',
            'user_id' => 1
        ]);

        \App\Categoria::create([
            'nome' => 'Trabalho',
            'descricao' => 'Pessoal do trabalho.',
            'user_id' => 1
        ]);
    }
}
