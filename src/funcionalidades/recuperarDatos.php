<?php

$servername = "localhost";
$username = "root";
$password = "";

// Crear Conexion
$conn = new mysqli($servername, $username, $password);
//mysqli: extension de MySql mejorada: Representa la conexion entre Php y Mysql

//-> es un operador de objeto y se utiliza para acceder a propiedades y metodos de los objetos
if ($conn->connect_error) {
  die("Conexion fallida: " /*. $conn->connect_error*/);
}

      /*$sql = "consulta";
     
      */
      $resultado = $conn->query($sql);
      //echo $resultado->fetch_assoc();
      if ($resultado->num_rows > 0) {
        // output data of each row
        echo json_encode($resultado->fetch_assoc());
    
        while($fila = $resultado->fetch_assoc()) {
          echo "Id: " . $fila["id"]. " - Nombre: " . $fila["nombre"]. " Puntaje" . $fila["puntuacion"]. "<br>";
        }
      } else {
        echo "0 results";
      }
    
        