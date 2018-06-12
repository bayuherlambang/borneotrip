<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Newstable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berita', function(Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->text('intro');
            $table->text('content');
            $table->string('posted_by');
            $table->string('modified_by');
            $table->integer('category_id')->unsigned();
            $table->boolean('is_active');
            $table->integer('dilihat_sebanyak');
            $table->timestamps();        });
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
