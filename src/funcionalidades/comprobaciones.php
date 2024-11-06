<?php
$servername = "localhost";
$database = "";
$username = "root";
$password = "password";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
mysqli_close($conn);
?>
https://www.hostinger.es/tutoriales/conectar-php-mysql