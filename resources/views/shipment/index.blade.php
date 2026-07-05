<!DOCTYPE html>
<html>
<head>
    <title>Data Shipment</title>
</head>

<body>

<h1>Data Shipment</h1>

<table border="1" cellpadding="10">

<tr>
    <th>ID</th>
    <th>Kode Pengiriman</th>
    <th>Negara Asal</th>
    <th>Negara Tujuan</th>
    <th>Pelabuhan Asal</th>
    <th>Pelabuhan Tujuan</th>
    <th>Tanggal Berangkat</th>
    <th>Estimasi Tiba</th>
    <th>Status</th>
</tr>


@foreach($shipments as $shipment)

<tr>

<td>{{ $shipment->id }}</td>

<td>{{ $shipment->kode_pengiriman }}</td>

<td>{{ $shipment->negara_asal }}</td>

<td>{{ $shipment->negara_tujuan }}</td>

<td>{{ $shipment->pelabuhan_asal }}</td>

<td>{{ $shipment->pelabuhan_tujuan }}</td>

<td>{{ $shipment->tanggal_berangkat }}</td>

<td>{{ $shipment->estimasi_tiba }}</td>

<td>{{ $shipment->status }}</td>

</tr>

@endforeach


</table>

</body>
</html>