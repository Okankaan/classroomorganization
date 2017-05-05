<?php
include "db_connection.php";
session_start();
if(!empty($_SESSION["ID"])) {
    if ($_SESSION["user_type"] == "3") {
        $timee = $_POST['slc_time'];
        $dayy = $_SESSION['select_dy'];
        $faculty_id = $_SESSION["faculty_id"];
           $scale = "select ts.ts_duration,t.duration,c.cls_name,t.course,f.F_Name from 
                                        time_scale ts,ttable t,class c,faculty f WHERE
                                      time_section=time AND day='$dayy' AND time='$timee'
                                       AND t.faculty='$faculty_id' AND c.class_no=t.class_no AND c.faculty=f.F_ID";
        $result = $conn->query($scale);
        if ($result->num_rows > 0) {
            echo '
            <table class="ui celled table">
            <thead>
                <th>Classroom Name</th>
                <th>Start Time</th>
                <th>Duration</th>
                 <th>Course</th>
                 <th>Classrooms Faculty</th>
            </thead>
            <tbody>
                  ';
            while ($fill = $result->fetch_assoc()) {
                $ts = $fill['ts_duration'];
                $duration = $fill['duration'];
               $class_no=$fill['cls_name'];
                $course=$fill['course'];
                $faculty=$fill['F_Name'];
                echo '
                <tr>
                    <td>'.$class_no.'</td>
                    <td>'.$ts.'</td>
                    <td>'.$duration.'</td>
                    <td>'.$course.'</td>
                     <td>'.$faculty.'</td>
                </tr>
                ';

            }
            echo '</tbody></table>';
        }
    }
}