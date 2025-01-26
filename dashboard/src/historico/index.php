<!DOCTYPE html>
<html lang="es">

<head>
  <title>UTPL</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0, minimal-ui" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="Proyecto para analisis de preferencias de estudiantes" />
  <meta name="keywords" content="utpl, universidad, proyecto" />
  <meta name="author" content="UTPL" />
  <meta http-equiv="Content-Language" content="es-MX" />
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" />
  <link rel="icon" type="image/x-icon" href="../../../favicon.ico" />
  <link href="index.css" rel="stylesheet" />
</head>

<body>
  <div class="container">
    <!-- Sidebar de filtros -->
    <aside class="sidebar">
      <h2>Filtros</h2>
      <div class="modal-fechas">
        <div>Fecha Inicio: <input type="date"></div>
        <div>Fecha Fin: <input type="date"></div>
      </div>
      <div id="modal-filtro" class="filter-group">
        <!-- Los filtros aparecerán aquí -->
      </div>
    </aside>

    <!-- Sección de resultados -->
    <main class="results">
      <h2>Resultados</h2>
      <div id="resultados" class="result-list">
        <!-- Los resultados aparecerán aquí -->
        <section class="modal-grafica">
          <article>
            <div>
              <div></div>
              <div>300</div>
            </div>
            <div>ESTUDIANTES ENCUESTADOS</div>
          </article>
          <article>
            <div>
              <div></div>
              <div>300</div>
            </div>
            <div>PROBABILIDAD DE STEAM</div>
          </article>
        </section>
      </div>
    </main>
  </div>
  <script src="index.js"></script>
</body>

</html>