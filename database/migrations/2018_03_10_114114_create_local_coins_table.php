<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalCoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_coins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('short_name');
            
            $table->decimal('creator_percentage');
            $table->decimal('taker_percentage');
            $table->string('unit_name');
            $table->string('unit_value',255);
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
        Schema::dropIfExists('local_coins');
    }
}
