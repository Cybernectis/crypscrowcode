<?php

use Illuminate\Database\Seeder;
use App\CompareCoins;
class CompareCoinsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $main_currency  = array('USD','EUR', 'GBP', 'JPY', 'INR');
        foreach ($main_currency as $key => $value) {
        	$coin 					= new CompareCoins;
	        $coin->coin_short_name 	= $value;
	        $coin->save();
        }
        
    }
}
