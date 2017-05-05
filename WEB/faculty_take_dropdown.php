<?php
include "db_connection.php";
session_start();
if(!empty($_SESSION["ID"])) {
    if ($_SESSION["user_type"] == "3") {


        $faculty_id = $_SESSION["faculty_id"];
        $class = "select * from class c,faculty f where f.F_ID=c.faculty AND c.faculty=$faculty_id";
        $result = $conn->query($class);
        if ($result->num_rows > 0) {
            while ($fill = $result->fetch_assoc()) {
                $class_id = $fill['class_no'];
                $name = $fill['cls_name'];
                $fa= $fill['F_Name'];
                echo "<option value=$class_id>$name / $fa</option>";
            }
        }

    }
}