<?php require_once "templates/header3.php";

?>

<main class="container-fluid mt-3">
  <div class="row">
    <div class="col-lg-4 col-md-6 col-sm-12 mx-auto">
      <div class="card">
        <div class="card-header bg-color-2 text-white font-cine2 text-center ">
          <img class="img-fluid" src="img/popcorn.png">
          <span class="pr-3">Ingresar Peliculas</span>

        </div>
        <div class="card-body bg-cine text-white">
          <div class="cont-errores">

          </div>
          <div class="form-group">
            <label for="nombre-txt" class="pl-2">Nombre Pelicula</label>
            <img class="img-fluid" src="img/movie.png">
            <input type="text" id="nombre-txt" required class="form-control">
          </div>

          <div class="form-group">
            <label for="descripcion-txt" class="pl-2">Descripcion</label>
            <img class="img-fluid" src="img/description.png">
            <textarea id="descripcion-txt" ></textarea>
          </div>

          <div class="form-group">
            <label for="genero-cbx"class="pl-2">Genero Pelicula</label>
            <img class="img-fluid" src="img/clapper.png">
            <select class="form-control" id="genero-cbx">
              <option value="Accion">Accion</option>
              <option value="Infantil">Infantil</option>
              <option value="Comedia">Comedia</option>
              <option value="Terror">Terror</option>
            </select>
          </div>

          <div class="form-group">
            <label for="descarga-txt"class="pl-2">Enlace de Descarga</label>
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

<?php require_once "templates/footer3.php"; ?>
