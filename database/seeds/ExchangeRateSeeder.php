<?php

use Illuminate\Database\Seeder;
use App\ExchangeRate;
class ExchangeRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exchangedata = new ExchangeRate;
        $exchangedata->api_name  = 'Bitstmap';
       
        $exchangedata->token_code  = 'BTC';
        $exchangedata->currency  = 'USD';
        $exchangedata->save();

        $exchangedata = new ExchangeRate;
        $exchangedata->api_name  = 'Bitstmap';
        $exchangedata->token_code  = 'LTC';
        $exchangedata->currency  = 'USD';
        $exchangedata->save();

        $exchangedata = new ExchangeRate;
        $exchangedata->api_name  = 'Bitstmap';
        $exchangedata->token_code  = 'LTC';
        $exchangedata->currency  = 'EUR';
        $exchangedata->save();

        $exchangedata = new ExchangeRate;
        $exchangedata->api_name  = 'Bitstmap';
        $exchangedata->token_code  = 'BTC';
        $exchangedata->currency  = 'USD';
        $exchangedata->save();

        
        $exchangedata = new ExchangeRate;
        $exchangedata->api_name  = 'Frenix';
        $exchangedata->token_code  = 'BTC';
        $exchangedata->currency  = 'USD';
        $exchangedata->save();

        $exchangedata = new ExchangeRate;
        $exchangedata->api_name  = 'Frenix';
        $exchangedata->token_code  = 'LTC';
        $exchangedata->currency  = 'USD';
        $exchangedata->save();

        $exchangedata = new ExchangeRate;
        $exchangedata->api_name  = 'Frenix';
        $exchangedata->token_code  = 'LTC';
        $exchangedata->currency  = 'EUR';
        $exchangedata->save();

        $exchangedata = new ExchangeRate;
        $exchangedata->api_name  = 'Frenix';
        $exchangedata->token_code  = 'BTC';
        $exchangedata->currency  = 'USD';
        $exchangedata->save();
       
       	$exchangedata = new ExchangeRate;
        $exchangedata->api_name  = 'Kranken';
        $exchangedata->token_code  = 'BTC';
        $exchangedata->currency  = 'USD';
        $exchangedata->save();

        $exchangedata = new ExchangeRate;
        $exchangedata->api_name  = 'Kranken';
        $exchangedata->token_code  = 'LTC';
        $exchangedata->currency  = 'USD';
        $exchangedata->save();

        $exchangedata = new ExchangeRate;
        $exchangedata->api_name  = 'Kranken';
        $exchangedata->token_code  = 'LTC';
        $exchangedata->currency  = 'EUR';
        $exchangedata->save();

        $exchangedata = new ExchangeRate;
        $exchangedata->api_name  = 'Kranken';
        $exchangedata->token_code  = 'BTC';
        $exchangedata->currency  = 'USD';
        $exchangedata->save();

       


    }
}
