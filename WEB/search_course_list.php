<?php
include "db_connection.php";
session_start();
if(!empty($_SESSION["ID"])) {
    if ($_SESSION["user_type"] == "3") {
        $faculty_id = $_SESSION["faculty_id"];
        $course = $_GET["slct_coursse"];
        $selectquery = "select t.class_no,d.day_name,t.duration,ts.ts_duration,t.time,t.day from ttable t,time_scale ts,days d 
WHERE course='$course' AND faculty='$faculty_id' AND ts.time_section=t.time AND d.day_id=t.day";
        $exe1 = $conn->query($selectquery);
        if ($exe1->num_rows > 0) {
            echo '
            <table class="ui celled table">
            <thead>
                <th>Class No</th>
                <th>Day</th>
                <th>Start Time</th>
                <th>Duration</th>
                <th></th>
            </thead>
            <tbody>
                  ';

            while ($row = $exe1->fetch_assoc()) {
                $clsno=$row['class_no'];
                $dayy=$row['day_name'];
                $timex=$row['ts_duration'];
                 $durationx=$row['duration'];
                $tt=$row['time'];
                $td=$row['day'];
                echo '
                <tr>
                    <td>'.$clsno.'</td>
                    <td>'.$dayy.'</td>
                    <td>'.$timex.'</td>
                    <td>'.$durationx.'</td>
                    <td><a href="delete.php?cls='.$clsno.'&day='.$td.'&time='.$tt.'&dr='.$durationx.'">Delete</a></td>

                </tr>
                ';
            }
        }
        echo '</tbody></table>';
    }
}
?>