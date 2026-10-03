<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
	public $timestamps = false;
    protected $guarded = [];
    public function district()
	{
	    return $this->belongsTo('App\Models\District');
	}
}
