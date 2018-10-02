<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\Traits\Attribute\SettingsAttribute;
class AdminSettings extends Model
{
    use SettingsAttribute;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'meta_key',
        'meta_value',
    ];
}
