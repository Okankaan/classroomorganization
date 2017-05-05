<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    session_start();
    include "db_connection.php";
    $email=$_SESSION['eema'];
    $pw=$_POST['pww'];
    $hpw=hash("sha256",$pw);
    $sql="UPDATE users SET pw='$hpw' WHERE e_mail='$email'";
    $exe = $conn->query($sql);

        if ($exe) {
            echo "reset password successful";
        } else
            mysqli_error($exe);
    }

