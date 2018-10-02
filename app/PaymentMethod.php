<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;
use App\Models\Auth\Traits\Attribute\PaymentMethodAttribute;
class PaymentMethod extends Model
{
	 use PaymentMethodAttribute;
     // Get User userPaymentMethod
    public function userPaymentMethod()
    {
       return $this->belongsTo("App\Models\Auth\User");
    }

    protected $fillable = ['name', 'description'];
}
