let listadoPreguntas = [];

window.onload = function () {
  obtenerListadoPreguntas();
};

function obtenerListadoPreguntas() {
  var xhr = new XMLHttpRequest();
  xhr.withCredentials = true;
  xhr.addEventListener('readystatechange', function () {
    if (this.readyState === 4) {
      if (this.status === 200) {
        const json = JSON.parse(this.responseText);
        if (json.respuesta) {
          const resultado = json.resultado;
          listadoPreguntas = resultado;
          const contenedor = document.getElementById('cajatabla');
          contenedor.innerHTML = '';
          resultado.forEach((pregunta, indice) => {
            let opcion = document.createElement('div');
            let div = document.createElement('div');
            div.innerHTML = pregunta.numero;
            opcion.appendChild(div);
            div = document.createElement('div');
            div.innerHTML = pregunta.pregunta;
            if (pregunta.tipo == 'OPCION MULTIPLE') {
              div.innerHTML = pregunta.pregunta + ' (Selecciona todos los que apliquen)';
            } else if (pregunta.tipo == 'ESCALA') {
              div.innerHTML = pregunta.pregunta + ' (Escala de Likert:   1 = Nunca, 5 = Siempre) (S/T)';
            }
            opcion.appendChild(div);
            div = document.createElement('div');
            div.innerHTML = pregunta.opciones;
            opcion.appendChild(div);

            div = document.createElement('div');
            let toogle = document.createElement('div');
            if (pregunta.opciones > 0) {
              toogle.id = 'btntoogle' + indice;
              toogle.className = 'toogle';
              toogle.setAttribute('onclick', 'abrirToogle("' + indice + '")');
            }
            div.appendChild(toogle);
            opcion.appendChild(div);
            contenedor.appendChild(opcion);

            let expanded = document.createElement('article');
            expanded.id = 'boxexpanded' + indice;
            expanded.className = 'toogleExpanded';
            contenedor.appendChild(expanded);
          });
          document.getElementById('btngenerar').style.display = 'flex';
        } else {
          console.log(json.mensaje);
        }
      }
    }
  });
  xhr.open('POST', '../../../services/api/user/');
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('tokenUTPL'));
  xhr.send(JSON.stringify({ op: 'listaPreguntas' }));
}

function limpiarToogle() {
  document.querySelectorAll('[id^="boxexpanded"]').forEach((element) => {
    element.innerHTML = '';
  });

  document.querySelectorAll('[id^="btntoogle"]').forEach((element) => {
    element.classList.remove('rotate');
    element.classList.add('sin-rotate');
  });
}

function abrirToogle(indice) {
  const contenedor = document.getElementById('boxexpanded' + indice);
  if (contenedor.innerHTML != '') {
    limpiarToogle();
    return;
  }

  limpiarToogle();

  const button = document.getElementById('btntoogle' + indice);
  button.classList.remove('sin-rotate');
  button.classList.add('rotate');

  if (listadoPreguntas[indice].tipo == 'ESCALA') {
    contenedor.style.flexDirection = 'row';
    contenedor.style.alignItems = 'center';
    contenedor.style.justifyContent = 'center';
  }

  var data = JSON.stringify({
    op: 'listaOpcionesPregunta',
    numero: listadoPreguntas[indice].numero,
  });

  var xhr = new XMLHttpRequest();
  xhr.withCredentials = true;
  xhr.addEventListener('readystatechange', function () {
    if (this.readyState === 4) {
      if (this.status === 200) {
        const json = JSON.parse(this.responseText);
        if (json.respuesta) {
          const resultado = json.resultado;
          for (let index = 0; index < resultado.length; index++) {
            let opcion = document.createElement('div');
            let div = document.createElement('div');
            tipo = document.createElement('div');
            if (listadoPreguntas[indice].tipo == 'OPCION SIMPLE' || listadoPreguntas[indice].tipo == 'ESCALA') {
              tipo.className = 'radio';
            } else {
              tipo.className = 'check';
            }
            div.appendChild(tipo);
            opcion.appendChild(div);
            div = document.createElement('div');
            div.innerHTML = resultado[index].nombre;
            opcion.appendChild(div);
            contenedor.appendChild(opcion);
          }
        } else {
          console.log(json.mensaje);
        }
      } else {
        console.log('Error al acceder al servicio');
      }
    }
  });
  xhr.open('POST', '../../../services/api/user/');
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('tokenUTPL'));
  xhr.send(data);
}

function generarcsv() {
  const xhr = new XMLHttpRequest();
  xhr.open('POST', '../../../services/api/user/', true);
  xhr.responseType = 'blob';
  xhr.onload = function () {
    if (xhr.status === 200) {
      const blob = new Blob([xhr.response], { type: 'text/csv' });
      const url = window.URL.createObjectURL(blob);
      const a = document.createElement('a');
      a.href = url;
      a.download = 'encuesta.csv';
      document.body.appendChild(a);
      a.click();
      document.body.removeChild(a);
      window.URL.revokeObjectURL(url);
    } else {
      console.error('Error al generar el archivo CSV.');
    }
  };
  xhr.onerror = function () {
    console.error('Error de red al generar el archivo CSV.');
  };
  xhr.send(JSON.stringify({ op: 'generarCSV' }));
}
