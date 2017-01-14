<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Campaigns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function(Blueprint $table){
            $table->increments('id');
            $table->text('title');
            $table->integer('company_id')->unsigned()->default(0);
            $table->foreign('company_id')
              ->references('id')
              ->on('companies')
              ->onDelete('cascade');
            $table->date('start');
            $table->date('end');
            $table->longText('winners');
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
        Schema::drop('campaigns');
    }
}
