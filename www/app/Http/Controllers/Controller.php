<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private function jsonFailed($message = '', $data = []){

        $message = $message ? $message : 'failed';

        $result = [];
        $result['status'] = 'failed';
        $result['message'] = $message;
        $result['data'] = $data;

        return response()->json($result);
    }

    private function jsonSuccess($data = [], $message = ''){

        $message = $message ? $message : 'success';
        
        $result = [];
        $result['status'] = 'success';
        $result['message'] = $message;
        $result['data'] = $data;

        return response()->json($result);
    }

}
