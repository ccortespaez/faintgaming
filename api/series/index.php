<?php
  require_once "../bd.php";

  $mysqli = conectar();
  $st = $mysqli->prepare("SELECT id,nombre,descripcion,genero,descarga FROM series");
  $st->execute();
  $result = $st->get_result();

  $lista = array();
  while($fila = $result->fetch_row()){
    $serie = new stdClass();
    $serie->id = $fila[0];
    $serie->nombre = $fila[1];
    $serie->descripcion = $fila[2];
    $serie->genero = $fila[3];
    $serie->descarga = $fila[4];
    $lista[]=$serie;
  }

  $st->close();
  echo json_encode($lista);
