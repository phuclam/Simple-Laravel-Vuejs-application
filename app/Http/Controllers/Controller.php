<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function responseSuccess($data = [], $status = 200, $headers = [])
    {
        return response()->json(['success' => true, 'data' => $data], $status, $headers);
    }

    public function responseError($message = '', $status = 500, $headers = [])
    {
        return response()->json(['success' => false, 'message' => $message], $status, $headers);
    }
}
