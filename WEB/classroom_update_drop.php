<?php
include "db_connection.php";
include "mail/smtp_mail3.php";
session_start();
if(!empty($_SESSION["ID"])) {
    $id = $_SESSION["ID"];
    if ($_SESSION["user_type"] == "2") {
       $classno = $_SESSION["comboclass"];
        if($_SERVER["REQUEST_METHOD"]=="GET")
        {
            $clsname=$_GET["snd_clsname"];
            $location=$_GET["snd_clsbuilding"];
            $type=$_GET["snd_clstype"];
            $capacity=$_GET["snd_clscapacity"];
            $faculty=$_GET["snd_clsfaculty"];

            $Uid=$_SESSION['ID'];
            $tip=$_SESSION['user_type'];
            $user = "select ID from users WHERE ID='$Uid' AND user_type='$tip'";
            $result1 = $conn->query($user);
            if ($result1->num_rows == 0) {
                session_destroy();
                echo "Your account deleted! Please contact with a System Admin.";
            }
            else{            $update = "UPDATE class SET cls_name='$clsname',type='$type',capacity='$capacity',location='$location',faculty='$faculty' WHERE class_no='$classno'";
            $result = $conn->query($update);
            if($result){
                echo "Update Successful";
                rectorate_add($id,$faculty,$classno);
            }
            else {
                echo mysqli_error($conn);
            }
        }}
        if ($_SERVER["REQUEST_METHOD"]=="POST")
        {
            $Uid=$_SESSION['ID'];
            $tip=$_SESSION['user_type'];
            $user = "select ID from users WHERE ID='$Uid' AND user_type='$tip'";
            $result1 = $conn->query($user);
            if ($result1->num_rows == 0) {
                session_destroy();
                echo "Your account deleted! Please contact with a System Admin.";
            }
            else{
            $drop = "DELETE FROM class WHERE class_no='$classno'";
            $result = $conn->query($drop);
            $drop2 = "DELETE FROM ttable WHERE class_no='$classno'";
            $result2 = $conn->query($drop2);
            if($result){
                echo "Delete Successful";
            }
        }}
    }
}