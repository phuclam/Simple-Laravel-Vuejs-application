<?php

namespace App\Http\Controllers\Backend;

use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends BackendController
{
    public function index()
    {
        $records = RoomType::all();
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

    public function show(RoomType $room)
    {
        return $this->responseSuccess($room);
    }

    public function edit(RoomType $room)
    {
        //
    }

    public function update(Request $request, RoomType $room)
    {
        //
    }

    public function destroy(RoomType $room)
    {
        //
    }
}
