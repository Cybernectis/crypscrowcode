<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("users_id");
            $table->integer("local_coins_id");
            $table->varchar("amount");
            $table->string("to_address");
            $table->string("from_address");
            $table->text("hash");
	    $table->decimal("network_fees");
	    $table->boolean("is_admin_wallet")->defualt("0");
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
        Schema::dropIfExists('transactions');
    }
}
