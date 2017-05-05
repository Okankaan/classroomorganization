<?php
include "db_connection.php";

$stmt = "SELECT code_section FROM course";
$ready = $conn->query($stmt);

$emparray = array();
while($row =mysqli_fetch_assoc($ready))
{
    $emparray[] = $row;
}
echo json_encode($emparray);

?>