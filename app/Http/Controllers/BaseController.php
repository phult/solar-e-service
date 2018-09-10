<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller;

class BaseController extends Controller
{
    protected function success($data)
    {
        $data['status'] = 'successful';
        return response()->json($data);
    }
    
    protected function error($data)
    {
        $data['status'] = 'fail';
        return response()->json($data);
    }
}
