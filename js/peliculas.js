

window.descartarPeliculas = function(){
  let botonClickeado = this;
  let idEliminar = botonClickeado.idEliminar;
  let form =new FormData();
  form.append("idEliminar",idEliminar);

  axios.post("api/peliculas/delete.php",form)
        .then(function(respuesta){
        window.obtenerPeliculas();
 });

};



window.obtenerPeliculas = function(){
  axios.get('api/peliculas').then(function(respuesta){
    window.cargarPeliculas(respuesta.data);
  });
};

window.cargarPeliculas = function(peliculas){
   let cuerpo = document.querySelector("#columnass-card");
   cuerpo.innerHTML = '';


   for(let i=0; i < peliculas.length; ++i){
     let peliculaActual = peliculas[i];
     let card = document.createElement('div');
     card.classList.add('card');


     let cardBody = document.createElement('div');
     cardBody.classList.add('card-body');
     let cardTitle = document.createElement('h5');
     let parrafo = document.createElement('p');
     let genero = document.createElement("img");
     switch (peliculaActual.genero) {
       case "Accion":
          genero.src = "img/actionpl.png";
          break;
       case "Infantil":
          genero.src = "img/children.png";
          break;
       case "Comedia":
          genero.src="img/film.png";
          break;
       case "Terror":
          genero.src="img/pumpkin.png";
          break;
        default:

     }
     genero.style.width = "30px";

     let cardFooter = document.createElement('div');
     cardFooter.classList.add('card-footer');


     let descarga=document.createElement("a");
     descarga.classList.add("btn","bg-primary","text-white");
     descarga.href=peliculaActual.descarga;
     descarga.innerText="Descargar";


     let botonEliminar  = document.createElement('button');
     botonEliminar.classList.add("btn","eliminar",'float-right');
     botonEliminar.innerText = "Eliminar";
     botonEliminar.idEliminar = peliculaActual.id;
     botonEliminar.addEventListener('click', window.descartarPeliculas);


     cardTitle.innerText = peliculaActual.nombre;
     parrafo.innerHTML = peliculaActual.descripcion;
     genero.innerHTML = peliculaActual.genero;

     card.appendChild(cardBody);
     card.appendChild(cardFooter);
     cardBody.appendChild(cardTitle);
     cardBody.appendChild(parrafo);
     cardBody.appendChild(genero);
     cardFooter.appendChild(descarga);
     cardFooter.appendChild(botonEliminar);
     cuerpo.appendChild(card);



   }
};
(function(){
  window.obtenerPeliculas();
  tinymce.init({
    selector: '#descripcion-txt'
  });



  window.mostrarErrores = function(errores){
      let cont = document.querySelector(".cont-errores");
      let ul = document.createElement('ul');
      ul.classList.add('alert','alert-warning');
      for (let i = 0; i < errores.length; i++) {
         let error = errores[i];
         let li = document.createElement('li');
         li.textContent = error;
         ul.appendChild(li);
      }
      cont.appendChild(ul);
  };

  document.querySelector("#agregar-btn").addEventListener('click', function(){
    let errores = [];
    let nombre = document.querySelector("#nombre-txt").value;
    let genero = document.querySelector("#genero-cbx").value;
    let descripcion = tinymce.get('descripcion-txt').getContent();
    let descarga = document.querySelector("#descarga-txt").value;
    if (nombre.length === 0) {
      errores.push('Ingrese un nombre');
    }
    if (descripcion.length === 0) {
      errores.push('Ingrese una descripcion');
    }
    if (descarga.length === 0) {
      errores.push('Ingrese un Link de Descarga');
    }
    let cont = document.querySelector(".cont-errores");
    cont.innerHTML = '';

    if(errores.length === 0){
      let nuevaPelicula = {};
      nuevaPelicula.nombre = nombre;
      nuevaPelicula.descripcion = descripcion;
      nuevaPelicula.genero = genero;
      nuevaPelicula.descarga = descarga;


      //insertar en la db
      let formData = new FormData();
      formData.append('nombre',nuevaPelicula.nombre);
      formData.append('descripcion',nuevaPelicula.descripcion);
      formData.append('genero',nuevaPelicula.genero);
      formData.append('descarga',nuevaPelicula.descarga);

      axios.post('api/peliculas/create.php',formData)
        .then(function(respuesta){
          let mensaje = document.querySelector('#mensaje-modal .modal-body .alert');
          if (respuesta.data.resultado) {
            mensaje.classList.remove('alert-danger');
            mensaje.classList.add('alert-primary');
            mensaje.innerText = respuesta.data.comentario;
          }else{
            mensaje.classList.remove('alert-primary');
            mensaje.classList.add('alert-danger');
            mensaje.innerText = "Fallo en la conexion";
          }
            $("#mensaje-modal").modal("show");
        });
      window.obtenerPeliculas();
    }else{
      window.mostrarErrores(errores);
    }
  });

  document.querySelector("#limpiar-btn").addEventListener('click', function(){
    document.querySelector("#nombre-txt").value = "";
    document.querySelector("#genero-cbx").selectedIndex = 0;
    tinymce.activeEditor.setContent("");
    document.querySelector("#descarga-txt").value = "";
  });


})();
