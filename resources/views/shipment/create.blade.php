@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">📦 Tambah Data Shipment</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('shipment.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Kode Pengiriman</label>
                    <input type="text" name="kode_pengiriman" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Negara Asal</label>
                    <input type="text" name="negara_asal" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Negara Tujuan</label>
                    <input type="text" name="negara_tujuan" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pelabuhan Asal</label>
                    <input type="text" name="pelabuhan_asal" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pelabuhan Tujuan</label>
                    <input type="text" name="pelabuhan_tujuan" class="form-control" required>
                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Berangkat</label>
                        <input type="date" name="tanggal_berangkat" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Estimasi Tiba</label>
                        <input type="date" name="estimasi_tiba" class="form-control" required>
                    </div>

                </div>

                <div class="mb-4">
                    <label class="form-label">Status Pengiriman</label>

                    <select name="status" class="form-select" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="Dalam Perjalanan">🚢 Dalam Perjalanan</option>
                        <option value="Tiba">✅ Tiba</option>
                        <option value="Tertunda">⚠ Tertunda</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">
                    💾 Simpan
                </button>

                <a href="{{ route('shipment.index') }}" class="btn btn-secondary">
                    ← Kembali
                </a>

            </form>

        </div>

    </div>

</div>

@endsection