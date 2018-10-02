<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\LocalCoin;
class UserWallet extends Model
{
    //
    // Get User selected trade coin
    public function getlocalcoin()
    {
       return $this->hasMany("App\LocalCoin", "id", 'local_coins_id');
    }
}
