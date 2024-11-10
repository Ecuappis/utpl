window.onload = function () {
  obtenerDatosUsuario();
};

function obtenerDatosUsuario() {
  const container = document.getElementById('listamenu');
  const article = document.createElement('article');
  article.className = 'btnmenu';
  article.id = 'btnopmenu1';
  article.setAttribute('onclick', '');

  const divImg = document.createElement('div');
  divImg.className = 'btnnavimg';
  divImg.style.backgroundImage = "url('resources/encuesta.png')";

  const divNombre = document.createElement('div');
  divNombre.className = 'lbnominfo';
  divNombre.textContent = 'Encuestas';

  article.appendChild(divImg);
  article.appendChild(divNombre);
  container.appendChild(article);
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
