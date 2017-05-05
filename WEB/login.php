<?php
include "db_connection.php";
session_start();
$email = $_POST['email'];
$password = $_POST['password'];
$passwordHash=hash('sha256',$password);

if (empty($email))
{
    $json = '{"success": 0}';
    echo $json;
}
else {
    if (empty($passwordHash))
    {
        $json = '{"success": 0}';
        echo $json;
    }
    else {
        $stmt = "SELECT ID,user_type,faculty FROM users WHERE e_mail='$email' AND pw='$passwordHash'";
        $ready = $conn->query($stmt);
        $rows=$ready->fetch_assoc();
        if ($rows) {
          $_SESSION["user_type"] = $rows["user_type"];
            $_SESSION["ID"] = $rows["ID"];
            $_SESSION["faculty_id"] = $rows["faculty"];
            $json = '{"success": 1}';
            echo $json;
        } else {
            $json = '{"success": 0}';
            echo $json;
        }
    }

}
