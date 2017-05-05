<?php
include "db_connection.php";
session_start();
if(!empty($_SESSION["ID"])) {
    if ($_SESSION["user_type"] == "3") {
        $dayy = $_GET['src_day0'];
        $drt = $_GET['src_duration0'];
        $tm = $_GET['src_time0'];
        $faculty_id = $_SESSION['faculty_id'];


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
     //print_r($arr);
        echo '
            <table class="ui compact celled table">
            <thead>
            <th>Class NO</th>
            <th>Class Name</th>
            <th>Type</th>
             <th>Capacity</th>
            <th>Location</th>
             <th>Faculty</th>
            </thead>
            <tbody>
            ';
        foreach( $arr as $array=>$r  ){
          //  echo $array;
            $showlist = "select * from class,building,faculty where class_no='$array' and S_Name=location AND faculty=F_ID ";
            $shw1 = $conn->query($showlist);

            while ($fill = $shw1->fetch_assoc()) {
                $no = $fill['class_no'];
                $nm = $fill['cls_name'];
                $ty = $fill['type'];
                $cap = $fill['capacity'];
                $loc = $fill['B_Name'];
                $fn = $fill['F_Name'];


                echo '
           
                <tr>
                    <td>' . $no . '</td>
                    <td>' . $nm . '</td>
                     <td>' . $ty . '</td>
                    <td>' . $cap . '</td>
                     <td>' . $loc . '</td>
                    <td>' . $fn . '</td>
                </tr>
           
            ';
            }
        }
        echo '
            </tbody>
            </table>';
        }



        /* $x=array_diff_assoc($arr,$arr2);
        print_r($x);*/
        /* foreach ($arr as $class_no => $values) {
             print_r($arr);
             echo "<br>";
             $result2 = ($tm + $drt);


             for ($i = $tm; $i < $result2; $i++) {
                 if (in_array("x",$arr)) {
                     echo $rows['class_no'];
                 } else
                     echo " aaa";
             }
         }
 */


    }


