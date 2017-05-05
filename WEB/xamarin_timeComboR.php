<?php
include "db_connection.php";

$day = $_POST['day'];

$stmt = "SELECT DISTINCT ts_duration FROM ttable,time_scale WHERE time_section=time AND ttable.day='$day' ORDER BY time ASC";

$ready = $conn->query($stmt);


$emparray = array();
while($row =mysqli_fetch_assoc($ready))
{
    $emparray[] = $row;
}
echo json_encode($emparray);

?>