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
  <link rel="icon" type="image/x-icon" href="../favicon.ico" />
  <link rel="stylesheet" href="css/index.css">
</head>

<body>

  <section class="modal-form">
    <nav class="barra-nav">
      <article class="modal-logo">
        <div class="img-logo"></div>
      </article>
      <article class="modal-minimenu"></article>
    </nav>

    <section class="modal-body">
      <article id="divbarranav" class="nav-menu">
        <article class="modal-mini">
          <div class="btnminimizar" onclick="minimizar();"></div>
        </article>
        <section id="cajanavlist" class="nav-submodal">
          <article class="data-user">
            <div class="submodal-user">
              <div class="img-user"></div>
              <div class="option-user">
                <div id="lbnomuser" class="negrita">TANYA CEDEÑO</div>
                <div id="lbroluser">ESTUDIANTE</div>
                <div id="lbciuser" class="negrita">MACHALA</div>
                <div class="cerrar" onclick="">Cerrar Sesión</div>
              </div>
            </div>
            <div class="linea"></div>
          </article>
          <article id="listamenu" class="modal-menu"></article>
        </section>
      </article>
      <article id="modal-iframe" class="modal-operador"></article>
    </section>
  </section>
  <script src="js/index.js"></script>
</body>

</html>