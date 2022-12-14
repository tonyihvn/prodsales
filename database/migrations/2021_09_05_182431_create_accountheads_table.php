<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountheadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accountheads', function (Blueprint $table) {
            $table->id();
            $table->string('title',50)->nullable();
            $table->string('category',50)->nullable();
            $table->string('type',50)->nullable();
            $table->string('description',50)->nullable();
            $table->unsignedBigInteger('setting_id')->index()->nullable();
            $table->foreign('setting_id')->references('id')->on('settings');
            $table->timestamps();
        });

        DB::table('accountheads')->insert(
            array(
                'title' => 'Item Sales',
                'category' => 'Inflow',
                'type'=> 'Sales',
                'description'=>'For all sales of products',

            ));
        DB::table('accountheads')->insert(
            array(
                'title' => 'Material Supply',
                'category' => 'Expenditure',
                'type'=> 'Production',
                'description'=>'For payment of material supplies',

            ));
        }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accountheads');
    }
}
