<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\RoomCapacityRequest;
use App\Models\RoomCapacity;

class RoomCapacityController extends BackendController
{
    public function index()
    {
        $capacities = RoomCapacity::all();
        return $this->responseSuccess($capacities);
    }

    public function store(RoomCapacityRequest $request)
    {
        $capacity = new RoomCapacity();
        $capacity->name = $request->input('name');
        $capacity->save();

        return $this->responseSuccess($capacity);
    }

    public function show($id)
    {
        $capacity = RoomCapacity::findOrFail($id);
        return $this->responseSuccess($capacity);
    }

    public function update(RoomCapacityRequest $request, $id)
    {
        $capacity = RoomCapacity::findOrFail($id);
        $capacity->name = $request->input('name');
        $capacity->save();

        return $this->responseSuccess($capacity);
    }

    public function destroy($id)
    {
        $capacity = RoomCapacity::findOrFail($id);
        return $this->responseSuccess($capacity->delete());
    }
}
