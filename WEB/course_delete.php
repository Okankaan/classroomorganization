<?php
include "db_connection.php";
session_start();
if(!empty($_SESSION["ID"])) {
    if ($_SESSION["user_type"] == "3") {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $faculty_id=$_SESSION['faculty_id'];
            $crs = $_POST['dltcourse'];
            $Uid = $_SESSION['ID'];
            $tip = $_SESSION['user_type'];
            $user = "select ID from users WHERE ID='$Uid' AND user_type='$tip'AND faculty='$faculty_id'";
            $result1 = $conn->query($user);
            if ($result1->num_rows == 0) {
                session_destroy();
                echo "Your account deleted! Please contact with a System Admin.";
            } else {
                $drop = "DELETE FROM course WHERE code_section='$crs'";
                $result = $conn->query($drop);
                $drop2 = "DELETE FROM ttable WHERE course='$crs'";
                $result2 = $conn->query($drop2);
                if ($result) {
                    echo "delete successful";
                }
            }
        }
    }
}