"use strict";

// MAIN
var oLibreria = new Libreria();

registrarEventos();

function registrarEventos() {
  // Opciones de menu
  document
    .getElementById("mnuCrearLibro")
    .addEventListener("click", mostrarFormulario);
  document
    .getElementById("mnuListado")
    .addEventListener("click", mostrarFormulario);
  // Botones
  frmCrearLibro.btnCrearLibro.addEventListener("click", procesarAltaLibro);
  frmListado.btnListado.addEventListener("click",procesarListado);
}

function mostrarFormulario(oEvento) {
  let opcion = oEvento.target.id;

  ocultarFormularios();

  switch (opcion) {
    case "mnuCrearLibro":
      cargarDesplegables();
      frmCrearLibro.classList.remove("d-none");

      break;
    case "mnuListado":
      cargarDesplegables();
      frmListado.classList.remove("d-none");
      break;
  }
}

function ocultarFormularios() {
  frmCrearLibro.classList.add("d-none");
  frmListado.classList.add("d-none");
}

async function cargarDesplegables() {
  let respuesta = await oLibreria.getGeneros();
  let options = "";
  if (respuesta.ok) {
    for (let genero of respuesta.datos) {
      options += `<option value="${genero.idgenero}">${genero.genero}</option>`;
    }

    frmCrearLibro.lstGenero.innerHTML = options;
    frmListado.lstGenero.innerHTML = options;
  } else {
    alert(
      "No se han podido cargar los generos literarios: " + respuesta.mensaje,
    );
  }
}

async function procesarAltaLibro() {
  // Recoger campos del formulario
  let titulo = frmCrearLibro.txtTitulo.value.trim();
  let autor = frmCrearLibro.txtAutor.value.trim();
  let descripcion = frmCrearLibro.txtDescripcion.value.trim();
  let imagen = frmCrearLibro.txtImagen.value.trim();
  let idgenero = frmCrearLibro.lstGenero.value.trim();

  // Validaciones no necesarias en el examen

  // Llamamos al servidor
  let respuesta = await oLibreria.crearLibro(new Libro(null, idgenero, titulo,autor, descripcion, imagen));

  alert(respuesta.mensaje);

  if(respuesta.ok){
    frmCrearLibro.reset();
    frmCrearLibro.classList.add("d-none"); 
  }
}

async function procesarListado() {
  let idgenero = frmListado.lstGenero.value.trim();
  let genero = frmListado.lstGenero.options[frmListado.lstGenero.selectedIndex].textContent;

  open("tarjetas.html?idgenero=" + idgenero + "&genero=" + genero);

  
}