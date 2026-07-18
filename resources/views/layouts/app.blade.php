<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistem Monitoring Risiko Global Supply Chain</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Style dari halaman lain -->
    @yield('styles')

    <style>
        :root {
            --color-navy: #091F46;
            --color-steel-blue: #37729C;
            --color-slate-mist: #7699AE;
            --color-washi: #E9E4DE;
            --color-gold: #EFBF6A;
            --color-terracotta: #A55D35;
        }

        body {
            background: var(--color-washi);
            color: #2b2b2b;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background: var(--color-navy);
            color: white;
            box-shadow: 4px 0 15px rgba(9, 31, 70, 0.15);
            z-index: 100;
            overflow-y: auto;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar::-webkit-scrollbar-track {
            background: var(--color-navy);
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 3px;
        }
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .sidebar h4 {
            padding: 25px 20px;
            text-align: center;
            font-weight: 800;
            letter-spacing: 1.5px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            margin-bottom: 15px;
            color: var(--color-gold);
            font-size: 1.3rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .sidebar a {
            color: #E9E4DE;
            text-decoration: none;
            display: block;
            padding: 14px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .sidebar a:hover {
            background: rgba(55, 114, 156, 0.2);
            color: white;
            padding-left: 30px;
            border-left: 4px solid var(--color-gold);
        }

        .content {
            margin-left: 250px;
            padding: 30px;
            background: var(--color-washi);
            min-height: calc(100vh - 56px);
        }

        /* Navbar Override */
        .navbar {
            margin-left: 250px;
            background: linear-gradient(90deg, var(--color-navy) 0%, var(--color-steel-blue) 100%) !important;
            padding: 15px 25px !important;
            border-bottom: 3px solid var(--color-gold);
        }

        /* Global Theme Color Overrides */
        .bg-primary {
            background-color: var(--color-navy) !important;
        }
        .text-primary {
            color: var(--color-navy) !important;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--color-steel-blue) 0%, var(--color-navy) 100%) !important;
            border: none !important;
            color: white !important;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 6px rgba(55, 114, 156, 0.2);
        }
        .btn-primary:hover {
            opacity: 0.9;
            transform: translateY(-1px);
            box-shadow: 0 6px 12px rgba(55, 114, 156, 0.3);
        }
        .card-header-gradient, .bg-primary.text-white {
            background: linear-gradient(135deg, var(--color-navy) 0%, var(--color-steel-blue) 100%) !important;
            border-bottom: 2px solid var(--color-gold) !important;
        }
        .btn-outline-warning {
            color: var(--color-terracotta) !important;
            border-color: var(--color-terracotta) !important;
            border-radius: 8px;
            font-weight: 600;
        }
        .btn-outline-warning:hover {
            background-color: var(--color-gold) !important;
            border-color: var(--color-gold) !important;
            color: var(--color-navy) !important;
        }
        
        /* Table and card header overrides for cohesion */
        .table-dark {
            background-color: var(--color-navy) !important;
            border-color: var(--color-navy) !important;
        }
        .table-dark th {
            background-color: var(--color-navy) !important;
            color: var(--color-gold) !important;
        }

        /* Add soft shadows to cards for natural papercut layering */
        .card {
            box-shadow: 0 4px 20px rgba(9, 31, 70, 0.05) !important;
            border: 1px solid rgba(118, 153, 174, 0.15) !important;
        }
    </style>

</head>

<body>

<!-- SIDEBAR -->

<div class="sidebar">

    <h4>Supply Chain</h4>

    <a href="{{ url('/') }}">
        🏠 Dashboard
    </a>

    <a href="{{ url('/admin') }}">
        🛠 Admin
    </a>

    <a href="{{ url('/shipment') }}">
        📦 Shipment
    </a>

    <a href="{{ url('/countries') }}">
        🌍 Negara
    </a>

    <a href="{{ url('/cuaca') }}">
        🌦 Cuaca
    </a>

    <a href="{{ url('/kurs') }}">
        💰 Kurs
    </a>

    <a href="{{ url('/berita') }}">
        📰 Berita
    </a>

    <a href="{{ url('/tracking') }}">
        🗺 Tracking
    </a>

    <!-- INI SUDAH DIPERBAIKI -->
    <a href="{{ url('/risiko') }}">
        ⚠ Risiko
    </a>

    <a href="{{ url('/ports') }}">
        🚢 Pelabuhan
    </a>

    <a href="{{ url('/comparison') }}">
        📊 Perbandingan
    </a>

    <a href="{{ url('/favorite') }}">
        ⭐ Favorit
    </a>

</div>

<!-- NAVBAR -->

<nav class="navbar navbar-dark bg-primary shadow">

    <div class="container-fluid">

        <span class="navbar-brand fw-bold">
            Sistem Monitoring Risiko Global Supply Chain
        </span>

    </div>

</nav>

<!-- CONTENT -->

<div class="content">

    @yield('content')

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

</body>
</html>