<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'name',
        'link',
    ];

    public function films(){
        return $this->belongsToMany('App\Film');
    }

}
