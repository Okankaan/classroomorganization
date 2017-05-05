<?php
include "db_connection.php";
include "mail/smtp_mail3.php";
    $length = 10;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }


    $usermail=$_POST['uemail'];
    $stmt = "SELECT ID,recovery_email FROM users WHERE e_mail='$usermail'";
    $ready = $conn->query($stmt);
    $rows =$ready->fetch_assoc();

    if($rows)
    {
        $hashID=hash('sha256',$rows['ID']);
        $urlstring="http://www.n00ne.xyz/resetpw.php?email=$usermail&id=$hashID";
        $mail=$rows['recovery_email'];

        forgetpass($mail,$urlstring);

        $json = '[{"Recovery_Email":"'.$rows['recovery_email'].'"}]';
        echo($json);
    }
    else
    {
        if (!$ready) {
            $json = '[{"Success":"0"}]';
            echo($json);
        } else {
            $json = '[{"Success":"3"}]';
            echo($json);
        }
    }
?>