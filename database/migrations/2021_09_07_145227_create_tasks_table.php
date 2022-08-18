<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title',100);
            $table->date('date')->nullable();
            $table->string('category',50)->nullable();
            $table->text('activities')->nullable();
            $table->string('status',30)->nullable();
            $table->unsignedBigInteger('assigned_to')->index()->nullable();
            $table->string('assigned_to')->references('id')->on('users')->nullable();

            $table->string('member')->nullable();
            $table->unsignedBigInteger('setting_id')->index()->nullable();
            $table->foreignId('setting_id')->constrained('settings');
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
        Schema::dropIfExists('tasks');
    }
}
