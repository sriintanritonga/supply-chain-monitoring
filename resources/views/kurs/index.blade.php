@extends('layouts.app')

@section('content')

<h2 class="mb-4">💰 Kurs Mata Uang Global</h2>

<div class="row">

    @foreach($rates as $currency => $rate)

    <div class="col-md-4 mb-4">

        <div class="card shadow border-0">

            <div class="card-body">

                <h4 class="text-primary">
                    💵 {{ $currency }}
                </h4>

                <hr>

                <p class="mb-2">
                    <strong>Nilai Tukar</strong>
                </p>

                <h3 class="text-success">
                    {{ number_format($rate,2) }}
                </h3>

                <small class="text-muted">
                    Berdasarkan 1 USD
                </small>

            </div>

        </div>

    </div>

    @endforeach

</div>

@endsection