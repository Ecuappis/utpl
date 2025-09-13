function cargarcsv() {
  mostrarLoading();
  const fileInput = document.getElementById('file-input');
  const file = fileInput.files[0];

  if (!file) {
    alert('Por favor, selecciona un archivo CSV.');
    return;
  }

  const formData = new FormData();
  formData.append('file', file);

  fetch('../../../services/api/csv/', {
    method: 'POST',
    body: formData,
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error('Error al procesar el archivo.');
      }
      return response.json();
    })
    .then((data) => {
      // Respuesta del Servicio
      ocultarLoading();
      if (data.respuesta) {
        let contenedor = document.getElementById('contenedor');
        contenedor.style.display = 'flex';
        let subida = document.getElementById('subida');
        subida.style.display = 'none';
        /* comienza a crear los graficos */
        const resultado = data.resultado;
        const excluidas = resultado.preguntas_excluidas;
        const analisis = resultado.analisis_resultado;
        analisis.forEach((element) => {
          let itemRespuesta = document.createElement('div');
          itemRespuesta.className = 'item-respuesta';
          contenedor.appendChild(itemRespuesta);

          let tituloRespuesta = document.createElement('div');
          tituloRespuesta.className = 'titulo-respuesta';
          tituloRespuesta.id = 'textPregunta';
          tituloRespuesta.textContent = element.pregunta;
          tituloRespuesta.title = element.pregunta;
          itemRespuesta.appendChild(tituloRespuesta);

          let grafico = document.createElement('div');
          grafico.className = 'grafico';
          itemRespuesta.appendChild(grafico);

          let porcentajes = [120, 100, 80, 60, 40, 20, 0];
          porcentajes.forEach((porcentaje) => {
            let div = document.createElement('div');
            let divPorcentaje = document.createElement('div');
            divPorcentaje.textContent = `${porcentaje}%`;
            div.appendChild(divPorcentaje);
            grafico.appendChild(div);
          });

          let graficoRespuestas = document.createElement('div');
          graficoRespuestas.className = 'graf-respuestas';
          graficoRespuestas.id = 'graficoRespuestas';
          itemRespuesta.appendChild(graficoRespuestas);

          const analisis = element.analisis;
          const frecuencia = analisis.frecuencia;
          const ancho = 400 / frecuencia.length;

          frecuencia.forEach((resp) => {
            let barra = document.createElement('div');
            barra.style.width = `${ancho}px`;
            const alto = (250 / 100) * resp.Porcentaje;
            barra.style.height = `${alto}px`;
            let contentBarra = document.createElement('div');
            contentBarra.textContent = resp.Respuesta;
            contentBarra.title = resp.Respuesta;
            barra.appendChild(contentBarra);
            graficoRespuestas.appendChild(barra);
          });
        });
      } else {
        alert(data.mensaje);
      }
    })
    .catch((error) => {
      console.error('Error:', error);
      alert('Hubo un problema al subir el archivo.');
    });
}

function mostrarLoading() {
  const loading = document.getElementById('loading');
  loading.style.display = 'flex';
}

function ocultarLoading() {
  const loading = document.getElementById('loading');
  loading.style.display = 'none';
}
