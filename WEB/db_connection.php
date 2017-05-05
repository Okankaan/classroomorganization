<?php
$servername = "localhost:3306";
$username = "";
$password = "";
$dbname = "";

$conn = new mysqli($servername,$username,$password,$dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>