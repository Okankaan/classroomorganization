<?php
include "db_connection.php";
session_start();
if(!empty($_SESSION["ID"])) {
    if ($_SESSION["user_type"] == "1") {
        $userid = $_SESSION["userid"];

        if($_SERVER["REQUEST_METHOD"]=="GET")
        {

            $email=$_GET['snd_email2'];
            $recoverymail=$_GET['snd_recoverymail2'];
            $uname=$_GET["snd_uname2"];
            $surname=$_GET["snd_surname2"];
            $usertype=$_GET["snd_usertype2"];
            $faculty=$_GET["snd_faculty2"];
            $update = "UPDATE users SET U_name='$uname',surname='$surname',e_mail='$email',user_type='$usertype',faculty='$faculty',recovery_email='$recoverymail'WHERE ID='$userid'";
            $result = $conn->query($update);
          if($result){
                echo "update successful";
            }
            else {
                echo mysqli_error($conn);
            }
        }
        if ($_SERVER["REQUEST_METHOD"]=="POST")
        {
            if($_SESSION['ID']!=$userid) {
                $drop = "DELETE FROM users WHERE ID='$userid'";
                $result = $conn->query($drop);
                if ($result) {
                    echo "delete successful";
                }
            }
            else{
            echo "you can not delete yourself!";
            }
        }
    }
}