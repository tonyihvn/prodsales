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
            $table->string('ministry_name')->nullable();
            $table->string('motto')->nullable();
            $table->string('logo')->nullable();
            $table->string('address')->nullable();
            $table->string('background')->nullable();
            $table->string('mode')->nullable();
            $table->timestamps();
            
        });

        DB::table('settings')->insert(
            array(
                'ministry_name' => 'Ministry Manager',
                'motto' => 'Ministry Management System',
                'logo' => 'logo-dark.png',
                'background' => 'login-bg.jpg',
                'mode' => 'Active',
                'address' => 'Church Address'

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
