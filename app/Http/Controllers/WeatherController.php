<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index()
    {

        $response = Http::get('https://api.open-meteo.com/v1/forecast', [

            'latitude' => -6.2,
            'longitude' => 106.8,

            'current' => 'temperature_2m,wind_speed_10m',

            'hourly' => 'rain'

        ]);


        $cuaca = $response->json();


        return view('cuaca.index', compact('cuaca'));

    }
}