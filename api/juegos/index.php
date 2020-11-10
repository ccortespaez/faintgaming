<?php
  require_once "../bd.php";

  $mysqli = conectar();
  $st = $mysqli->prepare("SELECT id,nombre,descripcion,genero,descarga FROM juegos");
  $st->execute();
  $result = $st->get_result();

  $lista = array();
  while($fila = $result->fetch_row()){
    $juego = new stdClass();
    $juego->id = $fila[0];
    $juego->nombre = $fila[1];
    $juego->descripcion = $fila[2];
    $juego->genero = $fila[3];
    $juego->descarga = $fila[4];
    $lista[]=$juego;
  }

  $st->close();
  echo json_encode($lista);
