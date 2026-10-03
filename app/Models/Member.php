<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    protected $guarded = [];
    use HasFactory, SoftDeletes;

    public function designations()
	{
	    return $this->hasMany('App\Models\MemberDesignation')->with(['designation']);
	}

}
