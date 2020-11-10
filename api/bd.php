<?php

   
      //Conexion BD
      //Las variables php parten con el signo $
      $mysqli = new mysqli("localhost","root","","juegosdb"); //Creamos la conexion con la base de datos con el nombre del servidor,usuario,pass,bd
      if ($mysqli->connect_error) {//Si la conexion da error de conexion retorna falso
        return false;
      }else{//sino la conexion se esta conectando con el charset utf8
        $mysqli->set_charset("utf8");
        //Devolver la conexion
        return $mysqli;
      }
    
