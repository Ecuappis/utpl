const claveCifrado = 'T@ny4UTPL2@2A**x';

document.addEventListener('DOMContentLoaded', function () {
  const btnVerPass = document.getElementById('btnverpass');
  const inputUser = document.getElementById('txtuser');
  const inputPass = document.getElementById('txtpass');
  const btnLogin = document.getElementById('btnloguear');
  const errorUser = document.getElementById('erroruser');
  const errorPass = document.getElementById('errorpass');

  // Ver Contraseña
  btnVerPass.addEventListener('click', function () {
    if (inputPass.type === 'password') {
      inputPass.type = 'text';
      btnVerPass.classList.remove('ojo-abierto');
      btnVerPass.classList.add('ojo-cerrado');
    } else {
      inputPass.type = 'password';
      btnVerPass.classList.remove('ojo-cerrado');
      btnVerPass.classList.add('ojo-abierto');
    }
  });

  // Evento de login
  btnLogin.addEventListener('click', function () {
    errorUser.style.display = 'none';
    errorPass.style.display = 'none';

    if (inputUser.value == '' && inputPass.value == '') {
      errorUser.style.display = 'block';
      errorPass.style.display = 'block';
    } else if (inputUser.value == '') {
      errorUser.style.display = 'block';
    } else if (inputPass.value == '') {
      errorPass.style.display = 'block';
    } else {
      const textUser = inputUser.value.trim();
      const textPass = inputPass.value.trim();

      // Generar un IV aleatorio
      const iv = CryptoJS.lib.WordArray.random(16);

      // Cifrar el texto con CBC (incluyendo IV)
      const userEncript = CryptoJS.AES.encrypt(textUser, CryptoJS.enc.Utf8.parse(claveCifrado), { iv: iv }).toString();
      const passEncript = CryptoJS.AES.encrypt(textPass, CryptoJS.enc.Utf8.parse(claveCifrado), { iv: iv }).toString();

      // Convertir el IV a Base64 y concatenarlo al texto cifrado para enviarlo al servidor
      const userEncriptWithIv = iv.toString(CryptoJS.enc.Base64) + ':' + userEncript;
      const passEncriptWithIv = iv.toString(CryptoJS.enc.Base64) + ':' + passEncript;

      // Enviar por AJAX al servidor
      enviarTextoCifrado(userEncriptWithIv, passEncriptWithIv);
    }
  });
});

// Función para enviar el texto cifrado al servidor
function enviarTextoCifrado(userEncript, passEncript) {
  var data = JSON.stringify({
    user: userEncript,
    pass: passEncript,
  });

  var xhr = new XMLHttpRequest();
  xhr.withCredentials = true;

  xhr.addEventListener('readystatechange', function () {
    if (this.readyState === 4) {
      if (this.status === 200) {
        try {
          var responseData = JSON.parse(this.responseText);
          if (responseData.respuesta) {
            const token = responseData.resultado['token'];
            localStorage.setItem('tokenUTPL', token);
            window.location.href = 'dashboard/';
          } else {
            const errorUser = document.getElementById('erroruser');
            const errorPass = document.getElementById('errorpass');
            if (responseData.resultado == 'user') {
              errorUser.style.display = 'block';
            } else if (responseData.resultado == 'pass') {
              errorPass.style.display = 'block';
            } else {
              errorUser.style.display = 'block';
              errorPass.style.display = 'block';
            }
          }
        } catch (e) {
          errorUser.style.display = 'block';
          errorPass.style.display = 'block';
        }
      } else {
        errorUser.style.display = 'block';
        errorPass.style.display = 'block';
      }
    }
  });
  xhr.open('POST', 'services/api/login/');
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.send(data);
}
