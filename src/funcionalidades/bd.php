<?php
require_once __DIR__ . "/vendor/autoload.php";


try {
  $client->test->command(['ping' => 1]);
  echo 'Successfully pinged the MongoDB server.', PHP_EOL;
} catch (MongoDB\Driver\Exception\RuntimeException $e) {
  printf("Failed to ping the MongoDB server: %s\n", $e->getMessage());
}




/*
function obtenerBaseDeDatos()
{
    $host = "127.0.0.1";
    $puerto = "27017";
    $usuario = rawurlencode("parzibyte");
    $pass = rawurlencode("hunter2");
    $nombreBD = "agenda";
    # Crea algo como mongodb://parzibyte:hunter2@127.0.0.1:27017/agenda
    $cadenaConexion = sprintf("mongodb://%s:%s@%s:%s/%s", $usuario, $pass, $host, $puerto, $nombreBD);
    $cliente = new MongoDB\Client($cadenaConexion);
    return $cliente->selectDatabase($nombreBD);
}
obtener una instancia para trabajar con PHP y MongoDB
*/
?>