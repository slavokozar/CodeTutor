<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentSolutionFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_solution_files', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('solution_id');

            $table->string('dirname');
            $table->string('code');
            $table->string('filename');
            $table->string('ext');

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
        Schema::dropIfExists('assignment_solution_files');
    }
}
