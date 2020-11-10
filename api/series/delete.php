<?php

  require_once "../bd.php";


  $idEliminar = $_POST["idEliminar"];
  $sql = "DELETE FROM series WHERE id=?";

  $conexion = conectar();

  $respuesta = new stdClass();

  if($conexion){

    $st = $conexion->prepare($sql);
    $st->bind_param("i",$idEliminar);
    $st->execute();
    $st->close();
    $respuesta->resultado = true;
  } else {

    $respuesta->resultado = false;
  }

  echo json_encode($respuesta);
