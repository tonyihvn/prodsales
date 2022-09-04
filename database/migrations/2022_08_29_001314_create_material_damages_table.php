<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialDamagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_damages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('material_id')->index();
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
            $table->string('batchno',30)->nullable();
            $table->string('invoiceno',30)->nullable();
            $table->string('reason',80)->nullable();
            $table->double('quantity',10,2)->nullable();
            $table->date('dated')->nullable();
            $table->unsignedBigInteger('damaged_by')->nullable();
            $table->foreign('damaged_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('setting_id')->index()->nullable();
            $table->foreign('setting_id')->references('id')->on('settings');
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
        Schema::dropIfExists('material_damages');
    }
}
