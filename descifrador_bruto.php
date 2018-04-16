<?php

include 'algoritmos.php';

descifrar();

  function descifrar(){
    $mensaje = strtoupper($_GET["mensaje"]);// Todo UpperCase
    return descifrarFuerzaBruta($mensaje);
    // return buscarEnDiccionario($mensaje);
  }

?>
