<?php
include "db_connection.php";
session_start();
if(!empty($_SESSION["ID"])) {
    if ($_SESSION["user_type"] == "2") {

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $classroom = $_GET['selectedclass'];
            $course = $_GET['selectedcourse'];
            $duration = $_GET['courseduration'];
            $day = $_GET['selectedday'];
            $time = $_GET['selectedtime'];
            $selectquery = "select * from ttable t,class c where
      day='$day' AND t.class_no='$classroom'";
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

}}