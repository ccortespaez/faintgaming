<?php
    session_start();
    if(!isset($_SESSION["rol"])){
       header("Location:login.php");
       exit();
    }

    $usuario = $_SESSION["rol"];

?>

<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
  <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/index3.css">
  <link rel="icon" href="img/icon.ico">
  <title>SERIES | FaintGaming</title>
</head>
<body>
  <header class="header-section">

<nav class="navbar navbar-expand-lg navbar-light bg-color1 sticky-top">
  <a class="navbar-brand  text-white" href="index.php"> <img src="img/game.png" width="85px" alt=""> </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">

      <li class="nav-item">
        <a class="nav-link text-white" href="index.php">Juegos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="peliCliente.php">Peliculas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="serieCliente.php">Series</a>
      </li>
      <li class="nav-item mt-2">
       <p class="text-white">Bienvenido <?php echo $usuario->nombre; ?> <a href="cerrar_sesion.php" >Cerrar sesión</a> </p>
      </li>
    </ul>
  </div>

</nav>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="img/rick.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="img/tronos.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="img/streng.jpg" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</header>
