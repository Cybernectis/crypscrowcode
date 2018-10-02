<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminWalletDetail extends Model
{
    // Get User dataLocalCoin
    public function dataLocalCoin()
    {
       return $this->hasOne("\App\LocalCoin", "id", 'local_coins_id');
    }
}
