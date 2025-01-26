window.onload = function () {
  obtenerFichaPersonal();
};

function obtenerFichaPersonal() {
  var xhr = new XMLHttpRequest();
  xhr.withCredentials = true;
  xhr.addEventListener('readystatechange', function () {
    if (this.readyState === 4) {
      if (this.status === 200) {
        const json = JSON.parse(this.responseText);
        if (json.respuesta) {
          const resultado = json.resultado;
          document.getElementById('lbnombres').innerHTML = resultado.nombres;
          document.getElementById('lbape1').innerHTML = resultado.apellido_paterno;
          document.getElementById('lbape2').innerHTML = resultado.apellido_materno;
          document.getElementById('lbgenero').innerHTML = resultado.genero;
          document.getElementById('lbciudad').innerHTML = resultado.ciudad;
          document.getElementById('lbrol').innerHTML = resultado.rol;
          document.getElementById('lbusername').innerHTML = resultado.username;
        } else {
          console.log(json.mensaje);
        }
      } else {
        console.log('Error en el servicio');
      }
    }
  });
  xhr.open('POST', '../../../services/api/user/');
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('tokenUTPL'));
  xhr.send(JSON.stringify({ op: 'obtenerFichaPersonal' }));
}
