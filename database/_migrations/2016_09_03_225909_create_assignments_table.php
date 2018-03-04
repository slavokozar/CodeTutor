<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->boolean('is_public')->default(false);

            $table->integer('author_id')->unsigned();
            $table->integer('group_id')->unsigned();

            $table->string('name');
            $table->text('description');
            $table->text('text');

            $table->timestamp('checked_at')->nullable();
            $table->timestamp('start_at');
            $table->timestamp('deadline_at');

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
        Schema::dropIfExists('assignments');
    }
}
