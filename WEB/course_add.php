<?php
include "db_connection.php";
session_start();
if(!empty($_SESSION["ID"])) {
    if ($_SESSION["user_type"] == "3") {
        $faculty_id = $_SESSION["faculty_id"];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $code=$_POST["coursecode"];
            $section=$_POST["coursesection"];
            $coursename=$_POST["ccoursename"];
            $totalduration=$_POST["duration"];
            $Uid=$_SESSION['ID'];
            $tip=$_SESSION['user_type'];
            $user = "select ID from users WHERE ID='$Uid' AND user_type='$tip' AND faculty='$faculty_id'";
            $result1 = $conn->query($user);
            if ($result1->num_rows == 0) {
                session_destroy();
                echo "Your account deleted! Please contact with a System Admin.";
            }
            else {
                if($section=="")
                    $section=0;
                $selectquery = "INSERT INTO course(code_section,name,duration,faculty) 
VALUES ('$code.$section','$coursename','$totalduration','$faculty_id')";
                $exe1 = $conn->query($selectquery);
            }
            if($exe1){
                echo "1";
            }
            else
                echo mysqli_error($conn);
        }
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $selectquery2 = "SELECT * FROM course WHERE faculty='$faculty_id'";
            $exe2 = $conn->query($selectquery2);
            if ($exe2->num_rows > 0) {
                echo '
            <table class="ui compact celled table" >
                <thead>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Total Duration</th>
                </thead>
                <tbody>
            ';
                while ($fill = $exe2->fetch_assoc()) {
                    $cs2 = $fill['code_section'];
                    $n2 = $fill['name'];
                    $dr2 = $fill['duration'];
                    echo "
                     <tr>
                        <td>$cs2</td>
                        <td>$n2</td>
                        <td>$dr2</td>
                    </tr>
                    ";
                }
                echo '
            </tbody>
            </table>
            ';
            }
        }
    }
}