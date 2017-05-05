<?php
include "db_connection.php";

$urecemail = $_POST['urecemail'];
$sql = "SELECT recovery_email FROM users WHERE recovery_email='$urecemail'";

$ready = $conn->query($sql);
if ($ready->num_rows > 0)
    echo ('[{"Succes":"0"}]');
else
    echo ('[{"Succes":"1"}]');

?>