<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;
use App\Models\Traits\Uuid;
class Group extends Model
{
    use Uuid;
	protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function hasUser($user_id)
    {
        foreach ($this->users as $user) {
            if($user->id == $user_id) {
                return true;
            }
        }
    }


    public function tradeData(){
        return $this->hasOne("App\Trades", "id", "trades_id");
    }

    public function userData(){
        return $this->hasOne("App\Models\Auth\User", "id", "user_id");
    }
}
