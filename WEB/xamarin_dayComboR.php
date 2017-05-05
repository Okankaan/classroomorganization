<?php
include "db_connection.php";

$stmt = "SELECT DISTINCT day_name FROM ttable,days Where day_ID=day";
$ready = $conn->query($stmt);


$emparray = array();
while($row =mysqli_fetch_assoc($ready))
{
    $emparray[] = $row;
}
echo json_encode($emparray);

?>