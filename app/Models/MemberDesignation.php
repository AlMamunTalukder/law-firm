<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberDesignation extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function designation()
	{
	    return $this->belongsTo('App\Models\Designation');
	}
}
