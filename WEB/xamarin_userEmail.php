<?php
include "db_connection.php";

$uemail = $_POST['uemail'];
$sql = "SELECT e_mail FROM users WHERE e_mail='$uemail'";

$ready = $conn->query($sql);
if ($ready->num_rows > 0)
    echo ('[{"Succes":"0"}]');
else
    echo ('[{"Succes":"1"}]');

?>