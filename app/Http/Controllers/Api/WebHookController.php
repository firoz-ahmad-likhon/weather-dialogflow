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
        $request = json_decode($request->getContent());
      
        $url = sprintf('https://api.openweathermap.org/data/2.5/weather?q=%s&appid=%s&units=%s', $request->queryResult->parameters->city, 'a3a69a3b9011c877ead2476b45a3a983', 'metric');
        $response = Http::get($url);

        return [
            'followupEventInput' => [
                'languageCode' => 'en-US',
                'name' => 'weather-call',
                'parameters' => [
                    'main' => isset($response['weather'][0]['main']) ? $response['weather'][0]['main'] : '',
                    'temp' => isset($response['main']['temp']) ? (string) $response['main']['temp'] : '',
                    'message' => isset($response['message']) ? $response['message'] : ''
                    ]
                ]
        ];
    }
}
