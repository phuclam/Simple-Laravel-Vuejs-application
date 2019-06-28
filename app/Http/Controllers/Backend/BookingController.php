<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Models\Price;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class BookingController extends BackendController
{
    public function index(Request $request)
    {

        if (!empty($request->input('date'))) {
            $bookings = Booking::with(['user', 'room'])->where([
                ['date_start', '<=', date('Y-m-d', strtotime($request->input('date')))],
                ['date_end', '>=', date('Y-m-d', strtotime($request->input('date')))],
            ])->get();
        } else {
            $bookings = Booking::with(['user', 'room'])->get();
        }

        $reserved = [];
        foreach ($bookings as $booking) {
            if (!empty($booking->date_start) && !empty($booking->date_end)) {
                $date = $booking->date_start;
                while ($date <= $booking->date_end) {
                    if (!in_array($date, $reserved)) {
                        array_push($reserved, $date);
                    }
                    $date = date('Y-m-d', strtotime($date . '+1 day'));
                }
            }
        }

        return $this->responseSuccess(compact('bookings', 'reserved'));
    }

    public function store(BookingRequest $request)
    {
        $booking = new Booking();
        $booking->room_id = $request->input('room_id');
        $booking->user_id = $request->input('user_id');
        $booking->name = $request->input('name');
        $booking->phone = $request->input('phone');
        $booking->date_start = date('Y-m-d', strtotime($request->input('date_start')));
        $booking->date_end = date('Y-m-d', strtotime($request->input('date_end')));
        $booking->nights = $request->input('nights');

        $room = Room::findOrFail($request->input('room_id'));
        $prices = Price::where('type_id', $room->type_id)
                        ->where('capacity_id', $room->capacity_id)
                        ->get()->toArray();
        if (empty($prices)) {
            return $this->responseError('Type and Capacity of this Room have not defined price.');
        }

        $dayTypePrices = [];
        foreach ($prices as $price) {
            $dayTypePrices[$price['day_type']] = $price['price'];
        }

        $date = $booking->date_start;
        $price = 0;
        while($date < $booking->date_end) {
            $dayOfWeek = date('D', strtotime($date));

            if (in_array($dayOfWeek, ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'])) {
                $price += isset($dayTypePrices['Weekday']) ? $dayTypePrices['Weekday'] : (isset($dayTypePrices['Weekend']) ? $dayTypePrices['Weekend'] : 0);
            } elseif (in_array($dayOfWeek, ['Sat', 'Sun'])) {
                $price += isset($dayTypePrices['Weekend']) ? $dayTypePrices['Weekend'] : (isset($dayTypePrices['Weekday']) ? $dayTypePrices['Weekday'] : 0);
            }

            $date = date('Y-m-d', strtotime($date . '+1 day'));
        }

        $booking->price = $price;
        $booking->save();

        return $this->responseSuccess($booking);
    }

    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        $rooms = Room::all();
        $users = User::all();
        return $this->responseSuccess(compact('booking', 'rooms', 'users'));
    }

    public function update(BookingRequest $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->room_id = $request->input('room_id');
        $booking->user_id = $request->input('user_id');
        $booking->name = $request->input('name');
        $booking->phone = $request->input('phone');
        $booking->date_start = date('Y-m-d', strtotime($request->input('date_start')));
        $booking->date_end = date('Y-m-d', strtotime($request->input('date_end')));
        $booking->nights = $request->input('nights');
        $booking->price = 0;

        $booking->save();

        return $this->responseSuccess($booking);
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        return $this->responseSuccess($booking->delete());
    }
}
