<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model
{
    protected $guarded = [];
    use HasFactory, SoftDeletes;

    public function categories()
	{
	    return $this->hasMany('App\Models\AlbumCategory')->with(['category']);
	}
}
