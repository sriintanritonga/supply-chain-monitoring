@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="fw-bold text-primary mb-4">
        ⭐ Favorite Countries
    </h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($favorites->count())

    <div class="row">

        @foreach($favorites as $favorite)

        <div class="col-md-4 mb-4">

            <div class="card shadow h-100">

                @if($favorite->flag)
                    <img src="{{ $favorite->flag }}"
                         class="card-img-top"
                         style="height:180px;object-fit:cover;">
                @endif

                <div class="card-body">

                    <h4>{{ $favorite->country_name }}</h4>

                    <p>
                        🌍 {{ $favorite->region }}
                    </p>

                    <form action="{{ route('favorite.destroy',$favorite->id) }}"
                          method="POST">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger w-100">
                            🗑 Hapus Favorit
                        </button>

                    </form>

                </div>

            </div>

        </div>

        @endforeach

    </div>

    @else

    <div class="alert alert-warning">

        Belum ada negara favorit.

    </div>

    @endif

</div>

@endsection