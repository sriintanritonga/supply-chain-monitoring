<?php

namespace App\Http\Controllers;

use App\Models\Shipment;

class TrackingController extends Controller
{
    public function index()
    {
        // Ambil shipment terbaru
        $shipment = Shipment::latest()->first();

        return view('tracking.index', compact('shipment'));
    }
}