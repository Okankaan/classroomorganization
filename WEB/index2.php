<?php
session_start();
if (!empty($_SESSION["ID"])) {
    include "db_connection.php";
    $ses_id=$_SESSION["ID"];
    $stmt2 ="SELECT ID FROM users WHERE ID='$ses_id'";
    $result3=$conn->query($stmt2);
   $rows=$result3->fetch_assoc();

        if ($_SESSION["user_type"]== "1")
        {
            include "admin_panel.php";
        }
        elseif ($_SESSION["user_type"]== "2")
        {
            include "rectorate_panel2.php";
        }
        elseif ($_SESSION["user_type"]== "3")
        {
            include "faculty_panel.php";
        }

}
else
{
    echo "You need to open session";
    echo "<br><br><img src=\"https://media.tenor.co/images/706e4ef37ce42b14878fa853c64cd0dc/raw\" style=\"width:304px;height:228px;\">";
  header("refresh:10;Location:index.html");
    die();
}
?>