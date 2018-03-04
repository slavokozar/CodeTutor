<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->boolean('is_public')->default(false);

            $table->integer('author_id')->unsigned();

            $table->integer('series_id')->unsigned()->nullable();
            $table->integer('series_order')->unsigned()->nullable();

            $table->string('name');
            $table->string('description');
            $table->text('text');

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
        Schema::dropIfExists('articles');
    }
}
