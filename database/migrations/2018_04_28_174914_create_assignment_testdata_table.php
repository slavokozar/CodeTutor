<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentTestdataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_testdata', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('assignment_id');
            $table->unsignedSmallInteger('number');
            $table->boolean('public');

            $table->unsignedInteger('timeout');
            $table->string('description');

            $table->jsonb('data');

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
        Schema::dropIfExists('assignment_testdata');
    }
}
