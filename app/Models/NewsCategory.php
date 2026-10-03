<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsCategory extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function news()
	{
	    return $this->belongsTo('App\Models\News');
	}

    public function category()
	{
	    return $this->belongsTo('App\Models\Category');
	}
}
