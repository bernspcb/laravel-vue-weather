<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;

class ApiController extends BaseController
{
    public const OPEN_WEATHER_MAP_API = 'https://api.openweathermap.org/data/2.5';
    public const FOUR_SQUARE_API = 'https://api.foursquare.com/v3';

    public function getWeather () {
        $response = Http::get(self::OPEN_WEATHER_MAP_API . '/weather?' . Arr::query([
            'appid' => config('services.openweather.key'),
            'lat' => request()->get('latitude'),
            'lon' => request()->get('longitude'),
            'units' => 'metric'
        ]));
        
        return $response->json();
    }

    public function getLocation () {
        $response = Http::withHeaders([
            'Authorization' => config('services.foursquare.key'),
            'accept' => 'application/json',
        ])->get(self::FOUR_SQUARE_API . '/autocomplete?' . Arr::query([
            'query' => request()->get('search'),
            'll' => request()->get('ll'),
            'types' => 'place',
            'session_token' => substr(session()->getId(), 0, 32)
        ]));
        
        return $response->json()['results'];
    }
}
