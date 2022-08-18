<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgrammesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programmes', function (Blueprint $table) {
            $table->id();
            $table->string('title',100)->nullable();
            $table->string('type',50)->nullable();
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->text('details')->nullable();
            $table->string('category',50)->nullable();
            $table->string('picture',50)->nullable();
            $table->string('ministry',50)->nullable();
            $table->unsignedBigInteger('setting_id')->index()->nullable();
            $table->foreignId('setting_id')->references('id')->on('settings');
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
        Schema::dropIfExists('programmes');
    }
}
