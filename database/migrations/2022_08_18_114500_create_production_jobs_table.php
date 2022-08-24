<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('batchno',30)->nullable();

            $table->unsignedBigInteger('product_id')->index()->nullable();
            $table->foreign('product_id')->references('id')->on('products')->nullable();

            $table->unsignedBigInteger('staff_incharge')->index()->nullable();
            $table->foreign('staff_incharge')->references('id')->on('users');

            $table->double('target_quantity',10,2)->nullable();
            $table->date('dated_started')->nullable();
            $table->date('dated_ended')->nullable();
            $table->string('status',30)->nullable();
            $table->double('estimated_cost_of_production',10,2)->nullable();
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
        Schema::dropIfExists('production_jobs');
    }
}
