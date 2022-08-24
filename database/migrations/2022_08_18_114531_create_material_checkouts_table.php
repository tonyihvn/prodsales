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
            $table->unsignedBigInteger('material_id')->index()->nullable();
            $table->foreign('material_id')->references('id')->on('materials');

            $table->unsignedBigInteger('checkout_by')->index()->nullable();
            $table->foreign('checkout_by')->references('id')->on('users');

            $table->unsignedBigInteger('approved_by')->index()->nullable();
            $table->foreign('approved_by')->references('id')->on('users');

            $table->string('production_batch',30)->nullable();

            $table->double('quantity',10,2);
            $table->date('dated');
            $table->string('details',100);

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
        Schema::dropIfExists('material_checkouts');
    }
}
