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
            'url' => 'categorias/todos',
            'descricao' => 'Listar categorias'
        ]);

        \App\Permissao::create([
            'nome' => 'Cadastrar Categorias',
            'url' => 'categorias/add',
            'descricao' => 'Cadastrar categorias'
        ]);

        \App\Permissao::create([
            'nome' => 'Atualizar Categorias',
            'url' => 'categorias/{categoria}/edit',
            'descricao' => 'Atualizar categorias'
        ]);

        \App\Permissao::create([
            'nome' => 'Deletar Categorias',
            'url' => 'categorias/delete/{categoria}',
            'descricao' => 'Deletar categorias'
        ]);



        /****************************************************/
        \App\Permissao::create([
            'nome' => 'Listar subcategorias',
            'url' => 'subcategorias/todos',
            'descricao' => 'Listar subcategorias'
        ]);

        \App\Permissao::create([
            'nome' => 'Cadastrar subcategorias',
            'url' => 'subcategorias/add/{categoria}',
            'descricao' => 'Cadastrar subcategorias'
        ]);

        \App\Permissao::create([
            'nome' => 'Atualizar subcategorias',
            'url' => 'subcategorias/{subcategoria}/edit',
            'descricao' => 'Atualizar subcategorias'
        ]);

        \App\Permissao::create([
            'nome' => 'Deletar subcategorias',
            'url' => 'subcategorias/delete/{subcategoria}',
            'descricao' => 'Deletar subcategorias'
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

        \App\Permissao::create([
            'nome' => 'Vizualizar Contato',
            'url' => 'contatos/ver_contato/{contato}',
            'descricao' => 'Vizualizar Contato'
        ]);

        \App\Permissao::create([
            'nome' => 'Cadastrar Contato',
            'url' => 'contatos/add',
            'descricao' => 'Cadastrar Contato'
        ]);

        \App\Permissao::create([
            'nome' => 'Atualizar Contato',
            'url' => 'contatos/{contato}/edit',
            'descricao' => 'Atualizar Contato'
        ]);

        \App\Permissao::create([
            'nome' => 'Deletar Contato',
            'url' => 'contatos/delete/{contato}',
            'descricao' => 'Deletar Contato'
        ]);

        \App\Permissao::create([
            'nome' => 'Imagem Contato',
            'url' => 'contatos/imagem/{contato}',
            'descricao' => 'Cadastrar Imagem do Contato'
        ]);

//        \App\Permissao::create([
//            'nome' => 'Imagem Contato Cadastrar',
//            'url' => 'contatos/imagem/{contato}',
//            'descricao' => 'Cadastrar Imagem do Contato'
//        ]);
//
//        \App\Permissao::create([
//            'nome' => 'Imagem Contato Deletar',
//            'url' => 'contatos/imagem/{contato}/delete',
//            'descricao' => 'Deletar Imagem do Contato'
//        ]);



    }

}
