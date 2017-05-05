<?php
include "db_connection.php";
session_start();
if(!empty($_SESSION["ID"])) {
    if ($_SESSION["user_type"] == "2") {
        $course = $_GET["slct_coursse"];
        $selectquery = "select t.class_no,d.day_name,t.duration,ts.ts_duration,f.F_Name from ttable t,time_scale ts,days d,faculty f 
WHERE course='$course' AND f.F_ID=t.faculty AND ts.time_section=t.time AND d.day_id=t.day";
        $exe1 = $conn->query($selectquery);
        if ($exe1->num_rows > 0) {
            echo '
            <table class="ui celled table">
            <thead>
                <th>Class No</th>
                <th>Day</th>
                <th>Start Time</th>
                <th>Duration</th>
                <th>Faculty</th>
            </thead>
            <tbody>
                  ';

            while ($row = $exe1->fetch_assoc()) {
                $clsno=$row['class_no'];
                $dayy=$row['day_name'];
                $timex=$row['ts_duration'];
                $durationx=$row['duration'];
                $faculty=$row['F_Name'];
                echo '
                <tr>
                    <td>'.$clsno.'</td>
                    <td>'.$dayy.'</td>
                    <td>'.$timex.'</td>
                    <td>'.$durationx.'</td>
                    <td>'.$faculty.'</td>
                </tr>
                ';
            }
        }
        echo '</tbody></table>';
    }
}
?>