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
            $table->string('ministry_name');
            $table->string('motto');
            $table->string('logo');
            $table->string('address');
            $table->string('background');
            $table->string('mode');
            $table->timestamps();
            
        });

        DB::table('settings')->insert(
            array(
                'ministry_name' => 'Ministry Manager',
                'motto' => 'Ministry Management System',
                'logo' => 'logo-dark.png',
                'background' => 'login-bg.jpg',
                'mode' => 'Active'
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
