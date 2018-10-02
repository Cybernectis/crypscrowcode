<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("sender_id");
            $table->integer("receiver_id");;
            $table->string("trade_group_id");
            $table->string("private_key");
            $table->string("public_key");
            $table->string("address");
            $table->string("wif");
            $table->enum("status", ['Desposit to escrow', 'send by escrow', 'confrimed by escrow', "confrimed by seller"])->nullable();
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
        Schema::dropIfExists('wallets');
    }
}
