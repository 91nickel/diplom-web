<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'row',
        'seat',
        'timetable_id',
        'user_id',
    ];

    public function timetable()
    {
        return $this->hasOne('App\Timetable', 'id', 'timetable_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

}
