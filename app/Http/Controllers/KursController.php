<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class KursController extends Controller
{
    public function index()
    {
        // Ambil data kurs dari API
        $response = Http::get('https://open.er-api.com/v6/latest/USD');

        if (!$response->successful()) {
            abort(500, 'Gagal mengambil data kurs');
        }

        $data = $response->json();

        $rates = [
            'IDR' => $data['rates']['IDR'] ?? 0,
            'MYR' => $data['rates']['MYR'] ?? 0,
            'SGD' => $data['rates']['SGD'] ?? 0,
            'JPY' => $data['rates']['JPY'] ?? 0,
            'EUR' => $data['rates']['EUR'] ?? 0,
        ];

        return view('kurs.index', compact('rates'));
    }
}