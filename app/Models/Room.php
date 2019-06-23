<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';

    public function type()
    {
        return $this->belongsTo('App\Models\RoomType', 'type_id');
    }

    public function capacity()
    {
        return $this->belongsTo('App\Models\RoomCapacity', 'capacity_id');
    }
}
