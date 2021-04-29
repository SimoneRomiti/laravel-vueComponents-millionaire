<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'level',
        'question'
    ];

    public $timestamps = false;

    public function answers(){
        return $this->hasMany('App\Answer');
    }
}
