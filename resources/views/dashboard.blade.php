@extends('layouts.app')

@section('content')

<h2 class="mb-4">Dashboard</h2>

<div class="row">

    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow">
            <div class="card-body">
                <h5>Total Shipment</h5>
                <h2>{{ $totalShipment }}</h2>
            </div>
        </div>
    </div>


    <div class="col-md-3 mb-3">
    <div class="card border-0 shadow">
        <div class="card-body">
            <h5>Negara</h5>
            <h2>{{ $jumlahNegara }}</h2>
        </div>
    </div>
</div>


    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow">
            <div class="card-body">
                <h5>Risiko Tinggi</h5>
                <h2>0</h2>
            </div>
        </div>
    </div>


    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow">
            <div class="card-body">
                <h5>Berita</h5>
                <h2>0</h2>
            </div>
        </div>
    </div>

</div>


<div class="row mt-4">


    <div class="col-md-8">

        <div class="card shadow">

            <div class="card-header">
                Grafik Kurs Mata Uang
            </div>


            <div class="card-body" style="height:350px;">

                Grafik Chart.js akan ditampilkan di sini.

            </div>


        </div>

    </div>


    <div class="col-md-4">

        <div class="card shadow">

            <div class="card-header">
                Skor Risiko
            </div>


            <div class="card-body">

                Belum ada data.

            </div>


        </div>

    </div>


</div>



<div class="card shadow mt-4">

    <div class="card-header">
        Tracking Pengiriman
    </div>


    <div class="card-body" style="height:400px;">

        Peta Leaflet.js akan ditampilkan di sini.

    </div>


</div>


@endsection