<?php
/**
 * Created by PhpStorm.
 * Date: 10.11.2016
 * Time: 17:57
 */
session_start();

$servername = "localhost:3306";
$username = "";
$password = "";
$dbname = "";


$conn = new mysqli($servername,$username,$password,$dbname);

$_SESSION['conn']=$conn;
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


?>