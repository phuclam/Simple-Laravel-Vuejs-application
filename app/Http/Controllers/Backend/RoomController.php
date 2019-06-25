<?php

namespace App\Http\Controllers\Backend;

use App\Helper\Helper;
use App\Http\Requests\RoomRequest;
use App\Models\Room;

class RoomController extends BackendController
{
    public function index()
    {
        $rooms = Room::with(['type', 'capacity'])->get();

        return $this->responseSuccess($rooms);
    }

    public function store(RoomRequest $request)
    {
        $room = new Room();
        $room->name = $request->input('name');
        $room->type_id = $request->input('type_id');
        $room->capacity_id = $request->input('capacity_id');
        if (!empty($request->input('image'))) {
            $room->image_url = Helper::uploadImage($request->input('image'));
        }
        $room->save();

        return $this->responseSuccess($room);
    }

    public function show($id)
    {
        $room = Room::findOrFail($id);
        return $this->responseSuccess($room);
    }

    public function update(RoomRequest $request, $id)
    {
        $room = Room::findOrFail($id);
        $room->name = $request->input('name');
        $room->type_id = $request->input('type_id');
        $room->capacity_id = $request->input('capacity_id');
        if (!empty($request->input('image'))) {
            $room->image_url = Helper::uploadImage($request->input('image'));
        }
        $room->save();

        return $this->responseSuccess($room);
    }

    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        return $this->responseSuccess($room->delete());
    }
}
