// Evento de cifrado por default
$("#form").submit(function(event) {
    event.preventDefault();
    cifrar();
});

// Cambia el Type del input segun la codificacion.
// Si es Cesar la codificacion sera numerica, si es Vigenere la codificacion sera del tipo text
$(document).ready(function() {
    $('input:radio[name=codificacion]').change(function() {
        if (this.value == 'Caesar') {
            document.getElementById('clave').type = 'number';
            document.getElementById('fb').removeAttribute('disabled');
        } else if (this.value == 'Vigenere') {
            document.getElementById('clave').value = '';
            document.getElementById('clave').type = 'text';
            document.getElementById('fb').setAttribute("disabled","disabled");
        }
    });
});

// Obtiene el valor de la codificacion
function getCodificacion() {
    var codificaciones = document.getElementsByName("codificacion");
    var cod;
    for (var i = 0, length = codificaciones.length; i < length; i++) {
        if (codificaciones[i].checked) {
            cod = codificaciones[i].value;
            break;
        }
    }
    return cod;
}

// Cifra un mensaje
function cifrar() {
    var url = 'cifrador.php';
    sendRequest(url,getData());
}
// Descifra un mensaje
function descifrar() {
    var url = 'descifrador.php';
    sendRequest(url,getData());
}
function descifrarFuerzaBruta(){
    var url = 'descifrador_bruto.php';
    sendRequest(url,getDataFuerzaBruta());
}

function limpiar(){
  document.getElementById('mensaje').value = '';
  document.getElementById('clave').value = '';
  document.getElementById('resultado').value = '';
}

function getDataFuerzaBruta() {
  return { mensaje: document.getElementById("mensaje").value }
}

function getData(){
  return {
      mensaje: document.getElementById("mensaje").value,
      clave: document.getElementById("clave").value,
      codificacion: getCodificacion()
  }
}

function sendRequest(url, data) {
    $.ajax({
        type: 'GET', //
        url: url, //direccion url
        data: data, // datos
        success: function(data) {
            document.getElementById("resultado").value = data;
            console.log("Finalizado");
        },
        error: function(data) {
            //lo que devuelve si falla tu archivo mifuncion.php
        }
    });
}
