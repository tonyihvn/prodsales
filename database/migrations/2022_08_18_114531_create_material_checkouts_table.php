<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_checkouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('material_id')->references('id')->on('materials');
            $table->foreignId('checkout_by')->references('id')->on('users');
            $table->foreignId('approved_by')->references('id')->on('users');
            $table->foreignId('production_batch')->references('id')->on('production_jobs');

            $table->double('quantity',10,2);
            $table->date('dated');
            $table->string('details',100);
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
        Schema::dropIfExists('material_checkouts');
    }
}
