<?php

namespace App\Http\Controllers;

use App\Models\Shipment;

class DashboardController extends Controller
{
    public function index()
    {
        $totalShipment = Shipment::count();

        // Jumlah negara yang dimonitor
        $jumlahNegara = 10;

        return view('dashboard', compact(
            'totalShipment',
            'jumlahNegara'
        ));
    }
}