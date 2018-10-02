<?php

use Illuminate\Database\Seeder;
use App\LocalCoin;

class LocalCoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = new LocalCoin;
        $type->name = "bitcoin";
        $type->short_name ="BTC";
        $type->creator_percentage ="0.75";
        $type->taker_percentage="0.25";
        $type->unit_name="satoshi";
        $type->unit_value="100000000";
        $type->save();


        $type = new LocalCoin;
        $type->name = "litcoin";
        $type->short_name ="LTC";
        $type->creator_percentage ="0.75";
        $type->taker_percentage="0.25";
        $type->unit_name="litoshi";
        $type->unit_value="100000000";
        $type->save();
    }
}
