<?php

namespace App\Models\Auth;

use App\Models\Traits\Uuid;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use App\Models\Auth\Traits\Scope\UserScope;
use App\Models\Auth\Traits\Method\UserMethod;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Auth\Traits\SendUserPasswordReset;
use App\Models\Auth\Traits\Attribute\UserAttribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Auth\Traits\Relationship\UserRelationship;
use App\OfferType;
use App\LocalCurrency;
use App\PaymentMethod;
use App\Group;
use App\Trades;
use Cesargb\MagicLink\Traits\HasMagicLink;

/**
 * Class User.
 */
class User extends Authenticatable
{
    use HasRoles,
        Notifiable,
        SendUserPasswordReset,
        SoftDeletes,
        UserAttribute,
        UserMethod,
        UserRelationship,
        UserScope,
        Uuid,
        HasMagicLink;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'avatar_type',
        'avatar_location',
        'password',
        'password_changed_at',
        'active',
        'confirmation_code',
        'confirmed',
        'timezone',
        'gender',
        'google2fa_secret',
        'refer_by_user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The dynamic attributes from mutators that should be returned with the user object.
     * @var array
     */
    protected $appends = ['full_name'];

    // Get User offertrade
    // public function userOfferTrades()
    // {
    //    return $this->hasOne("App\OfferType", "id", 'user_id');
    // }

    // // Get User userLocalCurrency
    // public function userLocalCurrency()
    // {
    //    return $this->hasOne("App\LocalCurrency", "id", 'user_id');
    // }
    // // Get User userPaymentMethod
    // public function userPaymentMethod()
    // {
    //    return $this->hasOne("App\PaymentMethod", "id", 'user_id');
    // }

    public function groups()
    {
        return $this->belongsToMany(Group::class)->withTimestamps();
    }

    public function trades()
    {
        return $this->hasMany("App\Trades");
    }

    /**
     * The channels the user receives notification broadcasts on.
     *
     * @return string
     */
    public function receivesBroadcastNotificationsOn()
    {
        return 'notification.'.$this->id;
    }


    // Get All userRewards
    public function userRewards()
    {
      return $this->hasMany("App\Rewards", "to_user_id");
    }
}
