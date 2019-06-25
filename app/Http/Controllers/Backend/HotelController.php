<?php

namespace App\Http\Controllers\Backend;

use App\Helper\Helper;
use App\Http\Requests\HotelRequest;
use App\Models\Hotel;

class HotelController extends BackendController
{
    public function show()
    {
        $hotel = Hotel::first()->toArray();
        $countries = config('country');
        return $this->responseSuccess(compact('hotel', 'countries'));
    }

    public function update(HotelRequest $request)
    {
        $hotel = Hotel::first();
        $hotel->name = $request->input('name');
        $hotel->address = $request->input('address');
        $hotel->city = $request->input('city');
        $hotel->state = $request->input('state');
        $hotel->country = $request->input('country');
        $hotel->zip_code = $request->input('zip_code');
        $hotel->phone_number = $request->input('phone_number');
        $hotel->email = $request->input('email');
        if (!empty($request->input('image'))) {
            $hotel->image_url = Helper::uploadImage($request->input('image'));
        }
        $hotel->save();

        return $this->responseSuccess($hotel);
    }
}
