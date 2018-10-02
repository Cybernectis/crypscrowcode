<?php

use Illuminate\Database\Seeder;
use App\AdminSettings;
class AdminSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $systemdata = New AdminSettings;
        $systemdata->user_id = 1;
        $systemdata->name = "Buyer Percentange";
        $systemdata->meta_key = "buyer_percentage";
        $systemdata->meta_value = "0.025";
        $systemdata->save();

        $systemdata = New AdminSettings;
        $systemdata->user_id = 1; 
        $systemdata->name = "Seller Percentange";
        $systemdata->meta_key = "seller_percentage";
        $systemdata->meta_value = "0.075";
        $systemdata->save();
        
    }
}
