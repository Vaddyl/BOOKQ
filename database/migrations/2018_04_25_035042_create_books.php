<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooks extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('author');
            $table->string('title');
            $table->string('review');
            $table->integer('year');
            $table->string('publisher');
            $table->longText('description');
            $table->string('category');
            $table->string('tag');
            $table->string('image')->default('images/no-cover.jpeg');//uncomment kalo mau ada gambar
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     **  *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
