<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class RisikoController extends Controller
{
    public function index()
    {
        // API Kurs
        $kursApi = Http::get('https://open.er-api.com/v6/latest/USD');
        $kurs = $kursApi->json();

        $idr = $kurs['rates']['IDR'] ?? 0;

        $kursStatus = $idr > 18000 ? "Tinggi" : ($idr > 16000 ? "Sedang" : "Rendah");

        // API Cuaca
        $cuacaApi = Http::get('https://api.open-meteo.com/v1/forecast', [
            'latitude' => -6.2,
            'longitude' => 106.8,
            'current' => 'wind_speed_10m'
        ]);

        $cuaca = $cuacaApi->json();

        $angin = $cuaca['current']['wind_speed_10m'] ?? 0;

        $cuacaStatus = $angin > 40 ? "Tinggi" : ($angin > 20 ? "Sedang" : "Rendah");

        // API Berita
        $apiKey = '05ba51dc090909641c8e3e7cfcbb3f75';

        $beritaApi = Http::get('https://gnews.io/api/v4/top-headlines', [
            'category' => 'business',
            'lang' => 'en',
            'country' => 'us',
            'max' => 10,
            'apikey' => $apiKey,
        ]);

        $berita = [];

        if ($beritaApi->successful()) {
            $data = $beritaApi->json();
            $berita = $data['articles'] ?? [];
        }

        $jumlahBerita = count($berita);

        // Analisis Sentimen Berita untuk memengaruhi status risiko berita global
        $negKeywords = ['crisis', 'shortage', 'conflict', 'risk', 'drop', 'fail', 'inflation', 'loss', 'strike', 'blockade', 'delay', 'collapse', 'disruption', 'threat', 'warn'];
        $posKeywords = ['growth', 'boost', 'rise', 'deal', 'improve', 'success', 'stable', 'recover', 'gain', 'expand', 'agree', 'ease', 'safe'];

        $negativeCount = 0;
        $positiveCount = 0;

        foreach ($berita as $art) {
            $text = strtolower(($art['title'] ?? '') . ' ' . ($art['description'] ?? ''));
            $negHits = 0;
            $posHits = 0;
            foreach ($negKeywords as $kw) {
                if (str_contains($text, $kw)) $negHits++;
            }
            foreach ($posKeywords as $kw) {
                if (str_contains($text, $kw)) $posHits++;
            }
            if ($negHits > $posHits) {
                $negativeCount++;
            } elseif ($posHits > $negHits) {
                $positiveCount++;
            }
        }

        // Tentukan tingkat risiko berita berdasarkan sentimen mayoritas berita
        if ($negativeCount > $positiveCount) {
            $beritaStatus = "Tinggi";
        } elseif ($jumlahBerita >= 5) {
            $beritaStatus = "Sedang";
        } else {
            $beritaStatus = "Rendah";
        }

        // Tracking
        $trackingStatus = "Rendah";

        // Overall Risk Calculation
        $nilai = [];

        foreach ([
            $cuacaStatus,
            $kursStatus,
            $beritaStatus,
            $trackingStatus
        ] as $status) {

            if ($status == "Tinggi") {
                $nilai[] = 3;
            } elseif ($status == "Sedang") {
                $nilai[] = 2;
            } else {
                $nilai[] = 1;
            }
        }

        $rata = array_sum($nilai) / count($nilai);

        if ($rata >= 2.5) {
            $overall = "Tinggi";
        } elseif ($rata >= 1.5) {
            $overall = "Sedang";
        } else {
            $overall = "Rendah";
        }

        return view('risiko.index', compact(
            'idr',
            'angin',
            'jumlahBerita',
            'kursStatus',
            'cuacaStatus',
            'beritaStatus',
            'trackingStatus',
            'overall'
        ));
    }
}