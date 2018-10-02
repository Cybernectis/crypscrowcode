<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("user_id");
            $table->integer("offer_type_id");
            $table->integer("payment_method_id");
            $table->integer("local_currency_id");
            $table->string("city");
            $table->integer("minimum_limit")->nullable();
            $table->integer("maximum_limit")->nullable();
            $table->text("headline")->nullable();
            $table->text("terms_of_trades")->nullable();
            $table->text("standards_hours")->nullable();
            $table->string("from_hours")->nullable();
            $table->string("to_hours")->nullable();
            $table->string("timezone")->nullable(); 
            $table->integer("rate_percentage");
            $table->integer("exchange_rate_id");
            $table->string("rate_above_below");
            $table->double("price");
            $table->boolean("is_paused")->default(0);
            $table->integer('local_coins_id');
            $table->decimal("crypscrow_price");
            $table->enum("status", ['Waiting for escrow', 'Payment pending','Confirmed Payment','Completed', 'Cancelled'])->nullable();
             $table->integer("compare_coins_id");
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
        Schema::dropIfExists('trades');
    }
}
