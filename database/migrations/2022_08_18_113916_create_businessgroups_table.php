<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessgroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businessgroups', function (Blueprint $table) {
            $table->id();

            $table->string('businessgroup_name')->nullable();
            $table->string('motto')->nullable();
            $table->string('logo')->nullable();
            $table->string('address')->nullable();
            $table->string('background')->nullable();
            $table->string('mode')->nullable();
            $table->string('color')->nullable();
            $table->foreignId('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('businessgroups');
    }
}
