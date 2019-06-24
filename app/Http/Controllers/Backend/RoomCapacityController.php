<?php

namespace App\Http\Controllers\Backend;

use App\Models\RoomCapacity;
use Illuminate\Http\Request;

class RoomCapacityController extends BackendController
{
    public function index()
    {
        $records = RoomCapacity::all();
        return $this->responseSuccess($records);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(RoomCapacity $room)
    {
        return $this->responseSuccess($room);
    }

    public function edit(RoomCapacity $room)
    {
        //
    }

    public function update(Request $request, RoomCapacity $room)
    {
        //
    }

    public function destroy(RoomCapacity $room)
    {
        //
    }
}
