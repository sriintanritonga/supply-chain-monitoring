<!DOCTYPE html>
<html>

<head>

<title>Data Negara</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>


<body>

<div class="container mt-4">


<h2>
🌍 Data Negara - World Bank API
</h2>


<div class="row mt-4">


<div class="col-md-3">
<div class="card shadow">
<div class="card-body">

<h5>Negara</h5>

<h3>
{{ $negara }}
</h3>

</div>
</div>
</div>



<div class="col-md-3">
<div class="card shadow">
<div class="card-body">

<h5>👥 Populasi</h5>

<h3>
{{ number_format($populasi) }}
</h3>

</div>
</div>
</div>



<div class="col-md-3">
<div class="card shadow">
<div class="card-body">

<h5>💰 GDP</h5>

<h3>
{{ number_format($gdp) }}
</h3>

</div>
</div>
</div>



<div class="col-md-3">
<div class="card shadow">
<div class="card-body">

<h5>📈 Inflasi</h5>

<h3>
{{ $inflasi }} %
</h3>

</div>
</div>
</div>


</div>



<div class="card shadow mt-4">

<div class="card-body">

<h4>⚠ Risiko Negara</h4>


@if($inflasi > 5)

<p>Risiko Ekonomi Tinggi</p>

@else

<p>Risiko Ekonomi Aman</p>

@endif


</div>

</div>


</div>


</body>

</html>