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
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <link href="index.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.2.0/crypto-js.min.js" integrity="sha512-a+SUDuwNzXDvz4XrIcXHuCf089/iJAoN4lmrXJg18XnduKK6YlDHNRalv4yd1N40OKI80tFidF+rqTFKGPoWFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  </head>
  <body>
    <header>
      <nav>
        <div class="img-logo"></div>
      </nav>
    </header>
    <section>
      <article class="frm-login">
        <div class="tt-login">
          <h2>Ingreso</h2>
        </div>
        <div class="section-datos">
          <p>Usuario:</p>
          <div id="erroruser" class="icon-error"></div>
          <input id="txtuser" type="text" placeholder="Estudiante de UTPL" />
        </div>
        <div class="section-datos">
          <p>Contraseña:</p>
          <div id="errorpass" class="icon-error"></div>
          <input id="txtpass" type="password" placeholder="Contraseña" />
          <div id="btnverpass" class="img-ojo ojo-abierto"></div>
        </div>
        <div class="section-boton">
          <div id="btnloguear">Ingresar</div>
        </div>
      </article>
    </section>
    <script src="index.js"></script>
  </body>
</html>
