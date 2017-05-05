<?php
include "db_connection.php";

$day = $_POST['day'];
$faculty_id = $_POST['facultyid'];
$stmt = "select cls_name,time_section,ts_duration,course,f_name,duration from time_scale,ttable,class,faculty WHERE time_section=time AND day='$day' AND ttable.faculty='$faculty_id' AND ttable.class_no=class.class_no AND class.faculty=f_ID ORDER BY time ASC";
$ready = $conn->query($stmt);

$emparray = array();
while($row =mysqli_fetch_assoc($ready))
{
    $emparray[] = $row;
}
echo json_encode($emparray);

?>