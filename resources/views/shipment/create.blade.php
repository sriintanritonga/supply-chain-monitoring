<!DOCTYPE html>
<html>
<head>
    <title>Tambah Shipment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h2>Tambah Shipment</h2>

<form action="/shipment" method="POST">
    @csrf

    <input type="text" name="kode_pengiriman" class="form-control mb-2" placeholder="Kode Pengiriman">

    <input type="text" name="negara_asal" class="form-control mb-2" placeholder="Negara Asal">

    <input type="text" name="negara_tujuan" class="form-control mb-2" placeholder="Negara Tujuan">

    <input type="text" name="pelabuhan_asal" class="form-control mb-2" placeholder="Pelabuhan Asal">

    <input type="text" name="pelabuhan_tujuan" class="form-control mb-2" placeholder="Pelabuhan Tujuan">

    <input type="date" name="tanggal_berangkat" class="form-control mb-2">

    <input type="date" name="estimasi_tiba" class="form-control mb-2">

    <input type="text" name="status" class="form-control mb-2" placeholder="Status">

    <button class="btn btn-success">Simpan</button>
</form>

</body>
</html>