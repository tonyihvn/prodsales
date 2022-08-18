<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('business_name')->nullable();
            $table->string('motto')->nullable();
            $table->string('logo')->nullable();
            $table->string('address')->nullable();
            $table->string('background')->nullable();
            $table->string('mode')->nullable();
            $table->string('color')->nullable();

            $table->foreign('businessgroup_id')->references('id')->on('businessgroups')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->nullable();

            $table->timestamps();

        });

        DB::table('settings')->insert(
            array(
                'business_name' => 'ProdSales',
                'motto' => 'Production and Sales Management System',
                'logo' => 'logo-dark.png',
                'background' => 'login-bg.jpg',
                'mode' => 'Active',
                'address' => 'Business Address',
                'color' => '',
                'user_id' => 1,
                'businessgroup_id' => 1

            )
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
