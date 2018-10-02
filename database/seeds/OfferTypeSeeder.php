<?php

use Illuminate\Database\Seeder;
use App\OfferType;
class OfferTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = new OfferType;
        $type->type_name = "Buy";
        $type->description ="You want to Buy.";
        $type->save();


        $type = new OfferType;
        $type->type_name = "Sell";
        $type->description ="You want to Sell.";
        $type->save();
    }
}
