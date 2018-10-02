<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\Traits\Attribute\LocalcoinsAttribute;
class LocalCoin extends Model
{
    use LocalcoinsAttribute;

    protected $fillable = ['name', 'short_name', "creator_percentage", "taker_percentage"
            , "unit_name", "unit_value"];
}
