<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDamagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_damages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->index();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('product_damages');
    }
}
