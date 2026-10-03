<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voting extends Model
{
    protected $guarded = [];
    use HasFactory, SoftDeletes;

    public function voting_count()
    {
        return $this->hasOne('App\Models\VotingCount');
    }

}
