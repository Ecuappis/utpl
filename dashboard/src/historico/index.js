let listaAreas = [];

window.onload = function () {
  obtenerListaAreas();
};

function obtenerListaAreas() {
  var xhr = new XMLHttpRequest();
  xhr.withCredentials = true;
  xhr.addEventListener('readystatechange', function () {
    if (this.readyState === 4) {
      if (this.status === 200) {
        const json = JSON.parse(this.responseText);
        if (json.respuesta) {
          const resultado = json.resultado;
          listaAreas = resultado;
          const contenedor = document.getElementById('modal-filtro');
          contenedor.innerHTML = '';
          resultado.forEach((element, index) => {
            let opcion = document.createElement('div');
            let article = document.createElement('article');
            article.className = 'opcion-filtro';
            let nombre = document.createElement('div');
            nombre.innerHTML = element.nombre;
            article.appendChild(nombre);
            let toogle = document.createElement('div');
            toogle.className = 'toogle sin-rotate';
            toogle.setAttribute('data-index', index);
            toogle.onclick = function () {
              toggleExpanded(this);
            };
            article.appendChild(toogle);
            opcion.appendChild(article);
            article = document.createElement('article');
            article.className = 'modal-desplegable';
            article.id = element.nemonico;
            opcion.appendChild(article);
            contenedor.appendChild(opcion);
          });
        } else {
          console.log(json.mensaje);
        }
      } else {
        console.log('Error al acceder al servicio');
      }
    }
  });
  xhr.open('POST', '../../../services/api/historico/');
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.send(JSON.stringify({ op: 'obtenerAreas' }));
}

function toggleExpanded(element) {
  const index = element.getAttribute('data-index');
  const contenedor = document.getElementById(listaAreas[index].nemonico);

  if (element.classList.contains('sin-rotate')) {
    element.className = 'toogle rotate';
  } else {
    element.className = 'toogle sin-rotate';
  }

  if (contenedor.innerHTML != '') {
    contenedor.innerHTML = '';
    return;
  }

  contenedor.innerHTML = '';
  const opciones = listaAreas[index].opciones;
  console.log(opciones);
  opciones.forEach((element) => {
    let pregunta = document.createElement('div');
    pregunta.className = 'pregunta-area';
    let check = document.createElement('input');
    check.type = 'checkbox';
    check.checked = element.check;
    pregunta.appendChild(check);
    let nombre = document.createElement('a');
    nombre.innerHTML = element.nombre;
    pregunta.appendChild(nombre);
    contenedor.appendChild(pregunta);
  });
}
