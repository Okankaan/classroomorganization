<?php
include "db_connection.php";
include "mail/smtp_mail3.php";

session_start();
if(!empty($_SESSION["ID"])) {
    if ($_SESSION["user_type"] == "2") {
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
                $clsf="select * from class where class_no='$classroom'";
                $e1 = $conn->query($clsf);
                if ($e1->num_rows > 0) {
                    while ($row = $e1->fetch_assoc()) {
                        $f = $row['faculty'];
                    }}
        if($faculty==$f)
            echo "you can not transfer to same faculty!";
                    else{
                        $Uid=$_SESSION['ID'];
                        $tip=$_SESSION['user_type'];
                        $user = "select ID from users WHERE ID='$Uid' AND user_type='$tip'";
                        $result1 = $conn->query($user);
                        if ($result1->num_rows == 0) {
                            session_destroy();
                            echo "Your account deleted! Please contact with a System Admin";
                        }
                        else{
         for($i=$time;$i<$time+$duration;$i++) {
             $sql22 = "INSERT INTO ttable(class_no,day,time,duration,faculty,course) VALUES ('$classroom','$day',$i,1,'$faculty','$fname')";
             $exe = mysqli_query($conn, $sql22);
         }
            }}
            $aaa = $_SESSION["ID"];
            if ($exe) {
                echo "New transfer successful";
                rectoratetransfermail($aaa,$f,$faculty,$classroom,$day,$time,$duration);

            } else {
                echo mysqli_error($conn);
            }
        }
    }
        }
}
    ?>