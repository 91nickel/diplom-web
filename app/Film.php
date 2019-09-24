<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = [
        'name',
        'code',
        'announce',
        'length',
    ];

    public function halls()
    {
        return $this->belongsToMany('App\Hall', 'timetable');
    }

    public function timetables()
    {
        return $this->hasMany('App\Timetable');
    }
}
