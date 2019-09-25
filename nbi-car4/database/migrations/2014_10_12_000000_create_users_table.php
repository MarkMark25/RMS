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
        Schema: Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            $table->increments('userid');
            $table->string('firstName', 50);
            $table->string('middleInitial', 5);
            $table->string('lastName', 50);
            $table->string('username', 50)->unique('username');
            //$table->string('email',50)->unique('email');
            //$table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->enum('role', ['Agent', 'Encoder', 'Administrator']);
            $table->enum('userStatus', ['Active', 'Inactive'])->default('Active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
