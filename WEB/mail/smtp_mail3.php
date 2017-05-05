<?php
/**
 * Created by PhpStorm.
 * User: SULEYMAN
 * Date: 16.12.2016
 * Time: 18:57
 */


include "connection.php";

session_start();


function rectoratetransfermail ($from,$cfaculty,$to,$class_no,$day,$start_time,$duration)
{
    $x = $_SESSION['conn'];

    $sql = "SELECT * FROM users WHERE ID = '$from'";
    $result = mysqli_query($x, $sql);
    $row = mysqli_fetch_assoc($result);
    $from_email = $row["e_mail"];


    $sql1 = "SELECT * FROM faculty WHERE F_ID = '$cfaculty'";
    $result1 = mysqli_query($x, $sql1);
    $row1 = mysqli_fetch_assoc($result1);
    $f_faculty = $row1["F_Name"];

    $sql5 = "SELECT * FROM users WHERE user_type = '2'";
    $result5 = mysqli_query($x, $sql5);

    $sql3 = "SELECT * FROM faculty WHERE F_ID = '$to'";
    $result3 = mysqli_query($x, $sql3);
    $row3 = mysqli_fetch_assoc($result3);
    $to_faculty = $row3["F_Name"];

    $sql2 = "SELECT * FROM days WHERE day_id = '$day'";
    $result2 = mysqli_query($x, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $tday = $row2["day_name"];

    date_default_timezone_set('Europe/Istanbul');
    $day = date(DATE_RFC2822);

    $sql4 = "SELECT * FROM users WHERE faculty = '$to'";
    $result4 = mysqli_query($x,$sql4);

    switch ($start_time) {
        case 1:
            $stime = "9:00";
            break;
        case 2:
            $stime = "10:00";
            break;
        case 3:
            $stime = "11:00";
            break;
        case 4:
            $stime = "12:00";
            break;
        case 5:
            $stime = "13:00";
            break;
        case 6:
            $stime = "14:00";
            break;
        case 7:
            $stime = "15:00";
            break;
        case 8:
            $stime = "16:00";
            break;
        case 9:
            $stime = "17:00";
            break;
        case 10:
            $stime = "18:00";
            break;
        case 11:
            $stime = "19:00";
            break;
        case 12:
            $stime = "20:00";
            break;
    }

    while ($row5 = mysqli_fetch_assoc($result5)) {
        $conns = fsockopen("localhost", 25);
        $to_email = $row5["e_mail"];
        if ($to_email != $from_email) {
            fwrite($conns, "HELO n00ne.xyz\r\n");
            fwrite($conns, "MAIL FROM: $from_email\r\n");
            fwrite($conns, "RCPT TO: $to_email\r\n");
            fwrite($conns, "DATA\r\n");
            fwrite($conns, "Subject: Class Assignment\r\n"
                . "To: <$to_email>\r\n"
                . "From: $from_email\r\n"
                . "Date: $day\r\n"
                . "MIME-Version: 1.0\r\n"
                . "Content-Type: text/plain; charset=utf-8\r\n"
                . "Content-Transfer-Encoding: utf-8\r\n\r\n"
                . "$class_no is assigned from $f_faculty to $to_faculty  on $tday at $stime for $duration hours\r\n.\r\n");
            fread($conns, 50000);
            fwrite($conns, "QUIT\r\n");
        }


        fclose($conns);
    }
    while($row4 = mysqli_fetch_assoc($result4))
    {
        $conns = fsockopen("localhost", 25);
        $to_email = $row4["e_mail"];
        if($to_email != $from_email)
        {
            fwrite($conns, "HELO n00ne.xyz\r\n");
            fwrite($conns, "MAIL FROM: $from_email\r\n");
            fwrite($conns, "RCPT TO: $to_email\r\n");
            fwrite($conns, "DATA\r\n");
            fwrite($conns, "Subject: Class Assignment\r\n"
                . "To: <$to_email>\r\n"
                . "From: $from_email\r\n"
                . "Date: $day\r\n"
                . "MIME-Version: 1.0\r\n"
                . "Content-Type: text/plain; charset=utf-8\r\n"
                . "Content-Transfer-Encoding: utf-8\r\n\r\n"
                . "$class_no is assigned to your faculty on $tday at $stime for $duration hours\r\n.\r\n");
            fread($conns, 50000);
            fwrite($conns, "QUIT\r\n");
        }

        fclose($conns);


    }


}
 
 function facultymail($from,$to,$class_no,$day,$start_time,$duration)
{

    $x=$_SESSION['conn'];
    $sql = "SELECT * FROM users WHERE ID = '$from'";
    $result = mysqli_query($x,$sql);
    $row = mysqli_fetch_assoc($result);
    $from_email = $row["e_mail"];
    $f_faculty = $row["faculty"];

    $sql1 = "SELECT * FROM users WHERE faculty = '$to'";
    $result1 = mysqli_query($x,$sql1);

    $sql2 = "SELECT * FROM days WHERE day_id = '$day'";
    $result2 = mysqli_query($x,$sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $tday = $row2["day_name"];

    $sql3 = "SELECT * FROM faculty WHERE F_ID = '$to'";
    $result3 = mysqli_query($x,$sql3);
    $row3 = mysqli_fetch_assoc($result3);
    $to_faculty = $row3["F_Name"];

    $sql4 = "SELECT * FROM faculty WHERE F_ID = '$f_faculty'";
    $result4 = mysqli_query($x,$sql4);
    $row4 = mysqli_fetch_assoc($result4);
    $from_faculty = $row4["F_Name"];

    $sql5 = "SELECT * FROM users WHERE user_type = '2'";
    $result5 = mysqli_query($x,$sql5);

    switch ($start_time)
    {
        case 1:
            $stime = "9:00";
            break;
        case 2:
            $stime = "10:00";
            break;
        case 3:
            $stime = "11:00";
            break;
        case 4:
            $stime = "12:00";
            break;
        case 5:
            $stime = "13:00";
            break;
        case 6:
            $stime = "14:00";
            break;
        case 7:
            $stime = "15:00";
            break;
        case 8:
            $stime = "16:00";
            break;
        case 9:
            $stime = "17:00";
            break;
        case 10:
            $stime = "18:00";
            break;
        case 11:
            $stime = "19:00";
            break;
        case 12:
            $stime = "20:00";
            break;
    }
    date_default_timezone_set('Europe/Istanbul');
    $day = date(DATE_RFC2822);

    while($row1 = mysqli_fetch_assoc($result1))
    {
        $conns = fsockopen("localhost", 25);
        $to_email = $row1["e_mail"];
        if($to_email != $from_email)
        {
            fwrite($conns, "HELO n00ne.xyz\r\n");
            fwrite($conns, "MAIL FROM: $from_email\r\n");
            fwrite($conns, "RCPT TO: $to_email\r\n");
            fwrite($conns, "DATA\r\n");
            fwrite($conns, "Subject: Class Assignment\r\n"
                . "To: <$to_email>\r\n"
                . "From: $from_email\r\n"
                . "Date: $day\r\n"
                . "MIME-Version: 1.0\r\n"
                . "Content-Type: text/plain; charset=utf-8\r\n"
                . "Content-Transfer-Encoding: utf-8\r\n\r\n"
                . "$class_no is assigned to your faculty on $tday at $stime for $duration hours\r\n.\r\n");
            fread($conns, 50000);
            fwrite($conns, "QUIT\r\n");
        }

        fclose($conns);


    }

    while($row5 = mysqli_fetch_assoc($result5))
    {
        $conns = fsockopen("localhost", 25);
        $to_email = $row5["e_mail"];
        if($to_email != $from_email)
        {
            fwrite($conns, "HELO n00ne.xyz\r\n");
            fwrite($conns, "MAIL FROM: $from_email\r\n");
            fwrite($conns, "RCPT TO: $to_email\r\n");
            fwrite($conns, "DATA\r\n");
            fwrite($conns, "Subject: Class Assignment\r\n"
                . "To: <$to_email>\r\n"
                . "From: $from_email\r\n"
                . "Date: $day\r\n"
                . "MIME-Version: 1.0\r\n"
                . "Content-Type: text/plain; charset=utf-8\r\n"
                . "Content-Transfer-Encoding: utf-8\r\n\r\n"
                . "$class_no is assigned from $from_faculty to $to_faculty  on $tday at $stime for $duration hours\r\n.\r\n");
            fread($conns, 50000);
            fwrite($conns, "QUIT\r\n");
        }

        fclose($conns);

    }

}

function rectorate_add($from,$to,$class_no) //add classroom mail
{
    $x = $_SESSION['conn'];
    $sql = "SELECT * FROM users WHERE ID = '$from'";
    $result = mysqli_query($x, $sql);
    $row = mysqli_fetch_assoc($result);
    $from_email = $row["e_mail"];

    date_default_timezone_set('Europe/Istanbul');
    $day = date(DATE_RFC2822);

    $sql3 = "SELECT * FROM faculty WHERE F_ID = '$to'";
    $result3 = mysqli_query($x, $sql3);
    $row3 = mysqli_fetch_assoc($result3);
    $to_faculty = $row3["F_Name"];

    $sql1 = "SELECT * FROM users WHERE faculty = '$to'";
    $result1 = mysqli_query($x, $sql1);

    $sql5 = "SELECT * FROM users WHERE user_type = '2'";
    $result5 = mysqli_query($x, $sql5);

    while ($row1 = mysqli_fetch_assoc($result1)) {
        $conns = fsockopen("localhost", 25);
        $to_email = $row1["e_mail"];

        fwrite($conns, "HELO n00ne.xyz\r\n");
        fwrite($conns, "MAIL FROM: $from_email\r\n");
        fwrite($conns, "RCPT TO: $to_email\r\n");
        fwrite($conns, "DATA\r\n");
        fwrite($conns, "Subject: Class Addition\r\n"
            . "To: <$to_email>\r\n"
            . "From: $from_email\r\n"
            . "Date: $day\r\n"
            . "MIME-Version: 1.0\r\n"
            . "Content-Type: text/plain; charset=utf-8\r\n"
            . "Content-Transfer-Encoding: utf-8\r\n\r\n"
            . "$class_no is added to your faculty.\r\n.\r\n");
        fread($conns, 50000);
        fwrite($conns, "QUIT\r\n");

        fclose($conns);


    }
    while ($row5 = mysqli_fetch_assoc($result5)) {
        $conns = fsockopen("localhost", 25);
        $to_email = $row5["e_mail"];
        if ($to_email != $from_email) {
            fwrite($conns, "HELO n00ne.xyz\r\n");
            fwrite($conns, "MAIL FROM: $from_email\r\n");
            fwrite($conns, "RCPT TO: $to_email\r\n");
            fwrite($conns, "DATA\r\n");
            fwrite($conns, "Subject: Class Addition\r\n"
                . "To: <$to_email>\r\n"
                . "From: $from_email\r\n"
                . "Date: $day\r\n"
                . "MIME-Version: 1.0\r\n"
                . "Content-Type: text/plain; charset=utf-8\r\n"
                . "Content-Transfer-Encoding: utf-8\r\n\r\n"
                . "$class_no is assigned  to $to_faculty .\r\n.\r\n");
            fread($conns, 50000);
            fwrite($conns, "QUIT\r\n");
        }

        fclose($conns);

    }
}


function forgetpass($to,$string)
{
    date_default_timezone_set('Europe/Istanbul');
    $day = date(DATE_RFC2822);
    $from_email = "admin@n00ne.xyz";
    $to_email = $to;

    $conns = fsockopen("localhost", 25);
    fwrite($conns, "HELO n00ne.xyz\r\n");
    fwrite($conns, "MAIL FROM: $from_email\r\n");
    fwrite($conns, "RCPT TO: $to_email\r\n");
    fwrite($conns, "DATA\r\n");
    fwrite($conns, "Subject: Password Reset\r\n"
        . "To: <$to_email>\r\n"
        . "From: $from_email\r\n"
        . "Date: $day\r\n"
        . "MIME-Version: 1.0\r\n"
        . "Content-Type: text/plain; charset=utf-8\r\n"
        . "Content-Transfer-Encoding: utf-8\r\n\r\n"
        . "$string\r\n.\r\n");
    fread($conns, 50000);
    fwrite($conns, "QUIT\r\n");
}

?>