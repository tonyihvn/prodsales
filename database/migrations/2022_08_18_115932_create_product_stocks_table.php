<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->index()->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->double('quantity',10,2)->nullable();

            $table->unsignedBigInteger('added_by')->index()->nullable();
            $table->foreign('added_by')->references('id')->on('users')->onDelete('cascade');

            $table->string('facility_location',50)->nullable();
            $table->string('internal_location',50)->nullable();
            $table->dateTime('dated_added')->nullable();

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
        Schema::dropIfExists('product_stocks');
    }
}
