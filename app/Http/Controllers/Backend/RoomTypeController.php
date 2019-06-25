<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\RoomTypeRequest;
use App\Models\RoomType;

class RoomTypeController extends BackendController
{
    public function index()
    {
        $types = RoomType::all();
        return $this->responseSuccess($types);
    }


    public function store(RoomTypeRequest $request)
    {
        $type = new RoomType();
        $type->name = $request->input('name');
        $type->save();

        return $this->responseSuccess($type);
    }

    public function show($id)
    {
        $room = RoomType::findOrFail($id);
        return $this->responseSuccess($room);
    }

    public function update(RoomTypeRequest $request, $id)
    {
        $type = RoomType::findOrFail($id);
        $type->name = $request->input('name');
        $type->save();

        return $this->responseSuccess($type);
    }

    public function destroy($id)
    {
        $type = RoomType::findOrFail($id);
        return $this->responseSuccess($type->delete());
    }
}
