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

        self::valores_default();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorias.subcategorias');
    }

    private function valores_default(){
        /*
        * Subcategorias para Família
        */

        \App\Subcategoria::create([
            'nome' => 'Irmãos',
            'categoria_id' => 1,
            'user_id' => 1
        ]);
        \App\Subcategoria::create([
            'nome' => 'Primos',
            'categoria_id' => 1,
            'user_id' => 1
        ]);
        \App\Subcategoria::create([
            'nome' => 'Tios',
            'categoria_id' => 1,
            'user_id' => 1
        ]);

        /*
         * Subcategorias para Amigos
         */
        \App\Subcategoria::create([
            'nome' => 'Faculdade',
            'categoria_id' => 2,
            'user_id' => 1
        ]);
        \App\Subcategoria::create([
            'nome' => 'Infância',
            'categoria_id' => 2,
            'user_id' => 1
        ]);
        \App\Subcategoria::create([
            'nome' => 'Conhecidos',
            'categoria_id' => 2,
            'user_id' => 1
        ]);

        /*
         * Sibcategorias para Trabalho
         */
        \App\Subcategoria::create([
            'nome' => 'Meu Setor',
            'categoria_id' => 3,
            'user_id' => 1
        ]);
        \App\Subcategoria::create([
            'nome' => 'Conhecidos',
            'categoria_id' => 3,
            'user_id' => 1
        ]);
        \App\Subcategoria::create([
            'nome' => 'Happy Hour',
            'categoria_id' => 3,
            'user_id' => 1
        ]);
    }

}
