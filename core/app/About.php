<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $guarded = [];

    public function language(){
        return $this->belongsTo('App\Language');
    }
}
