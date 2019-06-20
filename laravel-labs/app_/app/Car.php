<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    public function review(){
    	return $this->hasMany(Review::class);
    }

    protected $fillable = [
        'make', 'model', 'produced_on',
    ];
}
