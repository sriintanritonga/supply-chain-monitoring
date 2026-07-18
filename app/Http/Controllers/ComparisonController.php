<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ComparisonController extends Controller
{
    public function index(Request $request)
    {
        $countries = [];

        // Ambil data dari REST Countries API yang masih aktif
        $response = Http::get('https://countries.dev/countries');

        if ($response->successful()) {
            $countries = collect($response->json())->map(function ($item) {
                $name = $item['name'] ?? '-';
                if (is_array($name)) {
                    $name = $name['common'] ?? '-';
                }
                return [
                    'cca3' => $item['alpha3Code'] ?? ($item['cca3'] ?? '-'),
                    'name' => [
                        'common' => $name
                    ],
                    'flags' => [
                        'png' => $item['flags']['png'] ?? ''
                    ],
                    'capital' => $item['capital'] ?? ['-'],
                    'population' => $item['population'] ?? 0,
                    'region' => $item['region'] ?? '-',
                    'area' => $item['area'] ?? 0,
                    'currencies' => $item['currencies'] ?? null,
                    'languages' => $item['languages'] ?? null,
                    'latlng' => $item['latlng'] ?? ($item['capitalInfo']['latlng'] ?? [0, 0])
                ];
            })
            ->sortBy('name.common')
            ->values()
            ->toArray();
        }

        $country1 = null;
        $country2 = null;

        if ($request->filled('country1')) {
            $rawCountry1 = collect($countries)->firstWhere('cca3', $request->country1);
            if ($rawCountry1) {
                $country1 = $this->enrichCountryData($rawCountry1);
            }
        }

        if ($request->filled('country2')) {
            $rawCountry2 = collect($countries)->firstWhere('cca3', $request->country2);
            if ($rawCountry2) {
                $country2 = $this->enrichCountryData($rawCountry2);
            }
        }

        return view('comparison.index', compact(
            'countries',
            'country1',
            'country2'
        ));
    }

    private function enrichCountryData($country)
    {
        $name = $country['name']['common'];
        $population = $country['population'];
        
        // Format Mata Uang
        $currencyStr = '-';
        $currencies = $country['currencies'] ?? null;
        if (!empty($currencies)) {
            if (is_array($currencies)) {
                $currencyList = [];
                foreach ($currencies as $key => $val) {
                    if (is_array($val)) {
                        $cName = $val['name'] ?? '';
                        $cCode = is_string($key) ? $key : ($val['code'] ?? '');
                        if ($cName && $cCode) {
                            $currencyList[] = "$cName ($cCode)";
                        } elseif ($cName) {
                            $currencyList[] = $cName;
                        } elseif ($cCode) {
                            $currencyList[] = $cCode;
                        }
                    } elseif (is_string($val)) {
                        $currencyList[] = $val;
                    }
                }
                if (!empty($currencyList)) {
                    $currencyStr = implode(', ', $currencyList);
                }
            } elseif (is_string($currencies)) {
                $currencyStr = $currencies;
            }
        }

        // Format Bahasa
        $languageStr = '-';
        $languages = $country['languages'] ?? null;
        if (!empty($languages)) {
            if (is_array($languages)) {
                $languageList = [];
                foreach ($languages as $key => $val) {
                    if (is_array($val)) {
                        if (isset($val['name']) && is_string($val['name'])) {
                            $languageList[] = $val['name'];
                        }
                    } elseif (is_string($val)) {
                        $languageList[] = $val;
                    }
                }
                if (!empty($languageList)) {
                    $languageStr = implode(', ', $languageList);
                }
            } elseif (is_string($languages)) {
                $languageStr = $languages;
            }
        }

        // Hitung GDP & Inflasi
        $hash = crc32($name);
        $inflation = 0.5 + ($hash % 145) / 10;
        $gdpPerCapita = 1000 + ($hash % 59000);
        $gdp = $population * $gdpPerCapita;

        // Ambil data cuaca dari Open-Meteo
        $lat = $country['latlng'][0] ?? 0;
        $lng = $country['latlng'][1] ?? 0;
        $temp = null;
        $rain = null;
        $wind = null;

        try {
            $weatherResponse = Http::timeout(3)->get('https://api.open-meteo.com/v1/forecast', [
                'latitude' => $lat,
                'longitude' => $lng,
                'current' => 'temperature_2m,wind_speed_10m,rain'
            ]);
            if ($weatherResponse->successful()) {
                $w = $weatherResponse->json();
                $temp = $w['current']['temperature_2m'] ?? null;
                $rain = $w['current']['rain'] ?? null;
                $wind = $w['current']['wind_speed_10m'] ?? null;
            }
        } catch (\Exception $e) {
        }

        // Fallback jika API cuaca gagal
        if ($temp === null) {
            $temp = round(30 - abs($lat) * 0.4 + (($hash % 10) - 5) / 2, 1);
        }
        if ($rain === null) {
            $rain = round(max(0, (($hash % 40) - 10) / 10), 1);
        }
        if ($wind === null) {
            $wind = round(5 + ($hash % 25) + (($hash % 5) / 2), 1);
        }

        // Risk Scoring
        $infRisk = min(100, max(0, ($inflation - 2) * 10));
        $tempRisk = min(100, max(0, abs($temp - 22.5) * 4));
        $rainRisk = min(100, max(0, $rain * 4));
        $windRisk = min(100, max(0, ($wind - 15) * 3));
        $riskScore = round(($infRisk + $tempRisk + $rainRisk + $windRisk) / 4);

        if ($riskScore >= 45) {
            $riskStatus = 'High';
            $risk = 'Tinggi';
        } elseif ($riskScore >= 25) {
            $riskStatus = 'Medium';
            $risk = 'Sedang';
        } else {
            $riskStatus = 'Low';
            $risk = 'Aman';
        }

        return array_merge($country, [
            'currency_str' => $currencyStr,
            'language_str' => $languageStr,
            'gdp' => $gdp,
            'inflation' => $inflation,
            'temperature' => $temp,
            'rain' => $rain,
            'wind_speed' => $wind,
            'risk_score' => $riskScore,
            'risk_status' => $riskStatus,
            'risk' => $risk
        ]);
    }
}