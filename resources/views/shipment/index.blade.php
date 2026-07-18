@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">📦 Data Shipment</h2>

        <a href="{{ route('shipment.create') }}" class="btn btn-primary">
            + Tambah Shipment
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-striped table-hover align-middle">

                    <thead class="table-dark">

                        <tr>
                            <th>ID</th>
                            <th>Kode</th>
                            <th>Negara Asal</th>
                            <th>Negara Tujuan</th>
                            <th>Pelabuhan Asal</th>
                            <th>Pelabuhan Tujuan</th>
                            <th>Berangkat</th>
                            <th>Estimasi</th>
                            <th>Status</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($shipments as $shipment)

                        <tr>

                            <td>{{ $shipment->id }}</td>

                            <td>{{ $shipment->kode_pengiriman }}</td>

                            <td>{{ $shipment->negara_asal }}</td>

                            <td>{{ $shipment->negara_tujuan }}</td>

                            <td>{{ $shipment->pelabuhan_asal }}</td>

                            <td>{{ $shipment->pelabuhan_tujuan }}</td>

                            <td>{{ $shipment->tanggal_berangkat }}</td>

                            <td>{{ $shipment->estimasi_tiba }}</td>

                            <td>

                                @if($shipment->status == 'Dalam Perjalanan')
                                    <span class="badge bg-warning text-dark">
                                        🚢 Dalam Perjalanan
                                    </span>

                                @elseif($shipment->status == 'Tiba')
                                    <span class="badge bg-success">
                                        ✅ Tiba
                                    </span>

                                @elseif($shipment->status == 'Tertunda')
                                    <span class="badge bg-danger">
                                        ⚠ Tertunda
                                    </span>

                                @else
                                    <span class="badge bg-secondary">
                                        {{ $shipment->status }}
                                    </span>
                                @endif

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="9" class="text-center">
                                Belum ada data shipment.
                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection