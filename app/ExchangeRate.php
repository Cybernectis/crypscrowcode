<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\Traits\Attribute\ExchangeAttribute;
class ExchangeRate extends Model
{
    use ExchangeAttribute;

    protected $fillable = ['api_name', 'token_code', 'currency'];
    
}
