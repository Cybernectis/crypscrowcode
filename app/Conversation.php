<?php

namespace App;
use App\Group;
use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;
class Conversation extends Model
{
	protected $fillable = ['message', 'user_id', 'group_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
