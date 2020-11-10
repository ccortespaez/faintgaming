
<?php

    session_start(); //agregar para usar la sesion
    if(isset($_SESSION["rol"])){


    }

    require_once "api/bd.php";
    if(count($_POST)>0){ //Si es que mandaron algo por POST
      $correo = $_POST["usuario-txt"];
      $clave = sha1($_POST["clave-txt"]);
      //construir select
      $sql = "SELECT id,nombre,correo,clave,rol_id FROM usuarios2 WHERE correo=? AND clave=?";
      //conectar bd
      $conexion = conectar();
      //preparar select
      $st = $conexion->prepare($sql);
      //agregar parametros, reemplazar ?
      $st->bind_param("ss",$correo,$clave);
      //Ejecutar query
      $st->execute();
      //revisar el resultado
      $res = $st->get_result();
      if($fila = $res->fetch_row()){//si entra a este if, el usuario era correcto
          $usuario = new stdClass();
          $usuario->id = $fila[0];
          $usuario->nombre = $fila[1];
          $usuario->correo = $fila[2];
          $usuario->clave = $fila[3];
          $usuario->rol_id = $fila[4];
          $_SESSION["rol"] =$usuario;//guardar usuario en sesion
          if ($_SESSION["rol"]->rol_id==1) {
            header("Location:juegos.php");
            exit();
          }
          if ($_SESSION["rol"]->rol_id==2) {
            header("Location:index.php");
            exit();
          }


      } else { //el usuario no existia
          $error = "Datos incorrectos";
      }

    }
?>
<html lang="es">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/login.css">
  <link rel="icon" href="img/icon.ico">
  <title>LOGIN | FaintGaming</title>
</head>
<body class="bg-login">
  <main>
    <form method="post" class="row mt-5">
      <?php if(isset($error)){
        ?>
        <div class="alert alert-warning col-lg-12 col-md-12 col-sm-12 mx-auto">
          <span><?php echo $error; ?></span>
        </div>
        <?php
         } ?>


      <div class="col-lg-9 col-md-6 col-sm-10 mx-auto">
        <div class="card bg-color1">

          <img class="img-fluid2" src="img/game.png">
          <div class="card-body">
            <div class="cont-errores">

            </div>

            <img class="img-fluid" src="img/user.png">
            <div class="form-group text-white">
              <label for="usuario-txt" class="pl-2">Usuario</label>
              <input type="email" class="form-control" required name="usuario-txt" value="">
            </div>

            <img class="img-fluid" src="img/key.png">

            <div class="form-group text-white">
              <label for="clave-txt" class="pl-2">Contraseña</label>
              <input type="password" class="form-control" required name="clave-txt" value="">
            </div>

            <div class="form-group2">
              <button type="submit" class="btn bg-color2 text-white" name="ingresar-btn">Iniciar Sesión</button>
            </div>

          </div>
        </div>

      </div>
      </form>
    </main>

      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  </body>
  </html>
