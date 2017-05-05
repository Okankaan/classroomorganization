<?php
include "db_connection.php";
session_start();

$Uid=$_SESSION['ID'];
$tip=$_SESSION['user_type'];
$user = "select ID from users WHERE ID='$Uid' AND user_type='$tip'";
$result1 = $conn->query($user);
if ($result1->num_rows == 0) {
    session_destroy();
    echo "false";
}


?>