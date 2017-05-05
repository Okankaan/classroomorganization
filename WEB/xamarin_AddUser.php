<?php
include "db_connection.php";

$nID = $_POST['nID'];
$nname = $_POST['nname'];
$nsurname = $_POST['nsurname'];
$npassword = $_POST['npassword'];
$nemail = $_POST['nemail'];
$nrecoveryemail = $_POST['nrecoveryemail'];
$ntype = $_POST['ntype'];
$nfaculty = $_POST['nfaculty'];

    $stmt = "INSERT INTO users VALUES('$nID','$nname','$nsurname','$npassword','$ntype','$nemail','$nfaculty','$nrecoveryemail')";
    $ready = $conn->query($stmt);

   if($ready)
   {
     $json = '[{"Succes":"1"}]';
     echo $json;
   }
   else
   {
       $json = '[{"Succes":"0"}]';
       echo $json;
   }

?>
