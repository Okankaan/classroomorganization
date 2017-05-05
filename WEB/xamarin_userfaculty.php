<?php
include "db_connection.php";

$facultyid = $_POST['facultyid'];
$sql = "SELECT f_name FROM faculty WHERE f_ID='$facultyid'";

$ready = $conn->query($sql);
if($row =mysqli_fetch_assoc($ready))
echo ($row['f_name']);

?>