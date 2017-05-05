<?php
include "db_connection.php";
include "mail/smtp_mail3.php";

session_start();
if(!empty($_SESSION["ID"])) {
    if ($_SESSION["user_type"] == "3") {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $classroom = $_POST['selectedclass'];
            $course = $_POST['selectedcourse'];
            $duration = $_POST['courseduration'];
            $day = $_POST['selectedday'];
            $time = $_POST['selectedtime'];
            $faculty = $_POST['selectedfaculty'];
            $selectfa="select F_Name from faculty WHERE F_ID='$faculty'";
            $exe1 = $conn->query($selectfa);
            if ($exe1->num_rows > 0) {
                while ($row = $exe1->fetch_assoc()) {
                    $fname = $row['F_Name'];
                }

         /*   $sql2 = "INSERT INTO ttable(class_no,day,time,duration,faculty,course) VALUES ('$classroom','$day',$time,$duration,'$faculty','$fname')";
            $exe = mysqli_query($conn, $sql2);*/
         for($i=$time;$i<$time+$duration;$i++) {
             $sql22 = "INSERT INTO ttable(class_no,day,time,duration,faculty,course) VALUES ('$classroom','$day',$i,1,'$faculty','$fname')";
             $exe = mysqli_query($conn, $sql22);
         }
            }
            $aaa = $_SESSION["ID"];
            if ($exe) {
                echo "New transfer made successfully";
                facultymail($aaa,$faculty,$classroom,$day,$time,$duration);
                

            } else {
                echo mysqli_error($conn);
            }
        }
    }
}
    ?>