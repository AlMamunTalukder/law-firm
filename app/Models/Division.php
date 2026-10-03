<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    public $timestamps = false;
    public function district()
	{
	    return $this->hasMany('App\Models\District', 'division_id', 'id');
	}
}
