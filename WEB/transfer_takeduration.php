<?php
include "db_connection.php";
session_start();
if(!empty($_SESSION["ID"])) {
    if ($_SESSION["user_type"] == "3") {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $timme = $_POST['selecttime221'];
            $sessionday = $_SESSION['selectedday'];
            $sessionclass = $_SESSION['selectedclass'];
            $faculty_id = $_SESSION["faculty_id"];
            $arr = array(
                1 => " ", 2 => " ", 3 => " ", 4 => " ", 5 => " ", 6 => " ",
                7 => " ", 8 => " ", 9 => " ", 10 => " ", 11 => " ", 12 => " ",
            );
            $a = "select F_Name from faculty where F_ID='$faculty_id'";
            $result4 = $conn->query($a);
            while ($fill = $result4->fetch_assoc()) {
                $facn = $fill['F_Name'];
            }
            $x = 0;
            $aa = 0;
            for ($i = $timme; $i < 13; $i++) {
                $aa = $timme + $x;
                $day3 = "select DISTINCT ts.time_section,t.duration,t.time from ttable t,class c,time_scale ts where 
                    t.class_no=c.class_no and t.faculty='$faculty_id' and c.faculty != '$faculty_id' and
                     t.time = ts.time_section and t.class_no='$sessionclass' and t.day='$sessionday' and
                      t.time='$aa' and t.course='$facn'";
                $result0 = $conn->query($day3);
                if ($result0->num_rows > 0)
                    $x++;
                else
                    break;
            }
            echo '<option value=" "> Select Duration </option>';
            //echo '<option value=' . $x . '>' . $x.' -' .$timme.' -' .$aa.  '</option>';
            for ($i = 1; $i < $x + 1; $i++)
                echo '<option value=' . $i . '>' . $i . '</option>';

        }
    }}
?>