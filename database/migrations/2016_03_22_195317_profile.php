<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Profile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function(Blueprint $table){
            $table->increments('id');
            $table->string('avatar');
            $table->string('firstName');
            $table->string('lastName');
            $table->date('birthday')->format('d/m/Y');
            $table->enum('sex',['masc', 'fem']);
            $table->text('about');
            $table->integer('user_id')->unsigned()->default(0);
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
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
        //
    }
}
