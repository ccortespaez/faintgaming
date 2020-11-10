<?php
  //TODO: Con esta misma función se reutilizan el header y el footer
  require_once "../bd.php";


  $idEliminar = $_POST["idEliminar"];
  $sql = "DELETE FROM juegos WHERE id=?";//la sentencia sql

  $conexion = conectar();

  $respuesta = new stdClass();// let respuesta = {};

  if($conexion){ //si la conexion es exitosa
    //Eliminar el registro
    $st = $conexion->prepare($sql); //el statement perara la sentencia sql
    $st->bind_param("i",$idEliminar);//agrega las variables a eliminar
    $st->execute();// se ejecuta
    $st->close();// si se ejecuto exitosamente se cierra
    $respuesta->resultado = true; // el resultado de la respuesta pasa a true
  } else {
    //Falló la conexion
    $respuesta->resultado = false;
  }

  echo json_encode($respuesta);
