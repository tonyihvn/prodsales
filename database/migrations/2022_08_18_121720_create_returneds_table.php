<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('returneds', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_id')->index()->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->double('quantity',10,2)->default(0.00)->nullable();

            $table->unsignedBigInteger('sales_id')->index()->nullable();
            $table->foreign('sales_id')->references('id')->on('product_sales');

            $table->unsignedBigInteger('recieved_by')->index()->nullable();
            $table->foreign('recieved_by')->references('id')->on('users');

            $table->unsignedBigInteger('setting_id')->index()->nullable();
            $table->foreignId('setting_id')->references('id')->on('settings');
            $table->string('reason',60)->nullable();
            $table->string('stocked',10)->nullable();

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
        Schema::dropIfExists('returneds');
    }
}
