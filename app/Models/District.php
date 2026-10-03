<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public $timestamps = false;

    public function division()
	{
	    return $this->belongsTo('App\Models\Division', 'division_id', 'id');
	}

	public function area()
	{
	    return $this->hasMany('App\Models\Area', 'district_id', 'id');
	}

	public function institutes() {
        return $this->hasMany('App\Models\Institute','district_id','id');
    }
}
