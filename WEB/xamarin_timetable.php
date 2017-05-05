<?php
include "db_connection.php";

$stmt = "select * from ttable t,class c where t.class_no=JSON_ARRAY('$classroom') AND (t.faculty=JSON_ARRAY('$faculty_id') OR c.faculty=JSON_ARRAY('$faculty_id'))";
$ready = $conn->query($stmt);

$emparray = array();
while($row =mysqli_fetch_assoc($ready))
{
    $emparray[] = $row;
}
echo json_encode($emparray);

?>