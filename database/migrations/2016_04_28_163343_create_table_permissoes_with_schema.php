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
}
