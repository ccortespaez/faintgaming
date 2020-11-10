window.descartarSeries = function(){
  let botonClickeado = this;
  let idEliminar = botonClickeado.idEliminar;
  let form =new FormData();
  form.append("idEliminar",idEliminar);

  axios.post("api/series/delete.php",form)
        .then(function(respuesta){
        window.obtenerSeries();
 });

};



window.obtenerSeries = function(){
  axios.get('api/series').then(function(respuesta){
    window.cargarSeries(respuesta.data);
  });
};

window.cargarSeries = function(series){
   let cuerpo = document.querySelector("#columnas3-card");
   cuerpo.innerHTML = '';


   for(let i=0; i < series.length; ++i){
     let serieActual = series[i];
     let card = document.createElement('div');
     card.classList.add('card');


     let cardBody = document.createElement('div');
     cardBody.classList.add('card-body');
     let cardTitle = document.createElement('h5');
     let parrafo = document.createElement('p');
     let genero = document.createElement("img");
     switch (serieActual.genero) {
       case "Drama":
          genero.src = "img/masks.png";
          break;
       case "Ciencia Ficcion":
          genero.src = "img/ufo.png";
          break;
       case "Comedia Animada":
          genero.src="img/hat.png";
          break;
       case "Romance":
          genero.src="img/love.png";
          break;
        default:

     }
     genero.style.width = "30px";

     let cardFooter = document.createElement('div');
     cardFooter.classList.add('card-footer');


     let descarga=document.createElement("a");
     descarga.classList.add("btn","bg-primary","text-white");
     descarga.href=serieActual.descarga;
     descarga.innerText="Descargar";


     let botonEliminar  = document.createElement('button');
     botonEliminar.classList.add("btn","eliminar",'float-right');
     botonEliminar.innerText = "Eliminar";
     botonEliminar.idEliminar = serieActual.id;
     botonEliminar.addEventListener('click', window.descartarSeries);

     cardTitle.innerText = serieActual.nombre;
     parrafo.innerHTML = serieActual.descripcion;
     genero.innerHTML = serieActual.genero;

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
  window.obtenerSeries();
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
      let nuevaSerie = {};
      nuevaSerie.nombre = nombre;
      nuevaSerie.descripcion = descripcion;
      nuevaSerie.genero = genero;
      nuevaSerie.descarga = descarga;


      //insertar en la db
      let formData = new FormData();
      formData.append('nombre',nuevaSerie.nombre);
      formData.append('descripcion',nuevaSerie.descripcion);
      formData.append('genero',nuevaSerie.genero);
      formData.append('descarga',nuevaSerie.descarga);

      axios.post('api/series/create.php',formData)
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
      window.obtenerSeries();
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
