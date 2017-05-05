<?php
include "db_connection.php";

    $faculty = $_POST['faculty'];
        $stmt = "SELECT code_section FROM course WHERE faculty='$faculty'";
        $ready = $conn->query($stmt);

    $emparray = array();
    while($row =mysqli_fetch_assoc($ready))
    {
        $emparray[] = $row;
    }
    echo json_encode($emparray);

?>