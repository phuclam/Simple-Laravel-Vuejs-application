<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table = 'prices';

    public $timestamps = false;

    public function type()
    {
        return $this->belongsTo('App\Models\RoomType', 'type_id');
    }

    public function capacity()
    {
        return $this->belongsTo('App\Models\RoomCapacity', 'capacity_id');
    }
}
