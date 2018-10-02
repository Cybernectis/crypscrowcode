<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;
class OfferType extends Model
{
    // Get User offertrade
    public function userOfferTrades()
    {
       return $this->belongsTo("App\Models\Auth\User");
    }
}
