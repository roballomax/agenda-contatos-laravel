<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePermissoesWithSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = "CREATE SCHEMA IF NOT EXISTS permissoes";
        DB::connection()->getPdo()->exec($sql);

        Schema::create('permissoes.permissoes', function (Blueprint $table) {
            $table->increments('id');
            $table->string("nome", 254);
            $table->string("url", 254);
            $table->text("descricao")->nullable();
            $table->timestamps();
        });

        self::seta_permissoes_iniciais();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissoes.permissoes');
    }

    private function seta_permissoes_iniciais(){

        /*****************************************************/
        \App\Permissao::create([
            'nome' => 'Listar Categorias',
            'url' => 'categorias',
            'descricao' => 'Listar categorias'
        ]);

//        \App\Permissao::create([
//            'nome' => 'Acicionar Categorias',
//            'url' => 'categorias/add',
//            'descricao' => 'Adicionar categorias'
//        ]);
//
//        \App\Permissao::create([
//            'nome' => 'Acicionar Categorias',
//            'url' => 'categorias/add',
//            'descricao' => 'Adicionar categorias'
//        ]);


        /****************************************************/
        \App\Permissao::create([
            'nome' => 'Listar subcategorias',
            'url' => 'subcategorias/{categoria}',
            'descricao' => 'Listar subcategorias'
        ]);


        /**************************************************
        \App\Permissao::create([
            'nome' => 'Listar users',
            'url' => 'users',
            'descricao' => 'Listar Users'
        ]);
        */

        /**************************************************
        \App\Permissao::create([
            'nome' => 'Lista Permissoes',
            'url' => 'permissoes/{user}',
            'descricao' => 'Listar Permissões'
        ]);
        */

        /***************************************************/
        \App\Permissao::create([
            'nome' => 'Listar Contatos',
            'url' => 'contatos/todos',
            'descricao' => 'Listar Contatos'
        ]);



    }

}
