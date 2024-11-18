<?php

require __DIR__ . '/../../vendor/autoload.php';

function obtenerClienteMongoDB()
{
    $cluster = "cluster0.6xkz1.mongodb.net/";
    $usuario = rawurlencode("santiago894");
    $pass = rawurlencode("P5wIGtXue8HvPvli");
    $cadenaConexion = sprintf("mongodb+srv://%s:%s@%s", $usuario, $pass, $cluster);
    $cliente = new MongoDB\Client($cadenaConexion);
    //"mongodb+srv://$usuario:$pass@cluster0.6xkz1.mongodb.net/"
    return $cliente;
}
function mostrarBasesDeDatos()
{
    $listaBD=[];
    $cliente = obtenerClienteMongoDB();
    $basesDeDatos = $cliente->listDatabases();

    //Atencion basesDeDatos es un objeto de la clase mongoDB CUIDADO AL ITERAR
    foreach ($basesDeDatos as $cadaBaseDeDatos) {
        array_push( $listaBD, $cadaBaseDeDatos->getName());
    }

    //El metodo getName devuelve un dato string normal
    for ($i=0; $i <sizeof( $listaBD) ; $i++) { 
        echo"Data Base N°$i:". $listaBD[$i] ."<br>";
    }
 
    return $listaBD;
}

function mostrarColecciones()
{
    $cliente = obtenerClienteMongoDB();
    foreach ($cliente->ahorcado->listCollections() as $collectionInfo) {
        print_r($collectionInfo) . "<br>";
    }
}

function comprobarExistenciaBD($nombreBD){
    $listaBD = mostrarBasesDeDatos();
    foreach ($listaBD as $cadaBaseDeDatos) {
        if ($nombreBD === $cadaBaseDeDatos){
            return true;
        }
    }
    return false;
}
function comprobarExistenciaColeaccion($nombreBD){
    $listaBD = mostrarBasesDeDatos();
    foreach ($listaBD as $cadaBaseDeDatos) {
        if ($nombreBD === $cadaBaseDeDatos){
            return true;
        }
    }
    return false;
}

//if (comprobarExistenciaBD("ahorcado")) {
//   echo "Ya existe esa base de datos<br>";
//}else{
//    echo "No existe aun<br>";
//}
$cliente=obtenerClienteMongoDB();

$baseDatos = $cliente -> selectDatabase('ahorcado');
$baseDatos->createCollection('puntuaciones'); //tabla a terminos Sql

$coleccionPuntuaciones = $cliente->selectCollection('ahorcado', 'puntuaciones');


//mostrarBasesDeDatos() ;

function insertarUsuario($nombreUsuario, $puntuacion, $nombreBD, $nombreColeccion) {
    $cliente = obtenerClienteMongoDB();
    $coleccion = $cliente->selectCollection($nombreBD, $nombreColeccion);
    $coleccion->insertOne([
        'nombreUsuario' => $nombreUsuario,
        'puntuacion' => $puntuacion
    ]);
}
//insertarUsuario($nombre, $puntuacion, 'ahorcado', 'puntuaciones');

//echo $cliente->puntuacion->find();
$document = $coleccion->findOne(['nombreUsuario' => 'John']);
echo json_encode($document), PHP_EOL ,"<br>";
$document2 = $coleccion->find();
foreach ($document2 as $documento) {
    echo "<pre>";
    print_r($documento);  // Muestra cada documento de la colección
    echo "</pre>";
}

//Recuperar datos con el metodo post
if (isset($_POST['nombre'], $_POST['puntuacion'])) {
    $nombre = $_POST['nombre'];
    $puntuacion = $_POST['puntuacion'];
    insertarUsuario($nombre,$puntuacion,$baseDatos,$coleccion);

    header("Location: http://localhost:3000/../interfaz/index.html");
    
 
    exit(); // salir para evitar enviar más contenido
 
 } else {
    echo "Error: No se recibieron los datos necesarios. Datos recibidos: " .
         (isset($_POST['nombre']) ? $_POST['nombre'] : "Nombre no proporcionado") . " || " .
         (isset($_POST['puntuacion']) ? $_POST['puntuacion'] : "puntuacion no proporcionada") . " || " ;
 
 
      echo "<pre>";
      print_r($_POST);
      echo "</pre>";
 }

//https://parzibyte.me/blog/2018/12/13/php-mongodb-crud/


?>