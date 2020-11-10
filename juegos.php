<?php require_once "templates/header2.php";
  //TODO: Arreglar navbar para que navegue
  //TODO: Crear la tabla usuarios
  //TODO: Registrar manualmente algunos Usuarios
  //TODO: Generar la pagina de usuarios.php
  //TODO: Generar el Login *
?>


  <main class="container-fluid mt-3">
    <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-12 mx-auto">
        <div class="card">
          <div class="card-header bg-color-1 text-white text-center font-cine">
            <img class="img-fluid" src="img/xbox.png">
            <span class="pr-3">Ingresar Juegos</span>
          </div>
          <div class="card-body bg-borial">
            <div class="cont-errores">

            </div>

            <div class="form-group">
              <label for="nombre-txt" class="pl-2">Nombre Juego</label>
              <img class="img-fluid" src="img/pacman.png">
              <input type="text" id="nombre-txt" class="form-control">
            </div>

            <div class="form-group">
              <label for="descripcion-txt"class="pl-2">Descripcion</label>
              <img class="img-fluid" src="img/description.png">
              <textarea id="descripcion-txt" ></textarea>
            </div>

            <div class="form-group">
              <label for="genero-cbx"class="pl-2">Genero Juego</label>
              <img class="img-fluid" src="img/videogame.png">
              <select class="form-control" id="genero-cbx">
                <option value="Accion">Accion</option>
                <option value="Aventura">Aventura</option>
                <option value="Carreras">Carreras</option>
                <option value="Terror">Terror</option>
              </select>
            </div>

            <div class="form-group">
              <label for="descarga-txt" class="pl-2">Enlace de Descarga</label>
              <img class="img-fluid" src="img/download.png">
              <input type="text" id="descarga-txt" class="form-control">
            </div>

          <div class="card-footer">
            <button type="button" class="btn bg-color-1 text-white" id="agregar-btn">Agregar</button>
            <button type="button" class="btn bg-color-2 float-right text-white"
              id="limpiar-btn">Limpiar</button>
          </div>
        </div>


    </div>
  </main>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <?php require_once "templates/footer2.php"; ?>
