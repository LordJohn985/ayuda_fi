<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateCalificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('califications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')/*->onDelete('cascade')*/;
            $table->integer('publication_id')->unsigned();
            $table->foreign('publication_id')->references('id')->on('publications')/*->onDelete('cascade')*/;
            $table->integer('label_id')->unsigned()->default(1);
            $table->foreign('label_id')->references('id')->on('labels')/*->onDelete('cascade')*/;
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
        Schema::drop('califications');
        Schema::enableForeignKeyConstraints();
        
    }
    
}
