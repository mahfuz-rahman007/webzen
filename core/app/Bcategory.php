<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bcategory extends Model
{
    protected $guarded = [];


    public function blogs()
    {
        return $this->hasMany('App\Blog');
    }


    public function language(){
        return $this->belongsTo('App\Language');

       }
       
}
