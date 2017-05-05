<?php
include "db_connection.php";

$dayy = $_POST['day'];
$drt = $_POST['duration'];
$tm = $_POST['time'];
$faculty_id = $_POST['faculty_id'];


$scale = "select DISTINCT c.class_no from ttable t,class c where
        day='$dayy' AND c.class_no=t.class_no AND c.faculty='$faculty_id'";
$scale1 = "select DISTINCT t.class_no from ttable t,class c where
        day='$dayy' AND c.class_no=t.class_no and  c.faculty='$faculty_id'";
$scale2 = "select DISTINCT t.class_no,t.time,t.duration from ttable t,class c where
        day='$dayy' AND c.class_no=t.class_no AND  c.faculty='$faculty_id'";
$fullemt = "select class_no from class WHERE faculty='$faculty_id'";
$result1 = $conn->query($scale);
$result = $conn->query($scale2);
$result3 = $conn->query($scale);
$result4 = $conn->query($scale1);
$empth = $conn->query($fullemt);
$arr = [];
$arr2 = [];
$az = 0;
while ($rows = $result4->fetch_assoc()) {
    $arr[$rows['class_no']] = [1 => ' ', 2 => ' ', 3 => ' ', 4 => ' ', 5 => ' ',
        6 => ' ', 7 => ' ', 8 => ' ', 9 => ' ', 10 => ' ', 11 => ' ', 12 => ' '];
}
while ($rows = $empth->fetch_assoc()) {
    $arr[$rows['class_no']] = [1 => ' ', 2 => ' ', 3 => ' ', 4 => ' ', 5 => ' ',
        6 => ' ', 7 => ' ', 8 => ' ', 9 => ' ', 10 => ' ', 11 => ' ', 12 => ' '];
}


while ($rows = $result->fetch_assoc()) {
    for ($i = $rows['time']; $i < ($rows['time'] + $rows['duration']); $i++) {
        $arr[$rows['class_no']][$i] = 'x';

    }
}

$result2 = ($tm + $drt);

while ($r = $result3->fetch_assoc()) {
    for ($i = $tm; $i < $result2; $i++) {
        if ($arr[$r['class_no']][$i] == 'x') {
            unset($arr[$r['class_no']]);
        }
    }

}
$emparray = array();
foreach( $arr as $array=>$r  ){
    $showlist = "select * from class,building,faculty where class_no='$array' and S_Name=location AND faculty=F_ID ";
    $shw1 = $conn->query($showlist);

    while ($fill = mysqli_fetch_assoc($shw1)) {
        $emparray[] = $fill;
    }
}
echo json_encode($emparray);
?>