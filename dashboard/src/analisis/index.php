<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="index.css">
</head>

<body>
  <div id="subida" class="upload-container">
    <div class="upload-card">
      <h2>Cargar Archivo CSV</h2>
      <p>Selecciona un archivo para continuar</p>
      <input type="file" id="file-input" class="file-input" accept=".csv" />
      <button onclick="cargarcsv();" class="upload-button">Subir archivo</button>
    </div>
  </div>
  <div id="contenedor" class="resp-contenedor">
  </div>

  <script src="index.js"></script>
</body>

</html>