<?php
include "db_connection.php";


$stmt = "SELECT f_name FROM faculty";
$ready = $conn->query($stmt);
$rows =$ready->fetch_assoc();

$emparray = array();
while($row =mysqli_fetch_assoc($ready))
{
    $emparray[] = $row;
}
echo json_encode($emparray);

?>