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
    
        /*
        <?php

require __DIR__ . '/../../vendor/autoload.php';

function obtenerClienteMongoDB()
{
    $usuario = getenv('MONGO_USER');
    $pass = getenv('MONGO_PASS');
    $cluster = getenv('MONGO_CLUSTER');
    $cadenaConexion = sprintf("mongodb+srv://%s:%s@%s", $usuario, $pass, $cluster);
    return new MongoDB\Client($cadenaConexion);
}

function obtenerDatos($nombreBD, $nombreColeccion)
{
    $cliente = obtenerClienteMongoDB();
    $coleccion = $cliente->selectCollection($nombreBD, $nombreColeccion);
    return $coleccion->find()->toArray(); // Convertimos los documentos en un array
}

header('Content-Type: application/json'); // Indicamos que el contenido será JSON

try {
    // Llamamos a la función para obtener los datos de la colección "puntuaciones" en la base "ahorcado"
    $datos = obtenerDatos('ahorcado', 'puntuaciones');
    echo json_encode([
        'success' => true,
        'data' => $datos,
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
    ]);
}*/
/*jquery
fetch('obtener_datos.php')
  .then(response => {
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }
    return response.json();
  })
  .then(data => {
    if (data.success) {
      console.log("Datos de la base de datos:", data.data);
      // Aquí puedes manipular los datos, por ejemplo, mostrarlos en el DOM
      data.data.forEach(item => {
        console.log(`Nombre: ${item.nombreUsuario}, Puntuación: ${item.puntuacion}`);
      });
    } else {
      console.error("Error al obtener los datos:", data.message);
    }
  })
  .catch(error => console.error("Error en la solicitud:", error));*/
?>
