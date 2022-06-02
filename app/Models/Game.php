<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function team1() {
        return $this->belongsTo('App\Models\Team');
    }
    public function team2() {
        return $this->belongsTo('App\Models\Team');
    }

    public function result() {
        return $this->hasOne('App\Models\Result');
    }

}
