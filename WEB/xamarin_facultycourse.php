<?php
include "db_connection.php";
    $course = $_POST['course'];
    $stmt = "select t.class_no,d.day_name,t.duration,ts.ts_duration,f_name from ttable t,time_scale ts,days d,faculty 
WHERE course='$course' AND ts.time_section=t.time AND d.day_id=t.day AND faculty=F_ID";
        $ready = $conn->query($stmt);

    $emparray = array();
    while($row =mysqli_fetch_assoc($ready))
    {
        $emparray[] = $row;
    }
    echo json_encode($emparray);

?>