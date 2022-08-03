<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Championship extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $start = ['start'];
    protected $end = ['end'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function teams() {
        return $this->hasMany('App\Models\Team');
    }

    public function games() {
        return $this->hasMany('App\Models\Game');
    }

    public function tables() {
        return $this->hasMany('App\Models\Table');
    }

}
