<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
     protected $guarded = [];

     public function abouts(){
        return $this->hasMany('App\About');
    }

    public function services(){
        return $this->hasMany('App\Service');
    }

    public function funfacts(){
        return $this->hasMany('App\Funfact');
    }

    public function testimonials(){
        return $this->hasMany('App\Testimonial');
    }

    public function teams(){
        return $this->hasMany('App\Team');
    }

    public function faqs(){
        return $this->hasMany('App\Faq');
    }

    public function bcategories(){
        return $this->hasMany('App\Bcategory');
    }


    public function blogs(){
        return $this->hasMany('App\Blog');
    }

    public function dynamicpages(){
        return $this->hasMany('App\Dynamicpage');
    }

    public function packages(){
        return $this->hasMany('App\Package');
    }

}
