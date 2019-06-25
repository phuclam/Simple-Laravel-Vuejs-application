<?php

namespace App\Http\Controllers\Backend;

use App\Helper\Helper;
use App\Http\Requests\HotelRequest;
use App\Models\Hotel;
use App\Models\User;

class UserController extends BackendController
{
    public function index()
    {
        $users = User::all();
        return $this->responseSuccess($users);
    }
}
