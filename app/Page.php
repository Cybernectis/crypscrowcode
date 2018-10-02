<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
    public function section()
    {
        return $this->hasMany('App\PageSection','page_id');
    }
    public function slider()
    {
        return $this->hasOne('App\Slidertype','page_id');
    }
}
