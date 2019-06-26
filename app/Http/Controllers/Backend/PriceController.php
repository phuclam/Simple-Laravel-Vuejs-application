<?php

namespace App\Http\Controllers\Backend;

use App\Helper\Helper;
use App\Http\Requests\PriceRequest;
use App\Models\Price;

class PriceController extends BackendController
{
    public function index()
    {
        $prices = Price::with(['type', 'capacity'])->get();

        return $this->responseSuccess($prices);
    }

    public function store(PriceRequest $request)
    {
        $price = new Price();
        $price->type_id = $request->input('type_id');
        $price->capacity_id = $request->input('capacity_id');
        $price->day_type = $request->input('day_type');
        $price->price = $request->input('price');
        $price->save();

        return $this->responseSuccess($price);
    }

    public function show($id)
    {
        $price = Price::findOrFail($id);
        return $this->responseSuccess($price);
    }

    public function update(PriceRequest $request, $id)
    {
        $price = Price::findOrFail($id);
        $price->type_id = $request->input('type_id');
        $price->capacity_id = $request->input('capacity_id');
        $price->day_type = $request->input('day_type');
        $price->price = $request->input('price');
        $price->save();

        return $this->responseSuccess($price);
    }

    public function destroy($id)
    {
        $price = Price::findOrFail($id);
        return $this->responseSuccess($price->delete());
    }
}
