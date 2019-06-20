<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
	  public function student(){
    	return $this->belongsTo(Student::class);
    }
    //
    protected $fillable = ['student_no', 'amount', 'paid_at'];
}
