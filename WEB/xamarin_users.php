<?php
include "db_connection.php";

$uname = $_POST['uname'];
$sql = "SELECT DISTINCT ID,u_name,surname,user_type,e_mail,recovery_email,faculty FROM users,faculty WHERE u_name LIKE '$uname%'";

$ready = $conn->query($sql);


$emparray = array();
while($row =mysqli_fetch_assoc($ready))
{
    $emparray[] = $row;
}
echo json_encode($emparray);

?>