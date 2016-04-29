<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->integer('user_id')->index()->unsigned()->foreign()->references('id')->on('users')->nullable();
            $table->string('password');
            $table->boolean('adm')->default(true);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }

    private function valores_default(){
        \App\User::create([
            'name' => 'roballomax',
            'email' => 'roballomax@roballomax.com',
            'password' => bcrypt('roballomax')
        ]);

        \App\User::create([
            'name' => 'Maximiliano Roballo',
            'email' => 'maximilianoroballo@gmail.com',
            'password' => bcrypt('roballomax'),
            'user_id' => 1
        ]);
    }

}
