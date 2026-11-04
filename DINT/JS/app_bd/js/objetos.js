"use strict";

class Tipo {
  #idtipo;
  #tipo;
  #descripcion;
  constructor(idtipo, tipo, descripcion) {
    this.#idtipo = idtipo;
    this.#tipo = tipo;
    this.#descripcion = descripcion;
  }
  get idtipo() {
    return this.#idtipo;
  }
  get tipo() {
    return this.#tipo;
  }
  get descripcion() {
    return this.#descripcion;
  }
  set idtipo(idtipo) {
    this.#idtipo = idtipo;
  }
  set tipo(tipo) {
    this.#tipo = tipo;
  }
  set descripcion(descripcion) {
    this.#descripcion = descripcion;
  }

  toJSON() {
    let oTipo = {
      idtipo: this.#idtipo,
      tipo: this.#tipo,
      descripcion: this.#descripcion,
    };
    return oTipo;
  }
}

class Componente {
  #idcomponente;
  #nombre;
  #descripcion;
  #precio;
  #idtipo;
  constructor(idcomponente, nombre, descripcion, precio, idtipo) {
    this.#idcomponente = idcomponente;
    this.#nombre = nombre;
    this.#descripcion = descripcion;
    this.#precio = precio;
    this.#idtipo = idtipo;
  }
  get idcomponente() {
    return this.#idcomponente;
  }
  get nombre() {
    return this.#nombre;
  }
  get descripcion() {
    return this.#descripcion;
  }
  get precio() {
    return this.#precio;
  }
  get idtipo() {
    return this.#idtipo;
  }
  set idcomponente(idcomponente) {
    this.#idcomponente = idcomponente;
  }
  set nombre(nombre) {
    this.#nombre = nombre;
  }
  set descripcion(descripcion) {
    this.#descripcion = descripcion;
  }
  set precio(precio) {
    this.#precio = precio;
  }
  set idtipo(idtipo) {
    this.#idtipo = idtipo;
  }

  toJSON() {
    let oComponente = {
      idcomponente: this.#idcomponente,
      nombre: this.#nombre,
      descripcion: this.#descripcion,
      precio: this.#precio,
      idtipo: this.#idtipo,
    };
    return oComponente;
  }
}

class Empresa {
  async altaTipo(oTipo) {
    let datos = new FormData();

    datos.append("tipo", oTipo.tipo);
    datos.append("descripcion", oTipo.descripcion);

    let respuesta = await peticionPOST("alta_tipo.php", datos);

    return respuesta;
  }

  async modificarComponente(oComponente) {
    let datos = new FormData();

    // Se podría pasar campo a campo al servidor
    // pero en esta ocasión vamos a pasar todos los datos
    // en un solo parámetro cuyos datos van en formato JSON
    datos.append("componente", JSON.stringify(oComponente));

    let respuesta = await peticionPOST("modificar_componente.php", datos);

    return respuesta;
  }

  async altaComponente(oComponente) {
    let datos = new FormData();

    // Se podría pasar campo a campo al servidor
    // pero en esta ocasión vamos a pasar todos los datos
    // en un solo parámetro cuyos datos van en formato JSON
    datos.append("componente", JSON.stringify(oComponente));

    let respuesta = await peticionPOST("alta_componente.php", datos);

    return respuesta;
  }

  async getTipos() {
    let datos = new FormData();

    let respuesta = await peticionGET("get_tipos.php", datos);

    return respuesta;
  }

  async buscarComponente(idComponente) {
    let datos = new FormData();

    datos.append("idcomponente", idComponente);

    let respuesta = await peticionPOST("buscar_componente.php", datos);

    return respuesta;
  }

  async borrarComponente(idComponente) {
    let datos = new FormData();

    datos.append("idcomponente", idComponente);

    let respuesta = await peticionPOST("borrar_componente.php", datos);

    return respuesta;
  }

  async listadoTipoComponentes() {
    let listado = "";

    let respuesta = await peticionGET("get_tipos.php", new FormData());

    if (!respuesta.ok) {
      listado = respuesta.mensaje;
    } else {
      listado = "<table class='table table-striped'>";
      listado +=
        "<thead><tr><th>IDTIPO</th><th>TIPO</th><th>DESCRIPCIÓN</th></tr></thead>";
      listado += "<tbody>";

      for (let tipo of respuesta.datos) {
        listado += "<tr><td>" + tipo.idtipo + "</td>";
        listado += "<td>" + tipo.tipo + "</td>";
        listado += "<td>" + tipo.descripcion + "</td></tr>";
      }
      listado += "</tbody></table>";
    }

    return listado;
  }

  async listadoPorTipo(idTipo) {
    let datos = new FormData();

    datos.append("idtipo", idTipo);

    let respuesta = await peticionGET("get_componentes_por_tipo.php", datos);

    return respuesta;
  }

  async listadoComponentes() {
    let datos = new FormData();

    let respuesta = await peticionGET("get_componentes.php", datos);

    return respuesta;
  }

  async listadoPorPrecio(precioMin, precioMax) {
    let datos = new FormData();
    datos.append("precioMin", precioMin);
    datos.append("precioMax", precioMax);

    let respuesta = await peticionGET("get_componentes_precio.php", datos);

    return respuesta;
  }

  async buscarTipoPorNombre(nombreTipo){
    let datos = new FormData();
    datos.append("nombre", nombreTipo);

    let respuesta = await peticionGET("get_tipo_componentes_nombre.php", datos);

    return respuesta;
  }
}
