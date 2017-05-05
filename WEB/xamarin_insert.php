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

try{
    $ID = $_POST['ID'];
    $U_Name = $_POST['U_Name'];
    $surname = $_POST['surname'];
    $pw = $_POST['pw'];
    $e_mail = $_POST['e_mail'];
    $user_type = $_POST['user_type'];
    $faculty = $_POST['faculty'];

    $sql = "INSERT INTO users VALUES ('$ID','$U_Name','$surname','$pw','$user_type','$e_mail','$faculty')";
    $ready = $conn->query($sql);
    echo  "Done";
}
catch (mysqli_sql_exception $e) {echo $e->getMessage();}


}
?>