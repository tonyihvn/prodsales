<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinishedProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finished_products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_name')->references('id')->on('products')->nullable();
            $table->foreignId('production_batch')->references('id')->on('production_jobs')->nullable();
            $table->foreignId('comfirmed_by')->references('id')->on('users');

            $table->double('quantity_produced',10,2)->nullable();
            $table->double('quantity_damaged',10,2)->nullable();
            $table->text('added_to_stock',10)->nullable();
            $table->date('dated');
            $table->string('details',100)->nullable();
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
        Schema::dropIfExists('finished_products');
    }
}
