<?php
include 'algoritmos.php';

cifrar();

function cifrar()
{
    $clave = $_GET["clave"];
    $codificacion = $_GET["codificacion"];
    $mensaje = strtoupper($_GET["mensaje"]);// Todo UpperCase
      if ($codificacion == "Caesar") {
          echo caesar($clave, $mensaje, true);
      } else {
          echo vigenere(strtoupper($clave), $mensaje, true);
      }
}

?>
