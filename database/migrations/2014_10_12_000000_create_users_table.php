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
            $table->string('password', 60);
            $table->integer('voucher')->unsigned()->default(0);
            $table->enum('role',['user','admin'])->default('user');
            $table->rememberToken();
            $table->timestamps();
        });
        $user = new App\User;
        $user->name = 'admin';
        $user->email = 'admin@example.com';
        $user->role = 'admin';
        $user->password = Hash::make('password');
        $user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
