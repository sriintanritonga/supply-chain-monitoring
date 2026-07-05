<!DOCTYPE html>
<html>
<head>
    <title>Cuaca Global</title>

    <style>
        body{
            font-family: Arial;
            padding: 30px;
        }

        .card{
            width: 400px;
            padding: 20px;
            border: 1px solid #e9acac;
            border-radius: 10px;
        }

    </style>

</head>

<body>


<h1>Cuaca Global</h1>


<div class="card">


<h3>
🌡 Temperatur :
{{ $cuaca['current']['temperature_2m'] ?? 'Tidak ada data' }}
°C
</h3>



<h3>
💨 Kecepatan Angin :
{{ $cuaca['current']['wind_speed_10m'] ?? 'Tidak ada data' }}
km/h
</h3>



<h3>
🌧 Curah Hujan :
{{ $cuaca['hourly']['rain'][0] ?? 'Tidak ada data' }}
mm
</h3>



<h3>
⚠ Risiko Banjir :

@if(($cuaca['hourly']['rain'][0] ?? 0) > 10)

    Bahaya

@elseif(($cuaca['hourly']['rain'][0] ?? 0) > 5)

    Waspada

@else

    Aman

@endif

</h3>


</div>


</body>
</html>