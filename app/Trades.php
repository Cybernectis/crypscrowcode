<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\OfferType;
use App\LocalCoin;
class Trades extends Model
{
    // Get User offertrade
    public function userOfferTrades()
    {
       return $this->hasOne("App\OfferType", "id", 'offer_type_id');
    }


   // Get User userLocalCurrency
    public function userLocalCurrency()
    {
       return $this->hasOne("App\LocalCurrency", "id", 'local_currency_id');
    }
   
    // Get User userPaymentMethod
    public function userPaymentMethod()
    {
       return $this->hasOne("App\PaymentMethod", "id", 'payment_method_id');
    }


    // Get User userPaymentMethod
    public function userData()
    {
       return $this->hasOne("App\Models\Auth\User", "id", 'user_id');
    }

    // Get User selected trade coin
    public function getlocalcoin()
    {
       return $this->hasOne("App\LocalCoin", "id", 'local_coins_id');
    }
}
