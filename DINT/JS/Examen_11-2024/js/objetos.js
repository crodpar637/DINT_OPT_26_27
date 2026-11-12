"use strict";

class Libro {
  #idlibro;
  #idgenero;
  #titulo;
  #autor;
  #descripcion;
  #imagen;

  constructor(idlibro, idgenero, titulo, autor, descripcion, imagen) {
    this.#idlibro = idlibro;
    this.#idgenero = idgenero;
    this.#titulo = titulo;
    this.#autor = autor;
    this.#descripcion = descripcion;
    this.#imagen = imagen;
  }
  get idlibro() {
    return this.#idlibro;
  }
  set idlibro(valor) {
    this.#idlibro = valor;
  }
  get idgenero() {
    return this.#idgenero;
  }
  set idgenero(valor) {
    this.#idgenero = valor;
  }
  get titulo() {
    return this.#titulo;
  }
  set titulo(valor) {
    this.#titulo = valor;
  }
  get descripcion() {
    return this.#descripcion;
  }
  set descripcion(valor) {
    this.#descripcion = valor;
  }
  get autor() {
    return this.#autor;
  }
  set autor(valor) {
    this.#autor = valor;
  }
  get imagen() {
    return this.#imagen;
  }
  set imagen(valor) {
    this.#imagen = valor;
  }

  toJSON() {
    return {
      idlibro: this.#idlibro,
      idgenero: this.#idgenero,
      titulo: this.#titulo,
      autor: this.#autor,
      descripcion: this.#descripcion,
      imagen: this.#imagen,
    };
  }
}

class Genero {
  #idgenero;
  #genero;

  constructor(idgenero, genero) {
    this.#idgenero = idgenero;
    this.#genero = genero;
  }

  get idgenero() {
    return this.#idgenero;
  }
  set idgenero(valor) {
    this.#idgenero = valor;
  }

  get genero() {
    return this.#genero;
  }
  set genero(valor) {
    this.#genero = valor;
  }

  toJSON() {
    return {
      idgenero: this.#idgenero,
      genero: this.#genero,
    };
  }
}

class Libreria {
    async crearLibro(oLibro){

    }
    async getLibrosGenero(idgenero){

    }
    async getGeneros(){
        return await peticionGET("get_generos.php", new FormData());
    }
}