<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistem Monitoring Risiko Global Supply Chain</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">


    <style>

        body{
            background:#f5f6fa;
        }


        .sidebar{

            width:250px;
            height:100vh;
            position:fixed;
            background:#212529;
            color:white;

        }


        .sidebar h4{

            padding:20px;
            text-align:center;

        }



        .sidebar a{

            color:white;
            text-decoration:none;
            display:block;
            padding:15px 20px;

        }



        .sidebar a:hover{

            background:#0d6efd;

        }



        .content{

            margin-left:250px;
            padding:20px;

        }



        .navbar{

            margin-left:250px;

        }


    </style>


</head>


<body>


<!-- SIDEBAR -->

<div class="sidebar">


    <h4>
        Supply Chain
    </h4>



    <a href="/">
        🏠 Dashboard
    </a>



    <a href="/shipment">
        📦 Shipment
    </a>



    <a href="/countries">🌍 Negara
    </a>


    <a href="/cuaca">
        🌦 Cuaca
    </a>



    <a href="kurs">
        💰 Kurs
    </a>



    <a href="#">
        📰 Berita
    </a>



    <a href="#">
        🗺 Tracking
    </a>



    <a href="#">
        ⚠ Risiko
    </a>



</div>




<!-- NAVBAR -->

<nav class="navbar navbar-dark bg-primary">


    <div class="container-fluid">


        <span class="navbar-brand">

            Sistem Monitoring Risiko Global Supply Chain

        </span>


    </div>


</nav>





<!-- CONTENT -->

<div class="content">


    @yield('content')


</div>





</body>

</html>