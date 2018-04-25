<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentSolutionScores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_solution_scores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('solution_id')->unsigned();

            $table->integer('task')->unsigned();
            $table->integer('test')->unsigned();

            $table->float('points')->unsigned();

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
        Schema::dropIfExists('assignment_solution_scores');
    }
}
