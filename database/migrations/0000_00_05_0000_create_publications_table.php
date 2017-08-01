<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreatePublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('image')->default('/images/publications/default_publication_pic.jpg');
            $table->date('finish_date');
            $table->string('content');
            $table->boolean('active')->default(true);
            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('cities')/*->onDelete('cascade')*/;
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')/*->onDelete('cascade')*/;
            $table->softDeletes();
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
        Schema::disableForeignKeyConstraints();
        Schema::drop('publications');
        Schema::enableForeignKeyConstraints();
    }
}
