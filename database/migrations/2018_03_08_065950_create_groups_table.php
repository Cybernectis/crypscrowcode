<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->double('amount');
            $table->integer('local_coins_id');
            $table->integer('trades_id');
            $table->uuid('uuid');
            $table->string("coin_quantity", 255);
            $table->boolean("is_dispute")->default(0);
            $table->enum("status", ['Waiting for escrow', 'Payment pending', 'Confirmed Payment','Completed','Cancelled'])->nullable();
            $table->timestamp('cancel_date')->nullable();
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
        Schema::dropIfExists('groups');
    }
}
