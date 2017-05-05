<?php
include "db_connection.php";
session_start();
if(!empty($_SESSION["ID"])) {
    if ($_SESSION["user_type"] == "2") {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $F_Name = $_POST['snd_F_Name'];
            $genID = substr($F_Name, 0, 3);
            $checkclas = "SELECT  F_ID 
                        FROM faculty
                        WHERE F_ID LIKE '$genID%'";
            $result4 = $conn->query($checkclas);
            if ($result4->num_rows > 0) {
                $a = $result4->num_rows;
                $x = $a + 1;
                //ilk 3 harfle bsalayan varmı diye baktı.varsa if in içine girdi ve adet saydı.ona 1 ekledi.

                $sql = "INSERT INTO faculty (F_ID, F_Name)
            VALUES ('$genID$x', '$F_Name')";
                $exe = $conn->query($sql);
                if ($exe) {
                    echo "1";
                } else {

                    echo mysqli_error($conn);
                }
            }
            else{
                $sql = "INSERT INTO faculty (F_ID, F_Name)
            VALUES ('$genID', '$F_Name')";
                $exe = $conn->query($sql);
                if ($exe) {
                    echo "1";
                } else {

                    echo mysqli_error($conn);
                }
            }


        }
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $sorgusql = "select * from faculty";
                $exe121 = $conn->query($sorgusql);
                echo '
            <table class="ui compact celled table">
            <thead>
            <th>Faculty ID</th>
            <th>Faculty Name</th>
            </thead>
            <tbody>
            ';
                while ($fill = $exe121->fetch_assoc()) {
                    $idd = $fill['F_ID'];
                    $namee = $fill['F_Name'];

                    echo '
           
                <tr>
                    <td>' . $idd . '</td>
                    <td>' . $namee . '</td>
                </tr>
           
            ';
                }
                echo '
            </tbody>
            </table>';
            }


    }
}