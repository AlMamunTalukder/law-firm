<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    protected $guarded = [];
    use HasFactory, SoftDeletes;

    public function categories()
	{
	    return $this->hasMany('App\Models\NewsCategory')->with(['category']);
	}

    public function sections()
	{
	    return $this->hasMany('App\Models\NewsSection')->with(['section']);
	}

    public function district()
	{
	    return $this->belongsTo('App\Models\District');
	}
    public function writer()
	{
	    return $this->belongsTo('App\Models\Writer');
	}
}
