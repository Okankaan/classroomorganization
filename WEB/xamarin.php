<?php
include "db_connection.php";
$servername = "localhost:3306";
$username = "nnexyz_user";
$password = "123qwe123";
$dbname = "nnexyz_database";

$conn = new mysqli($servername,$username,$password,$dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else
{
        $stmt = "SELECT ID,U_Name,pw FROM users";
        $ready = $conn->query($stmt);

    $emparray = array();
    while($row =mysqli_fetch_assoc($ready))
    {
        $emparray[] = $row;
    }
    echo json_encode($emparray);
}
?>
