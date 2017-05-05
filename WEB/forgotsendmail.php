<?php
include "db_connection.php";


$umail=$_POST['umaill'];
include("mail/smtp_mail3.php");

$seed = str_split('abcdefghijklmnopqrstuvwxyz'
    .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
    .'0123456789'); // and any other characters
shuffle($seed); // probably optional since array_is randomized; this may be redundant
$rand = '';
foreach (array_rand($seed, 15) as $k) $rand .= $seed[$k];
echo $rand;
$sql="select ID from users WHERE e_mail='$umail'";
$exe = $conn->query($sql);

if ($exe->num_rows > 0) {
    while ($row = $exe->fetch_assoc()) {
        $idd = $row['ID'];
        $hash = hash("sha256", $idd);
    }
}
$sql121="select * from users WHERE e_mail='$umail'";
$exe121 = $conn->query($sql121);
if ($exe121->num_rows > 0) {
    while ($row = $exe121->fetch_assoc()) {
        $rec = $row['recovery_email'];
    }

$sql="UPDATE users SET pw='$rand' WHERE e_mail='$umail'";
$exe = $conn->query($sql);
$urlstring="
Your password recovery link is:
http://www.n00ne.xyz/resetpw.php?email=$umail&pwww=$rand&id=$hash";
forgetpass($rec,$urlstring);
}
else
{
    echo "user does not exists!";
}
?>