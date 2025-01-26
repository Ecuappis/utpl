function cargarcsv() {
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
      console.log(data);
    })
    .catch((error) => {
      console.error('Error:', error);
      alert('Hubo un problema al subir el archivo.');
    });
}
