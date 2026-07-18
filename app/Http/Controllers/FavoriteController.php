<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Menampilkan semua data favorit
     */
    public function index()
    {
        $favorites = Favorite::latest()->get();

        return view('favorite.index', compact('favorites'));
    }

    /**
     * Menyimpan negara favorit
     */
    public function store(Request $request)
    {
        $request->validate([
            'country_code' => 'required',
            'country_name' => 'required',
        ]);

        Favorite::firstOrCreate(
            [
                'country_code' => $request->country_code,
            ],
            [
                'country_name' => $request->country_name,
                'region'       => $request->region,
                'flag'         => $request->flag,
            ]
        );

        return redirect()->route('favorite.index')
                         ->with('success', 'Negara berhasil ditambahkan ke favorit.');
    }

    /**
     * Menghapus negara favorit
     */
    public function destroy(string $id)
    {
        Favorite::findOrFail($id)->delete();

        return redirect()->route('favorite.index')
                         ->with('success', 'Negara berhasil dihapus dari favorit.');
    }
}