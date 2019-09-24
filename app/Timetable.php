<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    protected $fillable = [
        'start',
        'stop',
        'film_id',
        'hall_id',
    ];

    public function films()
    {
        return $this->belongsTo('App\Film');
    }

    public function halls()
    {
        return $this->belongsTo('App\Hall');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function film()
    {
        return $this->hasOne('App\Film', 'id', 'film_id');
    }

    public function hall()
    {
        return $this->hasOne('App\Hall', 'id', 'hall_id');
    }
}
