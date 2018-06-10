<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();

            $table->string('title')->nullable();
            $table->string('name');
            $table->string('surname');
            $table->string('email')->unique();

            $table->string('secondary_email')->nullable();
            $table->string('facebook_id')->nullable();

            $table->date('birthdate')->nullable();

            $table->string('role', 10)->nullable();

            $table->string('password')->nullable();
            $table->rememberToken();

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
        Schema::drop('users');
    }
}
