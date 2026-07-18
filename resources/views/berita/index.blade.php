@extends('layouts.app')

@section('content')

@php
use Illuminate\Support\Str;
@endphp

<div class="container">

    <h2 class="mb-4">
        📰 Berita Global Supply Chain
    </h2>

    <div class="row">

        @forelse($berita as $item)

        <div class="col-md-6 mb-4">

            <div class="card h-100 shadow">

                @if(!empty($item['image']))
                    <img src="{{ $item['image'] }}"
                         class="card-img-top"
                         alt="Berita"
                         style="height:220px; object-fit:cover;"
                         onerror="this.src='https://placehold.co/600x220?text=No+Image';">
                @else
                    <img src="https://placehold.co/600x220?text=No+Image"
                         class="card-img-top"
                         alt="No Image"
                         style="height:220px; object-fit:cover;">
                @endif

                <div class="card-body">

                    <h5 class="card-title">
                        {{ $item['title'] }}
                    </h5>

                    <div class="mb-2">
                        @if(($item['sentiment'] ?? '') == 'Positif')
                            <span class="badge bg-success">😊 Positif</span>
                        @elseif(($item['sentiment'] ?? '') == 'Negatif')
                            <span class="badge bg-danger">😟 Negatif</span>
                        @else
                            <span class="badge bg-secondary">😐 Netral</span>
                        @endif
                    </div>

                    <p class="text-muted">
                        <strong>Sumber :</strong>
                        {{ $item['source']['name'] ?? '-' }}
                        <br>
                        <strong>Tanggal :</strong>
                        {{ date('d M Y', strtotime($item['publishedAt'])) }}
                    </p>

                    <p class="card-text">
                        {{ Str::limit($item['description'], 150) }}
                    </p>

                    <a href="{{ $item['url'] }}"
                       target="_blank"
                       class="btn btn-primary">
                        Baca Selengkapnya
                    </a>

                </div>

            </div>

        </div>

        @empty

        <div class="col-12">
            <div class="alert alert-warning">
                Tidak ada berita yang ditemukan.
            </div>
        </div>

        @endforelse

    </div>

</div>

@endsection