<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Models\Price;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends FrontendController
{
    public function index(Request $request)
    {
        if (!empty($request->input('room'))) {
            $rooms = Room::with(['type', 'capacity'])->where('id', $request->input('room'))->get()->toArray();
        } else {
            $rooms = Room::with(['type', 'capacity'])->get()->toArray();
        }

        $dayTypePrices = [];
        $countDayType = [
            'Weekday' => 0,
            'Weekend' => 0
        ];
        if (!empty($request->input('date_start')) && !empty($request->input('date_end'))) {
            $prices = Price::all()->toArray();
            if (!empty($prices)) {
                foreach ($prices as $price) {
                    $dayTypePrices[$price['type_id'] . '-' . $price['capacity_id'] . '-' . $price['day_type']] = $price['price'];
                }
            }

            $dateStart = date('Y-m-d', strtotime($request->input('date_start')));
            $dateEnd = date('Y-m-d', strtotime($request->input('date_end')));
            if ($dateStart !== '1970-01-01' && $dateEnd !== '1970-01-01') {
                $date = $dateStart;
                while ($date < $dateEnd) {
                    $dayOfWeek = date('D', strtotime($date));

                    if (in_array($dayOfWeek, ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'])) {
                        $countDayType['Weekday']++;
                    } elseif (in_array($dayOfWeek, ['Sat', 'Sun'])) {
                        $countDayType['Weekend']++;
                    }
                    $date = date('Y-m-d', strtotime($date . '+1 day'));
                }
            }

        }
        $output = [];
        foreach ($rooms as $room) {
            $price = 0;
            if (!empty($dayTypePrices)) {
                $price = isset($dayTypePrices[$room['type_id'] . '-'.$room['capacity_id'] .'-Weekday']) ? $dayTypePrices[$room['type_id'] . '-'.$room['capacity_id'] .'-Weekday'] * $countDayType['Weekday'] : 0;
                $price += isset($dayTypePrices[$room['type_id'] . '-'.$room['capacity_id'] .'-Weekend']) ? $dayTypePrices[$room['type_id'] . '-'.$room['capacity_id'] .'-Weekend'] * $countDayType['Weekend'] : 0;
            }
            $room['price'] = $price;
            $output[] = $room;
        }
        return $this->responseSuccess($output);
    }

    public function booking(BookingRequest $request)
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
}
