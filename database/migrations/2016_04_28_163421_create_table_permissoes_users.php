<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePermissoesUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissoes.permissoes_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("permissao_id")->index()->unsigned()->foreign()->references('id')->on('permissoes.permissoes')->onDelete('cascade');
            $table->integer("user_id")->index()->unsigned()->foreign()->references('id')->on('user')->onDelete('cascade');
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
        Schema::dropIfExists('permissoes.permissoes_users');
    }
}
