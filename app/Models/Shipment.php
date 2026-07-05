<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable = [
        'kode_pengiriman',
        'negara_asal',
        'negara_tujuan',
        'pelabuhan_asal',
        'pelabuhan_tujuan',
        'tanggal_berangkat',
        'estimasi_tiba',
        'status'
    ];
}