<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $guarded = [];

    public function language(){
        return $this->belongsTo('App\Language');
    }
}
