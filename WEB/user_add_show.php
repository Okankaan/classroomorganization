<?php
include "db_connection.php";
session_start();
if(!empty($_SESSION["ID"])) {
    if ($_SESSION["user_type"] == "1") {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['snd_id'];
            $email = $_POST['snd_email'];
            $recoveryemail = $_POST['snd_recoveryemail'];
            $password = $_POST['snd_password'];
            $hashedpw = hash("sha256",$password);
            $uname = $_POST['snd_uname'];
            $surname = $_POST['snd_surname'];
            $usertype = $_POST['snd_usertype'];
            $faculty = $_POST['snd_faculty'];
            if($faculty==""||$faculty==null)
            {
                if ($usertype=='1')
                {
                    $faculty='0';
                    $sql = "INSERT INTO users (ID,U_Name,surname,pw,user_type,e_mail,faculty,recovery_email)
            VALUES ('$id', '$uname','$surname','$hashedpw','$usertype','$email@n00ne.xyz','$faculty','$recoveryemail')";
                    $exe = $conn->query($sql);
                    if ($exe) {
                        echo "1";
                    } else {
                        echo mysqli_error($conn);
                    }

                    $conn->close();
                }
                else if($usertype=='2')
                {
                    $faculty='-1';
                    $sql = "INSERT INTO users (ID,U_Name,surname,pw,user_type,e_mail,faculty,recovery_email)
            VALUES ('$id', '$uname','$surname','$hashedpw','$usertype','$email@n00ne.xyz','$faculty','$recoveryemail')";
                    $exe = $conn->query($sql);
                    if ($exe) {
                        echo "1";
                    } else {
                        echo mysqli_error($conn);
                    }

                    $conn->close();
                }
            }
            elseif ($faculty!=""||$faculty!=null) {
                $sql = "INSERT INTO users (ID,U_Name,surname,pw,user_type,e_mail,faculty,recovery_email)
            VALUES ('$id', '$uname','$surname','$hashedpw','$usertype','$email@n00ne.xyz','$faculty','$recoveryemail')";
                $exe = $conn->query($sql);
                if ($exe) {
                    echo "1";
                } else {
                    echo mysqli_error($conn);
                }

                $conn->close();

            }
            else
                echo "please select faculty!";

        }
        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            $sql = "SELECT * FROM users u,faculty f where u.faculty=f.F_ID /* or u.faculty='null'*/";
            $result = $conn->query($sql);
            $sql2 = "SELECT * FROM users u where u.faculty='0' OR u.faculty='-1'";
           $result2 = $conn->query($sql2);
            if ($result->num_rows > 0) {
                echo '
            <table class="ui compact celled table" >
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>User Type</th>
                    <th>Email</th>
                    <th>Faculty</th>
                </thead>
                <tbody>
            ';
                while ($fill = $result->fetch_assoc()) {
                    $id2 = $fill['ID'];
                    $uname2 = $fill['U_Name'];
                    $surname2 = $fill['surname'];
                    $type2 = $fill['user_type'];
                    $mail2 = $fill['e_mail'];
                    $fac2 = $fill['F_Name'];
                    if ($type2 == "1")
                        $type2 = "Administrator";
                    else if ($type2 == "3")
                        $type2 = "Faculty Staff";
                    else if ($type2 == "2")
                        $type2 = "Rectorate Staff";
                    echo "
                     <tr>
                        <td>$id2</td>
                        <td>$uname2</td>
                        <td>$surname2</td>
                        <td>$type2</td>
                        <td>$mail2</td>
                        <td>$fac2</td>

                    </tr>
                    ";
                }
                while ($fill = $result2->fetch_assoc()) {
                    $id2 = $fill['ID'];
                    $uname2 = $fill['U_Name'];
                    $surname2 = $fill['surname'];
                    $type2 = $fill['user_type'];
                    $mail2 = $fill['e_mail'];
                    $fac2 = $fill['F_Name'];
                    if ($type2 == "1")
                        $type2 = "Administrator";
                    else if ($type2 == "3")
                        $type2 = "Faculty Staff";
                    else if ($type2 == "2")
                        $type2 = "Rectorate Staff";
                    echo "
                     <tr>
                        <td>$id2</td>
                        <td>$uname2</td>
                        <td>$surname2</td>
                        <td>$type2</td>
                        <td>$mail2</td>
                        <td>$fac2</td>

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
?>

