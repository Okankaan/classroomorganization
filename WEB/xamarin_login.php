<?php
include "db_connection.php";

$e_mail = $_POST['e_mail'];
$pw = $_POST['pw'];
$sql = "SELECT pw,faculty,user_type,u_name,surname FROM users WHERE e_mail='$e_mail'";
$ready = $conn->query($sql);
$rows =$ready->fetch_assoc();

if($rows)
{
    if($rows['pw'] == $pw )
    {

        $facultyid=$rows['faculty'];
        $usertype=$rows['user_type'];
        $username=$rows['u_name'];
        $usurname=$rows['surname'];

        $sql = "SELECT f_name FROM faculty WHERE f_ID='$facultyid'";
        $ready = $conn->query($sql);
        $rows2=$ready->fetch_assoc();

            $json='[{"Success":"1"},{"Faculty":"'.$facultyid.'"},{"UserType":"'.$usertype.'"},{"FacultyName":"'.$rows2['f_name'].'"},{"UserName":"'.$username.'"},{"Usurname":"'.$usurname.'"}]';
            echo($json);

    }
    else
    {$json='[{"Success":"2"},{"Faculty":"*"},{"UserType":"*"}]';
        echo ($json);}
}
else {
    if (!$ready) {
        $json = '[{"Success":"0"},{"Faculty":"*"},{"UserType":"*"}]';
        echo($json);
    } else {
        $json = '[{"Success":"3"},{"Faculty":"*"},{"UserType":"1"}]';
        echo($json);
    }
}
?>