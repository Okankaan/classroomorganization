<?php
include "db_connection.php";

$stmt = "SELECT DISTINCT cls_name FROM class ";
$ready = $conn->query($stmt);

$emparray = array();
while($row =mysqli_fetch_assoc($ready))
{
    $emparray[] = $row;
}
echo json_encode($emparray);

?>