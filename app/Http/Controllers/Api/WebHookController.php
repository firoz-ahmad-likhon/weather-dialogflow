<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WebHookController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function currentWeatherData(Request $request)
    {
        $url = sprintf('https://api.openweathermap.org/data/2.5/weather?q=%s&appid=%s&units=%s', $request->q,'a3a69a3b9011c877ead2476b45a3a983', 'metric');
        $response = Http::get($url);

        //return $response;

        return [
            'main' => $response['weather'][0]['main'] ?? '',
            'temp' => $response['main']['temp'] ?? '',
            'message' => $response['message'] ?? ''
        ];
    }
}
