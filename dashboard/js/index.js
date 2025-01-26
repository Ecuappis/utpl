window.onload = function () {
  obtenerDatosUsuario();
};

function obtenerDatosUsuario() {
  var xhr = new XMLHttpRequest();
  xhr.withCredentials = true;
  xhr.addEventListener('readystatechange', function () {
    if (this.readyState === 4) {
      if (this.status === 200) {
        const json = JSON.parse(this.responseText);
        if (json.respuesta) {
          // CARGAR DATOS
          const datos = json.resultado.usuario;
          document.getElementById('lbnomuser').innerHTML = datos.nombres;
          document.getElementById('lbroluser').innerHTML = datos.tipo;
          document.getElementById('lbciuser').innerHTML = datos.ciudad;
          if (datos.genero == 'F') {
            document.getElementById('imgusericon').className = 'img-user user-mujer';
          } else {
            document.getElementById('imgusericon').className = 'img-user user-hombre';
          }
          // CARGAR MENU
          const container = document.getElementById('listamenu');
          const menu = json.resultado.menu;
          menu.forEach((boton) => {
            const article = document.createElement('article');
            article.className = 'btnmenu';
            article.id = 'btnopmenu1';
            article.setAttribute('onclick', 'verPagina("' + boton.page + '")');

            const divImg = document.createElement('div');
            divImg.className = 'btnnavimg';
            divImg.style.backgroundImage = "url('" + boton.icono + "')";

            const divNombre = document.createElement('div');
            divNombre.className = 'lbnominfo';
            divNombre.textContent = boton.nombre;

            article.appendChild(divImg);
            article.appendChild(divNombre);
            container.appendChild(article);
          });
        } else {
          console.log(json.mensaje);
        }
      } else {
        console.log('Error al acceder al servicio');
      }
    }
  });
  xhr.open('POST', '../services/api/user/');
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('tokenUTPL'));
  xhr.send(JSON.stringify({ op: 'obtenerDatosUsuario' }));
}

function minimizar() {
  const contenedor = document.getElementById('cajanavlist');
  const barra = document.getElementById('divbarranav');

  if (contenedor.style.display !== 'none' && contenedor.style.display !== '') {
    contenedor.style.display = 'none';
    barra.style.width = '80px';
  } else {
    contenedor.style.display = 'block';
    barra.style.width = '250px';
  }
}

function descarmarTodo() {
  const elementos = document.querySelectorAll('[id^="btnopmenu"]');
  elementos.forEach((element) => {
    element.style.backgroundColor = '';
  });
}

function cerrarsesion() {
  localStorage.removeItem('sdtoken');
  window.location.href = '../';
}

function verPagina(pagina) {
  var modal = document.getElementById('modal-iframe');
  modal.innerHTML = '';
  // Crear un nuevo iframe
  var iframe = document.createElement('iframe');
  iframe.setAttribute('src', 'src/' + pagina);
  modal.appendChild(iframe);
}
