<?php

use Illuminate\Support\Facades\Schema;
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
        
        Schema::create('users_level', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('fullname');
            $table->string('email');
            $table->integer('level_id')->unsigned();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('level_id')->references('id')->on('users_level')->onDelete('cascade');
        });

        Schema::create('log_login_users', function(Blueprint $table){
            $table->increments('id');
            $table->string('username');
            $table->string('ip');
            $table->timestamps();
        });

        Schema::create('category_posts', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('articles', function(Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->text('intro');
            $table->text('content');
            $table->string('posted_by');
            $table->string('modified_by');
            $table->integer('category_id')->unsigned();
            $table->boolean('is_active');
            $table->integer('dilihat_sebanyak');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('category_posts')->onDelete('cascade');
        });

        Schema::create('slider', function(Blueprint $table){
            $table->increments('id');
            $table->string('image');
            $table->string('caption');
            $table->string('posted_by');
            $table->string('modified_by');
            $table->boolean('is_active');
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
        Schema::drop('users_level');
        Schema::drop('users');
        Schema::drop('log_login_users');
        Schema::drop('category');
        Schema::drop('articles');
        Schema::drop('slider');
    }
}
