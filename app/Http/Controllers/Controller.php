<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
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

        $botToken = config('services.tg.key');
        $chatId =  "-1001750994025";


        $ticker = $request->get('ticker');
        $price = $request->get('price');

        $message = "🤟🤟Impermanent loss warning🤟🤟" ."\r\n";
        $message.= "Криптопара: $ticker" ."\r\n";
        $message.= "Цена: $price" ."\r\n";
        $corridor=0;

        if($ticker == 'BTCUSDT' || $ticker =='ETHUSD'){
            $corridor = 9.3;
        }
        if($ticker == 'ARBUSDT'){
            $corridor = 25.5;
        }

        if($ticker == 'WETHGMX'){
            $corridor = 11;
        }



        $message.= "Delta: $corridor %" ."\r\n";
        $delta = (float)$price*(float)$corridor/2/100;
        $maxPrice = (float)$price+$delta;
        $minPrice = (float)$price-$delta;

        $message.= "MAX: $maxPrice" ."\r\n";
        $message.= "MIN: $minPrice" ."\r\n";


        $url = "https://api.telegram.org/bot{$botToken}/sendMessage";


        $response = Http::post($url, [
            'chat_id' => $chatId,
            'text' => $message,
        ]);

        // Log the entire request
        Log::info('Received request', ['request' => $request->all()]);

        // Your code logic...

        // Return the response
        return response()->json(['message' => 'Callback received']);
    }



}
