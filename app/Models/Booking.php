<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function room()
    {
        return $this->belongsTo('App\Models\Room', 'room_id');
    }


    public function getRangeAttribute()
    {
        return 'asdfadsf';
    }
}
