<?php

$servername = "localhost";
$username = "root";
$password = "";

// Crear Conexion
$conexionMySql = new mysqli($servername, $username, $password);
//mysqli: extension de MySql mejorada: Representa la conexion entre Php y Mysql

//-> es un operador de objeto y se utiliza para acceder a propiedades y metodos de los objetos

$listaTop5Puntajes = "select * from usuarios order by puntuacion desc limit 5";

$conexionMySql -> select_db("puntajes");
//Resultado contendra todo lo que nos devuelva esta consulta
//Es como si ahora resultado tuviera adentro la tabla solicitada
$resultado = $conexionMySql->query($listaTop5Puntajes);

if ($resultado->num_rows > 0) {
  // Asi como el operador de objeto -> es para acceder a propiedades "num_rows" es un atributo propio de la clase mysqli
  //echo json_encode($resultado->fetch_assoc());

  $filas=[];//Lista que contendra todas las filas que nos devuelva la consulta
  while ($fila = $resultado->fetch_assoc()) {//fetch nos devuelve un arrayAsociativo 
    $filas[] =[
      "id"=> $fila["id"],
      "nombre"=> $fila["nombre"],
      "puntuacion"=> $fila["puntuacion"],
    ];

  }
  echo json_encode($filas);
} else {
  echo "0 results";
}
    
        
?>
