<?php
  require_once "../bd.php";


  $nombre = $_POST["nombre"];
  $descripcion = $_POST["descripcion"];
  $genero = $_POST["genero"];
  $descarga = $_POST["descarga"];


  $sql = "INSERT INTO peliculas(nombre,descripcion,genero,descarga)"." VALUES(?,?,?,?)";


  $mysqli = conectar();
  $respuesta = new stdClass();
  if ($mysqli) {
    $st = $mysqli->prepare($sql); 
    $st->bind_param("ssss",$nombre,$descripcion,$genero,$descarga);
    $st->execute();
    $st->close();
    $respuesta->resultado = true;
    $respuesta->comentario = "Pelicula ingresada exitosamente";
  }else{
    $respuesta->resultado = false;
  }
  echo json_encode($respuesta);
