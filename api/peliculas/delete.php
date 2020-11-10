<?php
  //TODO: Con esta misma función se reutilizan el header y el footer
  require_once "../bd.php";


  $idEliminar = $_POST["idEliminar"];
  $sql = "DELETE FROM peliculas WHERE id=?";

  $conexion = conectar();

  $respuesta = new stdClass();// let respuesta = {};

  if($conexion){
    //Eliminar el registro
    $st = $conexion->prepare($sql);
    $st->bind_param("i",$idEliminar);
    $st->execute();
    $st->close();
    $respuesta->resultado = true;
  } else {
    //Falló la conexion
    $respuesta->resultado = false;
  }

  echo json_encode($respuesta);
