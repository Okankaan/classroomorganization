<?php
include "db_connection.php";

$day = $_POST['day'];
$stmt = "select * from time_scale,ttable WHERE time_section=time AND day='$day'";
$ready = $conn->query($stmt);

$emparray = array();
while($row =mysqli_fetch_assoc($ready))
{
    $emparray[] = $row;
}
echo json_encode($emparray);

?>