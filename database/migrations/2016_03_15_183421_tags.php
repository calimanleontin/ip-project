<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function(Blueprint $table){
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('companies_tags', function(Blueprint $table){
            $table->integer('companies_id')->unsigned()->index();
            $table->foreign('companies_id')
                ->references('id')
                ->on('companies')
                ->onDelete('cascade');
            $table->integer('tags_id')->unsigned()->index();
            $table->foreign('tags_id')
                ->references('id')
                ->on('tags')
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
        Schema::drop('companies_tags');
        Schema::drop('tags');
    }
}
