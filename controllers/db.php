<?php
$servername = "localhost";
$username = "u685818680_admin_gab";
$password = "GptYi#R5";
$database = "u685818680_fbbva_nv";
$conexion = mysqli_connect($servername,$username,$password,$database);


if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}

/*

$servername = "localhost";
$username = "u685818680_admin_gab";
$password = "GptYi#R5";
$database = "u685818680_fbbva_nv";
$conexion = mysqli_connect($servername,$username,$password,$database);


$servername = "localhost";
$username = "root";
$password = "";
$database = "fbbva_newversion";
$conexion = mysqli_connect($servername,$username,$password,$database);
*/


?>