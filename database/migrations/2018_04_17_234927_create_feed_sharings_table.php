<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedSharingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feed_sharings', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('school_id')->unsigned()->nullable();
            $table->integer('group_id')->unsigned()->nullable();

            $table->string('object_type');
            $table->integer('object_id')->unsigned();

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
        Schema::dropIfExists('feed_sharings');
    }
}
