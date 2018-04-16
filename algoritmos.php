<?php

    define("ELEMENTOS_ALFABETO", 26);// Trabajamos sin la Ñ,
    define("CORRECCION_ASCII", 65);// Valor de correccion de codigo ASCII.

    function caesar($clave, $mensaje, $cifrar)
    {
        $nuevo_mensaje;
        for ($i = 0; $i < strlen($mensaje); $i++) {// Para cada letra del mensaje
            $caracter = obtener_caracter($clave, $mensaje[$i], $cifrar);
            $nuevo_mensaje = $nuevo_mensaje . $caracter; // Se concatena el caracter al mensaje resultante.
        }
        return $nuevo_mensaje;
    }

    function vigenere($clave, $mensaje, $cifrar)
    {
        $nuevo_mensaje;
        for ($i = 0; $i < strlen($mensaje); $i++) {// Para cada letra del mensaje
            $indice = $i % strlen($clave);// Indice circular de la clave.
            // Se define como orden al indice que lleva el caracter en el alfabeto (A:0 - B:1 - C:2 - D:4....)
            $orden_clave = ord($clave[$indice]) - CORRECCION_ASCII;
            $caracter = obtener_caracter($orden_clave, $mensaje[$i], $cifrar);
            $nuevo_mensaje = $nuevo_mensaje . $caracter; // Se concatena el caracter al mensaje resultante.
        }
        return $nuevo_mensaje;
    }

    /**  Evalua si un caracter debe ser desplazado (Sucede si el caracter pertenece al alfabeto)
    $desplazamiento : Entero positivo que indica la cantidad de letras que deben desplazarce.
    (se suma para cifrar o se resta para descifrar)
    $caracter : caracter a ser evaluado.
    $cifrar : bandera para indicar si se debe cifrar o descifrar (true para cifrar, false para descifrar)
    **/
    function obtener_caracter($desplazamiento, $caracter, $cifrar)
    {
        // Se define como orden al indice que lleva el caracter en el alfabeto (A:0 - B:1 - C:2 - D:4....)
        $orden = (ord($caracter) - CORRECCION_ASCII);// obtengo el orden del caracter
        if ($orden >= 0 && $orden < ELEMENTOS_ALFABETO) { // Si el caracter pertenece al alfabeto
            if ($cifrar) {// Si se debe cifrar sumo el desplazamiento
              $nuevo_orden =  modulo(($orden + $desplazamiento), ELEMENTOS_ALFABETO);
            } else {// Si se debe descifrar resto el desplazamiento
              $nuevo_orden = modulo(($orden - $desplazamiento), ELEMENTOS_ALFABETO);
            }
            $caracter = chr($nuevo_orden + CORRECCION_ASCII) ;// Obtengo el nuevo caracter del nuevo codigo ASCII
        }
        return $caracter;
    }


    function modulo($a, $b)
    {
        $mod = $a % $b;
        if ($mod < 0) {
            $mod = ELEMENTOS_ALFABETO + $mod;
        }
        return $mod;
    }

    /** Descifrador de Caesar a fuerza bruta. Utilizando un diccionario**/
    function descifrarFuerzaBruta($mensaje)
    {
        $resultado;
        for ($i = 0 ; $i < ELEMENTOS_ALFABETO; $i++) {
            $mensaje_descifrado = caesar($i, $mensaje, false);
            if(buscarEnDiccionario($mensaje_descifrado)){
                // Si alguna palabra del alfabeto esta en el mensaje se agrega al resultado
                $resultado = $resultado ." (".$i.") ". $mensaje_descifrado;
            }
        }
        if(empty($resultado))
            $resultado = "SIN RESULTADOS";
        echo $resultado;
    }

    /** Busca si alguna palabra del diccionario se encuentra en el mensaje. Retorna true
        si se encuentra alguna coincidencia, false en caso contrario
    **/
    function buscarEnDiccionario($mensaje){
      $fp = fopen("diccionario.txt", "r");//abre el archivo en modo lectura
      while(!feof($fp)) {// mientras que no sea fin de archivo
        $linea = strtoupper(trim(fgets($fp))); // trim quita en fin de cadena
        if (empty($linea)){// Si la linea esta vacia retornar. La ultima linea siempre esta vacia.
          return false;
        }

        if(strpos($mensaje, $linea) !== false){ // strpos indica la posicion donde coincide la palabra o false se no coincide
          return true;
        }
      }
      fclose($fp);// cierra el archivo
      return false;
    }

?>
