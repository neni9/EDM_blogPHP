<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pictures', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('post_id')->nullable();
            $table->string('name', 100)->nullable();
            $table->string('uri', 100);
            $table->string('mime', 100);
            $table->smallInteger('size');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('CASCADE');
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
        Schema::drop('pictures');
    }
}
