<?php
  require_once "../bd.php";

  $mysqli = conectar();
  $st = $mysqli->prepare("SELECT id,nombre,descripcion,genero,descarga FROM peliculas");
  $st->execute();
  $result = $st->get_result();

  $lista = array();
  while($fila = $result->fetch_row()){
    $pelicula = new stdClass();
    $pelicula->id = $fila[0];
    $pelicula->nombre = $fila[1];
    $pelicula->descripcion = $fila[2];
    $pelicula->genero = $fila[3];
    $pelicula->descarga = $fila[4];
    $lista[]=$pelicula;
  }

  $st->close();
  echo json_encode($lista);
