@extends('layouts.app')

@section('content')

<h2 class="mb-4">
    🌍 Data Negara Global
</h2>

<div class="row">

@foreach($countries as $country)

<div class="col-md-4 mb-4">

<div class="card shadow border-0 h-100">

<div class="card-header bg-primary text-white">

<h5 class="mb-0">
🌍 {{ $country['name'] }}
</h5>

</div>

<div class="card-body">

<p>

👥 <strong>Populasi</strong>

<br>

{{ number_format($country['population']) }}

</p>

<hr>

<p>

💰 <strong>GDP</strong>

<br>

USD {{ number_format($country['gdp'],0,',','.') }}

</p>

<hr>

<p>

📈 <strong>Inflasi</strong>

<br>

{{ number_format($country['inflation'],2) }} %

</p>

<hr>

<p>

⚠ <strong>Status Risiko</strong>

<br>

@if($country['risk']=='Tinggi')

<span class="badge bg-danger fs-6">
🔴 {{ $country['risk'] }}
</span>

@elseif($country['risk']=='Sedang')

<span class="badge bg-warning text-dark fs-6">
🟡 {{ $country['risk'] }}
</span>

@else

<span class="badge bg-success fs-6">
🟢 {{ $country['risk'] }}
</span>

@endif

</p>

</div>

</div>

</div>

@endforeach

</div>

@endsection