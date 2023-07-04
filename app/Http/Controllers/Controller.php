<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function tgCallback(Request $request)
    {
        // Log the entire request
//        Log::info('Received request', ['request' => $request->all()]);

        // Your code logic...

        // Return the response
        return response()->json(['message' => 'Callback received']);
    }

    public function twCallback(Request $request)
    {
        // Log the entire request
        Log::info('Received request', ['request' => $request->all()]);

        // Your code logic...

        // Return the response
        return response()->json(['message' => 'Callback received']);
    }



}
