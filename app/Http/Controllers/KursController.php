<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class KursController extends Controller
{
    public function index()
    {
        // Ambil data kurs dari Exchange Rate API
        $response = Http::get('https://open.er-api.com/v6/latest/USD');

        if (!$response->successful()) {
            abort(500, 'Gagal mengambil data kurs.');
        }

        $data = $response->json();

        // Data yang akan ditampilkan
        $currencies = [

            [
                'country' => 'Indonesia',
                'flag' => '🇮🇩',
                'code' => 'IDR',
                'rate' => $data['rates']['IDR'] ?? 0,
            ],

            [
                'country' => 'Malaysia',
                'flag' => '🇲🇾',
                'code' => 'MYR',
                'rate' => $data['rates']['MYR'] ?? 0,
            ],

            [
                'country' => 'Singapura',
                'flag' => '🇸🇬',
                'code' => 'SGD',
                'rate' => $data['rates']['SGD'] ?? 0,
            ],

            [
                'country' => 'Jepang',
                'flag' => '🇯🇵',
                'code' => 'JPY',
                'rate' => $data['rates']['JPY'] ?? 0,
            ],

            [
                'country' => 'Uni Eropa',
                'flag' => '🇪🇺',
                'code' => 'EUR',
                'rate' => $data['rates']['EUR'] ?? 0,
            ],

        ];

        $base = $data['base_code'] ?? 'USD';

        $lastUpdate = $data['time_last_update_utc'] ?? now();

        return view('kurs.index', compact(
            'currencies',
            'base',
            'lastUpdate'
        ));
    }
}