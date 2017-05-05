<?php
include "db_connection.php";
session_start();
if(!empty($_SESSION["ID"])) {
    if ($_SESSION["user_type"] == "3") {
        $sessionday=$_SESSION['selectedday'];
        $sessionclass=$_SESSION['selectedclass'];
        $faculty_id = $_SESSION["faculty_id"];
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $dration2=$_GET['selectdration'];
            $course2=$_GET['addcourse'];
            $time2=$_GET['tata'];


    /*        $drationcontrol = "select duration,course from ttable where
                    day='$sessionday' and time='$time2' and 
                    class_no='$sessionclass' and faculty='$faculty_id'";
            $result4 = $conn->query($drationcontrol);
            if ($result4->num_rows > 0) {
                while ($fill = $result4->fetch_assoc()) {
                    $chck_dration = $fill['duration'];
                    $tkcourse = $fill['course'];
                }
            }
            if($chck_dration<$dration2)
                echo "error1";
            elseif($chck_dration>$dration2) {
                $tt=($time2+$dration2);
                $dr=($chck_dration-$dration2);
                $sqlsor="UPDATE ttable SET course='$course2',duration='$dr' where 
                    day='$sessionday' and time='$time2' and 
                    class_no='$sessionclass' and faculty='$faculty_id'";

                $sqlsor2="INSERT INTO ttable (class_no,day,time,duration,course,faculty)
                            VALUES ('$sessionclass','$sessionday','$tt','$dration2','$tkcourse','$faculty_id')";
                $exe = $conn->query($sqlsor);
                $exe2 = $conn->query($sqlsor2);
            }
            elseif($chck_dration==$dration2){
                $sqlsor="UPDATE ttable SET course='$course2' where 
                    day='$sessionday' and time='$time2' and 
                    class_no='$sessionclass' and faculty='$faculty_id' and duration='$dration2' ";
            $exe = $conn->query($sqlsor);
                }
                */
            $array=[];
            $selectquery = "select * from ttable where 
                    day='$sessionday'  and 
                    class_no='$sessionclass' and faculty='$faculty_id'";
            $exe1 = $conn->query($selectquery);
            if ($exe1->num_rows > 0) {
                while ($row = $exe1->fetch_assoc()) {
                    $ttime = $row['time'];
                    $dduration = $row['duration'];
                    $result = ($ttime + $dduration);
                    for ($i = $ttime; $i < $result; $i++) {
                        $array[$i] = "F";
                    }
                }
            } else
                echo "null";
            $result2 = ($time2 + $dration2);
            for ($i = $time2; $i < $result2; $i++) {
                 $array[$i] = 'x';
            }
            $x=0;$a=0;$z=0;
         /*   $sql="DELETE FROM ttable WHERE day='$sessionday' and
                                  time='$ttime' and duration='$dduration' and
                                  class_no='$sessionclass' and faculty='$faculty_id' ";
            $exe = $conn->query($sql);*/
            if ($exe1->num_rows > 0) {
                while ($row = $exe1->fetch_assoc()) {
                    $ttime = $row['time'];
                    $dduration = $row['duration'];
                    $result = ($ttime + $dduration);
                    for ($i = $ttime; $i < $result; $i++) {
                        if($array[$i]=='F'){
                            $x++;
                        }
                        elseif ($array[$i]=='x'){
                            while(isset($array)){
                                if ($array[$i]=='x')
                                    $a++;
                            elseif ($array[$i]=='F')
                                $z++;
                            }}
                    }

                    }
                }
            $drationcontrol = "select duration,course from ttable where
                    day='$sessionday' and time='$time2' and 
                    class_no='$sessionclass' and faculty='$faculty_id'";
            $result4 = $conn->query($drationcontrol);
            if ($result4->num_rows > 0) {
                while ($fill = $result4->fetch_assoc()) {
                    $tkcourse = $fill['course'];
                    $chckduration=$fill['duration'];
                }
            }
               /* if($x!=0 || $z!=0){
           $sql="DELETE FROM ttable WHERE day='$sessionday' and
                                  time='$time2' and duration='$dration2' and
                                  class_no='$sessionclass' and faculty='$faculty_id' ";
                    $sql2="INSERT INTO ttable(class_no,day,time,duration,faculty,course)
                        VALUES ('$sessionclass','$sessionday','$time2','$x','$faculty_id','$tkcourse')";
                    $r1=$time2+$x;
                    $sql3="INSERT INTO ttable(class_no,day,time,duration,faculty,course)
                        VALUES ('$sessionclass','$sessionday','$r1','$a','$faculty_id','$course2')";
                    $r2=$r1+$a;
                    $sql4="INSERT INTO ttable(class_no,day,time,duration,faculty,course)
                        VALUES ('$sessionclass','$sessionday','$r2','$z','$faculty_id','$tkcourse')";
                    $result1 = $conn->query($sql);
                    $result2 = $conn->query($sql2);
                    $result3 = $conn->query($sql3);
                    $result4 = $conn->query($sql4);
                }
                else*/
            $Uid=$_SESSION['ID'];
            $tip=$_SESSION['user_type'];
            $user = "select ID from users WHERE ID='$Uid' AND user_type='$tip'AND faculty='$faculty_id'";
            $result1 = $conn->query($user);
            if ($result1->num_rows == 0) {
                session_destroy();
                echo "Your account deleted! Please contact with a System Admin.";
            }
            else{
               for ($i=$time2;$i<$time2+$dration2;$i++) {
                   $esquel = "DELETE FROM ttable WHERE 
                   day='$sessionday' AND time='$i' AND duration=1";
                   $exee = $conn->query($esquel);
               }
               if($exee){
                    $sqlsor="INSERT INTO ttable (class_no,day,time,duration,course,faculty) VALUES ('$sessionclass','$sessionday',$time2,$dration2,'$course2','$faculty_id')";
                    $exe = $conn->query($sqlsor);
               }}
           // print_r($array);
          //  echo $x.$z.$a;
        }
    }
}