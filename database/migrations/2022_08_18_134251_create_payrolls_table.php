<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_id')->index()->nullable();
            $table->foreign('staff_id')->references('id')->on('users');
            $table->double('amount',10,2)->nullable();

            $table->unsignedBigInteger('paid_by')->index()->nullable();
            $table->foreign('paid_by')->references('id')->on('users');
            $table->string('month',15)->nullable();

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
        Schema::dropIfExists('payrolls');
    }
}
