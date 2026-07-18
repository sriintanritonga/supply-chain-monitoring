<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class BeritaController extends Controller
{
    public function index()
    {
        $apiKey = '05ba51dc090909641c8e3e7cfcbb3f75';

        $response = Http::get('https://gnews.io/api/v4/top-headlines', [
            'category' => 'business',
            'lang' => 'en',
            'country' => 'us',
            'max' => 10,
            'apikey' => $apiKey,
        ]);

        $berita = [];

        if ($response->successful()) {
            $data = $response->json();

            if (isset($data['articles'])) {
                $berita = collect($data['articles'])->map(function ($item) {
                    $title = $item['title'] ?? '';
                    $description = $item['description'] ?? '';
                    $text = strtolower($title . ' ' . $description);

                    // Sentimen analis berbasis kata kunci (Rule-based Keyword Matching)
                    $negKeywords = ['crisis', 'shortage', 'conflict', 'risk', 'drop', 'fail', 'inflation', 'loss', 'strike', 'blockade', 'delay', 'collapse', 'disruption', 'threat', 'warn'];
                    $posKeywords = ['growth', 'boost', 'rise', 'deal', 'improve', 'success', 'stable', 'recover', 'gain', 'expand', 'agree', 'ease', 'safe'];

                    $negHits = 0;
                    $posHits = 0;

                    foreach ($negKeywords as $kw) {
                        if (str_contains($text, $kw)) $negHits++;
                    }

                    foreach ($posKeywords as $kw) {
                        if (str_contains($text, $kw)) $posHits++;
                    }

                    if ($negHits > $posHits) {
                        $sentiment = 'Negatif';
                    } elseif ($posHits > $negHits) {
                        $sentiment = 'Positif';
                    } else {
                        $sentiment = 'Netral';
                    }

                    $item['sentiment'] = $sentiment;
                    return $item;
                })->toArray();
            }
        }

        return view('berita.index', compact('berita'));
    }
}