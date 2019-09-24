<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    protected $fillable = [
        'row',
        'seat',
        'timetable_id',
        'user_id',
    ];

    public function films()
    {
        return $this->belongsToMany('App\Film', 'timetable');
    }

    public function timetables()
    {
        return $this->hasMany('App\Timetable');
    }
}
