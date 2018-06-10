<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentSolutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_solutions', function (Blueprint $table) {
            $table->increments('id');

            $table->string('code')->unique();

            $table->integer('user_id')->unsigned();
            $table->integer('assignment_id')->unsigned();


            $table->string('filename');
            $table->integer('lang_id')->unsigned()->nullable();


            $table->timestamp('scored_at')->nullable();
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
        Schema::dropIfExists('assignment_solutions');
    }
}
