<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('gender')->nullable();
            $table->string('dob')->nullable();
            $table->string('age_group')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->text('about')->nullable();
            $table->string('address')->nullable();
            $table->string('location')->nullable();
            $table->string('house_fellowship')->nullable();
            $table->string('invited_by')->nullable();
            $table->string('assigned_to')->nullable();
            $table->string('ministry')->nullable();
            $table->string('status')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('role')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
