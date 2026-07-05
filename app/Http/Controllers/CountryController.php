<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class CountryController extends Controller
{

    public function index()
    {


        // Populasi Indonesia
        $populasi = Http::get(
            'https://api.worldbank.org/v2/country/IDN/indicator/SP.POP.TOTL?format=json'
        )->json();



        // GDP Indonesia
        $gdp = Http::get(
            'https://api.worldbank.org/v2/country/IDN/indicator/NY.GDP.MKTP.CD?format=json'
        )->json();



        // Inflasi Indonesia
        $inflasi = Http::get(
            'https://api.worldbank.org/v2/country/IDN/indicator/FP.CPI.TOTL.ZG?format=json'
        )->json();



        return view('negara.index', [

            'negara' => 'Indonesia',

            'populasi' => $populasi[1][0]['value'],

            'gdp' => $gdp[1][0]['value'],

            'inflasi' => $inflasi[1][0]['value']

        ]);


    }

}