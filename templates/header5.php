<?php
    session_start(); //agregar para usar la sesion
    if(!isset($_SESSION["rol"])){
       header("Location:login.php");
       exit();
    }

    $usuario = $_SESSION["rol"];

?>

<!doctype html>
<html lang="es">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="css/juegos.css">
  <link rel="stylesheet" href="css/card.css">
  <link rel="icon" href="img/icon.ico">
  <title>ADMINISTRACIÓN | FaintGaming</title>
</head>
<body class="bg-bodysr">

  <div class="modal fade" id="mensaje-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Serie agregada</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="alert alert-primary">La Serie se agrego con exito.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal -->

  <header class="text-white ">

    <nav class="navbar navbar-expand-lg navbar-light bg-color-1">
      <a class="navbar-brand  text-white" href="index.html"> <img src="img/game.png" width="85px" alt=""> </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white"  id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Gestor de Juegos
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="juegos.php">Ingresar Juegos</a>
              <a class="dropdown-item" href="mostrar.php">Mostrar Juegos</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white"  id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Gestor de Peliculas
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="peliculas.php">Ingresar Peliculas</a>
              <a class="dropdown-item" href="mostrarpeli.php">Mostrar Peliculas</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white"  id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Gestor de Series
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="series.php">Ingresar Series</a>
              <a class="dropdown-item" href="mostrarserie.php">Mostrar Series</a>
            </div>
          </li>

          <li class="nav-item mt-2">
            <p class="text-white">Bienvenido <?php echo $usuario->nombre; ?> <a href="cerrar_sesion.php" >Cerrar sesión</a> </p>
          </li>
        </ul>
      </div>
    </nav>


  </header>
