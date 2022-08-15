<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinistrygroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ministrygroups', function (Blueprint $table) {
            $table->id();
            $table->string('ministry_group_name')->nullable();
            $table->string('motto')->nullable();
            $table->string('logo')->nullable();
            $table->string('address')->nullable();
            $table->string('background')->nullable();
            $table->string('mode')->nullable();
            $table->string('color')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });

        DB::table('ministrygroups')->insert(
            array(
                'ministry_group_name' => 'Ministry Manager',
                'user_id' => 1
            ));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ministrygroups');
    }
}
