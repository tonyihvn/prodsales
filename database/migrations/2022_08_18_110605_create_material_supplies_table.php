<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialSuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_supplies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('material_id')->index()->nullable();
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');

            $table->unsignedBigInteger('supplier_id')->index()->nullable();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');

            $table->docuble('quantity',10,2)->nullable();
            $table->double('cost_per',10,2)->nullable();
            $table->double('total_amount',10,2)->nullable();

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
        Schema::dropIfExists('material_supplies');
    }
}
