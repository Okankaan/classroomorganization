<?php
include "db_connection.php";
session_start();
if(!empty($_SESSION["ID"])) {
    if ($_SESSION["user_type"] == "3") {
        $faculty_id=$_SESSION['faculty_id'];
        $c = $_GET['cls'];
        $d = $_GET['day'];
        $t = $_GET['time'];
        $dr = $_GET['dr'];
        $Uid = $_SESSION['ID'];
        $tip = $_SESSION['user_type'];
        $user = "select ID from users WHERE ID='$Uid' AND user_type='$tip'AND faculty='$faculty_id'";
        $result1 = $conn->query($user);
        if ($result1->num_rows == 0) {
            session_destroy();
            echo "Your account deleted! Please contact with a System Admin.";
        } else {
            $selectquery = "Delete from ttable WHERE class_no='$c' and day='$d' and time='$t' and duration='$dr'";
            $exe1 = $conn->query($selectquery);
            echo ' <meta http-equiv="refresh" content="0; url=http://n00ne.xyz/index2.php" >';
        }
    }

}?>