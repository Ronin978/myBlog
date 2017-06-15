<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Article extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('articles', function (Blueprint $table) 
        {
         $table->increments('id');
         $table->string('title');
         $table->text('content');
         $table->string('preview')->nullable();
         $table->string('category_id')->nullable();
         $table->timestamps();
         $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('articles');
    }
}
