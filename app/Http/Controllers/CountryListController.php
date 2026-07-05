<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class CountryListController extends Controller
{
    public function index()
    {
        $countryCodes = [
            'IDN' => 'Indonesia',
            'MYS' => 'Malaysia',
            'SGP' => 'Singapore',
            'JPN' => 'Japan',
            'CHN' => 'China',
            'KOR' => 'South Korea',
            'IND' => 'India',
            'USA' => 'United States',
            'DEU' => 'Germany',
            'AUS' => 'Australia',
        ];

        $countries = [];

        foreach ($countryCodes as $code => $name) {

            // Ambil data dari World Bank API
            $population = Http::get("https://api.worldbank.org/v2/country/$code/indicator/SP.POP.TOTL?format=json")->json();
            $gdp = Http::get("https://api.worldbank.org/v2/country/$code/indicator/NY.GDP.MKTP.CD?format=json")->json();
            $inflation = Http::get("https://api.worldbank.org/v2/country/$code/indicator/FP.CPI.TOTL.ZG?format=json")->json();

            $populationValue = $population[1][0]['value'] ?? 0;
            $gdpValue = $gdp[1][0]['value'] ?? 0;
            $inflationValue = $inflation[1][0]['value'] ?? 0;

            // Menentukan Status Risiko
            if ($inflationValue >= 5) {
                $risk = 'Tinggi';
            } elseif ($inflationValue >= 3) {
                $risk = 'Sedang';
            } else {
                $risk = 'Aman';
            }

            $countries[] = [
                'name' => $name,
                'population' => $populationValue,
                'gdp' => $gdpValue,
                'inflation' => $inflationValue,
                'risk' => $risk,
            ];
        }

        return view('countries.index', compact('countries'));
    }
}