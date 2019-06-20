<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    public function fees(){
    	return $this->hasMany(Fee::class);
    }

    protected $fillable = ['first_name','last_name','student_no', 'date_of_birth', 'address'];
    
}
