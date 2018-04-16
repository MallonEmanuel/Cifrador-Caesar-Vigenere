<?php

include 'algoritmos.php';

descifrar();

function descifrar()
{
    $clave = $_GET["clave"];
    $codificacion = $_GET["codificacion"];
    $mensaje = strtoupper($_GET["mensaje"]);// Todo UpperCase
      if ($codificacion == "Caesar") {
          echo caesar($clave, $mensaje, false);
      } else {
          echo vigenere(strtoupper($clave), $mensaje, false);
      }
}

?>
