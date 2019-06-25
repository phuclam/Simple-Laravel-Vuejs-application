<?php

namespace App\Http\Controllers\Backend;

use App\Helper\Helper;
use App\Http\Requests\BookingRequest;
use App\Models\Booking;

class BookingController extends BackendController
{
    public function index()
    {
        $bookings = Booking::with(['user', 'room'])->get();

        return $this->responseSuccess($bookings);
    }

    public function store(BookingRequest $request)
    {
        $booking = new Booking();
        $booking->name = $request->input('name');
        $booking->type_id = $request->input('type_id');
        $booking->capacity_id = $request->input('capacity_id');
        if (!empty($request->input('image'))) {
            $booking->image_url = Helper::uploadImage($request->input('image'));
        }
        $booking->save();

        return $this->responseSuccess($booking);
    }

    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        return $this->responseSuccess($booking);
    }

    public function update(BookingRequest $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->name = $request->input('name');
        $booking->type_id = $request->input('type_id');
        $booking->capacity_id = $request->input('capacity_id');
        if (!empty($request->input('image'))) {
            $booking->image_url = Helper::uploadImage($request->input('image'));
        }
        $booking->save();

        return $this->responseSuccess($booking);
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        return $this->responseSuccess($booking->delete());
    }
}
