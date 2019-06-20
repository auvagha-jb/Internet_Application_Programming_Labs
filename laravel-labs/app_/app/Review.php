<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function review()
    {
        return $this->belongsTo(Car::class);
    }

    protected $table = "reviews";
    protected $fillable = ['car_id', 'review'];
}
