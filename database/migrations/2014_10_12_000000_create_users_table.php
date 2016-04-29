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
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        \App\User::create([
            'name' => 'roballomax',
            'email' => 'roballomax@roballomax.com',
            'password' => bcrypt('roballomax')
        ]);

        \App\User::create([
            'name' => 'Maximiliano Roballo',
            'email' => 'maximilianoroballo@gmail.com',
            'password' => bcrypt('roballomax')
        ]);

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
}
