<?php
include "db_connection.php";
session_start();
if(!empty($_SESSION["ID"])) {
    if ($_SESSION["user_type"] == "3") {
        $faculty_id = $_SESSION["faculty_id"];
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $classroom = $_GET['selectedclass'];
            $course = $_GET['selectedcourse'];
            $duration = $_GET['courseduration'];
            $day = $_GET['selectedday'];
            $time = $_GET['selectedtime'];
            $selectquery = "select * from ttable t,class c where
      day='$day' AND t.class_no='$classroom' AND (t.faculty='$faculty_id' OR c.faculty='$faculty_id')";
            $exe1 = $conn->query($selectquery);
            if ($exe1->num_rows > 0) {
                while ($row = $exe1->fetch_assoc()) {
                    $ttime = $row['time'];
                    $dduration = $row['duration'];
                    $result = ($ttime + $dduration);
                    for ($i = $ttime; $i < $result; $i++) {
                        $array[$i] = "F";
                    }
                }
            } else
                echo "null";
            $result2 = ($time + $duration);
            for ($i = $time; $i < $result2; $i++) {
                if ($array[$i] == 'F') {
                    echo "1";
                    return 0;
                }
            }
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $classroom2 = $_POST['selectedclass2'];
            $course2 = $_POST['selectedcourse2'];
            $duration2 = $_POST['courseduration2'];
            $day2 = $_POST['selectedday2'];
            $time2 = $_POST['selectedtime2'];
            $sql22 = "select class_no from class where
       class_no='$classroom2' AND faculty='$faculty_id' ";
            $exe2 = mysqli_query($conn, $sql22);
            $sql21 = "select class_no from ttable where
       class_no='$classroom2' AND faculty='$faculty_id' ";
            $exe21 = mysqli_query($conn, $sql21);
            $Uid=$_SESSION['ID'];
            $tip=$_SESSION['user_type'];
            $user = "select ID from users WHERE ID='$Uid' AND user_type='$tip'AND faculty='$faculty_id'";
            $result1 = $conn->query($user);
            if ($result1->num_rows == 0) {
                session_destroy();
                echo "Your account deleted! Please contact with a System Admin.";
            }
else{
            if($exe2->num_rows > 0) {
                $sql2 = "INSERT INTO ttable(class_no,day,time,duration,faculty,course) VALUES ('$classroom2','$day2',$time2,$duration2,'$faculty_id','$course2')";
                $exe = mysqli_query($conn, $sql2);
                if ($exe) {
                    echo "New record created successfully";
                } else {
                    echo mysqli_error($conn);
                }
            }
            else if($exe21->num_rows > 0){
                $sql2 = "INSERT INTO ttable(class_no,day,time,duration,faculty,course) VALUES ('$classroom2','$day2',$time2,$duration2,'$faculty_id','$course2')";
                $exe = mysqli_query($conn, $sql2);
                if ($exe) {
                    echo "New record created successfully";
                } else {
                    echo mysqli_error($conn);
                }
            }
            else
                echo "This classroom deleted from rectorate or assigned to another faculty.";


        }
    }
    }
}