<?php
include "db_connection.php";

$uID = $_POST['uID'];
$sql = "SELECT ID FROM users WHERE ID='$uID'";

$ready = $conn->query($sql);
if ($ready->num_rows > 0)
echo ('[{"Succes":"0"}]');
else
    echo ('[{"Succes":"1"}]');

?>