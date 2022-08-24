<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('material_id')->index()->nullable();
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
            $table->double('quantity',10,2)->nullable();

            $table->unsignedBigInteger('added_by')->index()->nullable();
            $table->foreign('added_by')->references('id')->on('users')->onDelete('cascade');
            $table->string('facility_location',50)->nullable();
            $table->string('internal_location',50)->nullable();
            $table->dateTime('dated_added')->nullable();

            $table->unsignedBigInteger('supply_batch')->index()->nullable();
            $table->foreign('supply_batch')->references('id')->on('material_supplies')->onDelete('cascade');
            $table->unsignedBigInteger('setting')->index()->nullable();
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
        Schema::dropIfExists('material_stocks');
    }
}
