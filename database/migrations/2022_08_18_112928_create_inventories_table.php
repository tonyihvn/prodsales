<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('item',50)->nullable();
            $table->string('tag_number',40)->nullable();
            $table->string('condition',40)->nullable();
            $table->date('date_purchased')->nullable();
            $table->string('details',80)->nullable();
            $table->string('current_location',40)->nullable();
            $table->string('detail',100)->nullable();
            $table->string('from',40)->nullable();

            $table->unsignedBigInteger('current_user')->index()->nullable();
            $table->foreign('current_user')->references('id')->on('users')->onDelete('cascade')->nullable;

            $table->unsignedBigInteger('setting_id')->index()->nullable();
            $table->foreign('setting_id')->references('id')->on('settings')->onDelete('cascade')->nullable;
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
        Schema::dropIfExists('inventories');
    }
}
