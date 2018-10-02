<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;
class LocalCurrency extends Model
{
   // Get User userLocalCurrency
    public function userLocalCurrency()
    {
       return $this->belongsTo("App\Models\Auth\User");
    }
}
