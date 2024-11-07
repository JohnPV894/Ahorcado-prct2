<?php

/**
 * @ APUNTE IMPORTANTE PRENDE EL WAMP
 */

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Conexion fallida: " . $conn->connect_error);
}
echo "Conectado a la Base de Datos";

//$ranking5="";
//querySelect($ranking5,$conn);            

//FUENTE:https://www.w3schools.com/php/php_mysql_select.asp
function queryVoid($sql, $conn) {
  /*$sql = "consulta";
  create database if not exists puntajes;
  use database puntajes;
  create table if not exists usuarios(
  id int auto_increment,
  nombre varchar(30),
  puntuacion int,
  primary key(id)
  );
  
  drop database if exists puntajes; 
  */
if ($conn->query($sql) === TRUE) {
  echo "consulta .$sql funciono ";
} else {
  echo "Error en la consulta.$sql: " . $conn->error;
}

}

function querySelect($sql, $conn) {
  /*$sql = "consulta";
 
  */
  $resultado = $conn->query($sql);
  
  if ($resultado->num_rows > 0) {
    // output data of each row
    while($fila = $resultado->fetch_assoc()) {
      echo "Id: " . $fila["id"]. " - Nombre: " . $fila["nombre"]. " Puntaje" . $fila["puntuacion"]. "<br>";
    }
  } else {
    echo "0 results";
  }

}

function queryInsertarUsuariosNuevos($conn, $nombre, $puntuacion) {
  $sql = "consulta";
  if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
  } else {
    echo "Error creating database: " . $conn->error;
  }
}


$crearBase = "create database if not exists puntajes";
queryVoid($crearBase,$conn);

$conn->select_db("puntajes");//Importante si no se hace el "use database puntaje"; de esta manera no funcion

$crearTabla = "create table if not exists usuarios(
             id int auto_increment,
             nombre varchar(30),
             puntuacion int,
             primary key(id))";
queryVoid($crearTabla,$conn);
$conn->close();

/**
 * @ APUNTE IMPORTANTE PRENDE EL WAMP
 */
 
/*insert into usuarios(nombre, puntuacion) values
(
("john",11),
("juan",12),
("pepe",13),
("jose",14),
("orto",15)
);
*/
?>