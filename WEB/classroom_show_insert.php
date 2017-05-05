<?php
include "db_connection.php";
include "mail/smtp_mail3.php";

session_start();
if(!empty($_SESSION["ID"])) {
    if ($_SESSION["user_type"] == "2") {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $classno = $_POST['snd_clsno'];
            $classname = $_POST['snd_clsname'];
            $building = $_POST['snd_clsbuilding'];
            $type = $_POST['snd_clstype'];
            $capacity = $_POST['snd_clscapacity'];
            $faculty = $_POST['snd_clsfaculty'];

            $sql = "INSERT INTO class (class_no, cls_name,type,capacity,location,faculty)
            VALUES ('$building$classno', '$classname','$type',$capacity,'$building','$faculty')";
            $exe=$conn->query($sql);
            if ($exe) {
                echo "1";
                rectorate_add($_SESSION["ID"],$faculty,$building.$classno);
            }
            else {
                echo  mysqli_error($conn);
            }

            $conn->close();
        }

    }
}