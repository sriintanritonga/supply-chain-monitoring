<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortController extends Controller
{
    public function index(Request $request)
    {
        $ports = [
            [
                'name' => 'Port of Shanghai',
                'code' => 'CNSHA',
                'country' => 'China',
                'latitude' => 30.6267,
                'longitude' => 122.0645,
                'capacity' => '47.3 Million TEUs'
            ],
            [
                'name' => 'Port of Singapore',
                'code' => 'SGSIN',
                'country' => 'Singapore',
                'latitude' => 1.264,
                'longitude' => 103.84,
                'capacity' => '37.3 Million TEUs'
            ],
            [
                'name' => 'Port of Rotterdam',
                'code' => 'NLRTM',
                'country' => 'Netherlands',
                'latitude' => 51.885,
                'longitude' => 4.286,
                'capacity' => '14.5 Million TEUs'
            ],
            [
                'name' => 'Port of Tanjung Priok',
                'code' => 'IDTPP',
                'country' => 'Indonesia',
                'latitude' => -6.1,
                'longitude' => 106.88,
                'capacity' => '7.8 Million TEUs'
            ],
            [
                'name' => 'Port of Los Angeles',
                'code' => 'USLAX',
                'country' => 'United States',
                'latitude' => 33.7288,
                'longitude' => -118.262,
                'capacity' => '10.6 Million TEUs'
            ],
            [
                'name' => 'Port of Busan',
                'code' => 'KRPUS',
                'country' => 'South Korea',
                'latitude' => 35.104,
                'longitude' => 129.043,
                'capacity' => '22.0 Million TEUs'
            ],
            [
                'name' => 'Port of Antwerp',
                'code' => 'BEANT',
                'country' => 'Belgium',
                'latitude' => 51.241,
                'longitude' => 4.405,
                'capacity' => '12.0 Million TEUs'
            ],
            [
                'name' => 'Port of Jebel Ali',
                'code' => 'AEJEA',
                'country' => 'United Arab Emirates',
                'latitude' => 25.011,
                'longitude' => 55.061,
                'capacity' => '13.7 Million TEUs'
            ],
            [
                'name' => 'Port of Hamburg',
                'code' => 'DEHAM',
                'country' => 'Germany',
                'latitude' => 53.54,
                'longitude' => 9.95,
                'capacity' => '8.7 Million TEUs'
            ],
            [
                'name' => 'Port of Tokyo',
                'code' => 'JPTYO',
                'country' => 'Japan',
                'latitude' => 35.62,
                'longitude' => 139.78,
                'capacity' => '4.5 Million TEUs'
            ]
        ];

        $portsCollection = collect($ports);

        // Filter pencarian pelabuhan
        if ($request->filled('port')) {
            $keyword = strtolower($request->port);
            $portsCollection = $portsCollection->filter(function ($p) use ($keyword) {
                return str_contains(strtolower($p['name']), $keyword) || str_contains(strtolower($p['code']), $keyword);
            });
        }

        // Filter pencarian negara
        if ($request->filled('country')) {
            $keyword = strtolower($request->country);
            $portsCollection = $portsCollection->filter(function ($p) use ($keyword) {
                return str_contains(strtolower($p['country']), $keyword);
            });
        }

        $ports = $portsCollection->values()->toArray();

        return view('ports.index', compact('ports'));
    }
}
