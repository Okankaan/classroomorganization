<?php
include "db_connection.php";

    $faculty = $_POST['faculty'];
        $stmt = "SELECT DISTINCT cls_name FROM class WHERE ttable.faculty='$faculty'";
        $ready = $conn->query($stmt);

    $emparray = array();
    while($row =mysqli_fetch_assoc($ready))
    {
        $emparray[] = $row;
    }
    echo json_encode($emparray);

?>