<?php

/**
 * @ APUNTE IMPORTANTE PRENDE EL WAMP
 */

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

}

function queryInsertarUsuariosNuevos($conn, $nombre, $puntuacion) {
  $sql = "insert into usuarios(nombre, puntuacion) values('$nombre',$puntuacion)";
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

//queryInsertarUsuariosNuevos($conn,"vanesa",100);

$listaTop5Puntajes="select * from usuarios order by puntuacion desc limit 5";
querySelect($listaTop5Puntajes,$conn);



$conn->close();
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