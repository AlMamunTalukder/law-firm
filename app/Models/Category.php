<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $guarded = [];
    use HasFactory, SoftDeletes;

    public function category()
	{
	    return $this->belongsTo('App\Models\Category','category_id');
	}
    public function sections()
	{
	    return $this->hasMany('App\Models\SectionCategory')->with(['section']);
	}

    public function categories()
	{
	    return $this->hasMany('App\Models\Category','category_id');
	}
}
