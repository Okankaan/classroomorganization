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

        $pw2 = hash('sha256', "12345");
        $sql = "INSERT INTO users VALUES ('345','cagri','surname','$pw2','2','cagri','120')";
        $ready = $conn->query($sql);

        if(!$ready)
        {$json = '{"success": 0}';
            echo $pw2;}
        else{$json = '{"success": 1}';
            echo $pw2;}


}
?>