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
        $class_no = $_POST['class_no'];
        $stmt = "SELECT ttable.class_no,day,time,duration,course FROM ttable,class WHERE cls_name='$class_no' AND ttable.class_no=class.class_no ";
        $ready = $conn->query($stmt);

    $emparray = array();
    while($row =mysqli_fetch_assoc($ready))
    {
        $emparray[] = $row;
    }
    echo json_encode($emparray);
}
?>
