
window.descartarJuegos = function(){
  let botonClickeado = this; // selecciona el boton
  let idEliminar = botonClickeado.idEliminar; //se verifica el id de que se va eliminar
  let form =new FormData();//agrega los datos al form data seleccionados a traves del id
  form.append("idEliminar",idEliminar);

  axios.post("api/juegos/delete.php",form) //envia los datos del form data y ejecuta el php
        .then(function(respuesta){
        window.obtenerJuegos();//muestra los juegos actules
 });

};



window.obtenerJuegos = function(){//obtiene los juegos y los carga
  axios.get('api/juegos').then(function(respuesta){
    window.cargarJuegos(respuesta.data);
  });
};

window.cargarJuegos = function(juegos){
   let cuerpo = document.querySelector("#columnas-card"); //creamos el cuerpo donde se crearan los card
   cuerpo.innerHTML = ''; //limpiamos el cuerpo


   for(let i=0; i < juegos.length; ++i){ //Se recorre el arreglo de juegos
     let juegoActual = juegos[i]; //El juego actual ingresado sera igual al indice del juego
     let card = document.createElement('div'); //se crea el div card
     card.classList.add('card'); //se le añade la clase card

     let cardBody = document.createElement('div');
     cardBody.classList.add('card-body');
     let cardTitle = document.createElement('h5');
     let parrafo = document.createElement('p');
     let genero = document.createElement("img");
     switch (juegoActual.genero) {
       case "Accion":
          genero.src = "img/actionjg.png";
          break;
       case "Aventura":
          genero.src = "img/map.png";
          break;
       case "Carreras":
          genero.src="img/end.png";
          break;
       case "Terror":
          genero.src="img/ghost.png";
          break;
        default:

     }
     genero.style.width = "30px"; //le modifica la imagen del genero a un 30px

     let cardFooter = document.createElement('div');
     cardFooter.classList.add('card-footer');
     let descarga=document.createElement("a");
     descarga.classList.add("btn","bg-primary","text-white");
     descarga.href=juegoActual.descarga;
     descarga.innerText="Descargar";



     let botonEliminar  = document.createElement('button');
     botonEliminar.classList.add("btn","eliminar",'float-right');
     botonEliminar.innerText = "Eliminar"; //se añade el texto eliminar
     botonEliminar.idEliminar = juegoActual.id; //el id a eliminar sera igual al id del juego actual, el boton esta asociado con el indice de los juegos
     botonEliminar.addEventListener('click', window.descartarJuegos); //el escuchador se ejecuta cuando el usuario de un click en el boton de descartar


     cardTitle.innerText = juegoActual.nombre; //el card title se le asigna el nombre del juego
     parrafo.innerHTML = juegoActual.descripcion;//el card title se le asigna la descripcion del juego
     genero.innerHTML = juegoActual.genero;//el card title se le asigna el genero del juego


     card.appendChild(cardBody); //dentro del card añadimos un card-body
     card.appendChild(cardFooter);//dentro del card añadimos un card-footer
     cardBody.appendChild(cardTitle);//dentro del card-body añadimos un card-title
     cardBody.appendChild(parrafo);//dentro del card-body añadimos el parrafo que seria la descripcion
     cardBody.appendChild(genero); //dentro del card-body añadimos el genero
     cardFooter.appendChild(descarga);//dentro del card-footer añadimos el boton de descargar
     cardFooter.appendChild(botonEliminar);//dentro del card-footer añadimos el boton de eliminar
     cuerpo.appendChild(card);//al cuerpo limpiado se le almacena el card de juego

   }
};
(function(){
  window.obtenerJuegos();
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

  document.querySelector("#agregar-btn").addEventListener('click', function(){ //Escuchador
    let errores = []; //Creamos un arreglo de errores
    let nombre = document.querySelector("#nombre-txt").value; //Creamos una variable que se le asigna el valor del nombre con querySelector
    let genero = document.querySelector("#genero-cbx").value; //Creamos una variable que se le asigna el valor del genero
    let descripcion = tinymce.get('descripcion-txt').getContent(); //Creamos una variable que se le asigna el valor de la descripcion
    let descarga = document.querySelector("#descarga-txt").value;  //Creamos una variable que se le asigna el valor del link de descarga
    if (nombre.length === 0) {
      errores.push('Ingrese un nombre');
    }
    if (descripcion.length === 0) {
      errores.push('Ingrese una descripcion');
    }

    if (descarga.length===0) {
      errores.push("Ingrese un url valido");
    }

    let cont = document.querySelector(".cont-errores");
    cont.innerHTML = '';


    if(errores.length === 0){
      let nuevoJuego = {};
      nuevoJuego.nombre = nombre;
      nuevoJuego.descripcion = descripcion;
      nuevoJuego.genero = genero;
      nuevoJuego.descarga = descarga;


      //insertar en la db
      //empaquetan los datos para enviarlas a php
      let formData = new FormData(); //
      formData.append('nombre',nuevoJuego.nombre); //recibe el valor del nombre
      formData.append('descripcion',nuevoJuego.descripcion);
      formData.append('genero',nuevoJuego.genero);
      formData.append('descarga',nuevoJuego.descarga);

      axios.post('api/juegos/create.php',formData)//Con la funcion axios se envian los datos a php a create.php
        .then(function(respuesta){//cuando se resuelva la promesa (con then)
          let mensaje = document.querySelector('#mensaje-modal .modal-body .alert'); //
          if (respuesta.data.resultado) {//Si es verdadero
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
      window.obtenerJuegos();
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
