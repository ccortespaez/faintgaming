<?php
   session_start(); //obtener sesión
   session_destroy(); //destruir todos los datos de la sesion
   header("Location:login.php"); //llevar al login
   exit();//detener script
