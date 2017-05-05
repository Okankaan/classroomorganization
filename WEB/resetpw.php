<?php
session_start();
include "db_connection.php";
$umail=$_GET['email'];
$_SESSION['eema']=$umail;
$id=$_GET['id'];
$pw=$_GET['pwww'];
$sql="select ID,pw from users WHERE e_mail='$umail' ";
$exe = $conn->query($sql);

if ($exe->num_rows > 0) {
    while ($row = $exe->fetch_assoc()) {
        $idd = $row['ID'];
        $pass = $row['pw'];
        $hash = hash("sha256", $idd);
    }
}


if($hash==$id) {
    if ($pw == $pass) {
        echo '
<html>
<head>
    <title>Classroom Organization System</title>
    <link rel="stylesheet" type="text/css" href="semantic/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="semantic/semantic.css">
    <script src="scripts/jquery.min.js"></script>
    <script src="scripts/form.js"></script>
    <script src="scripts/transition.js"></script>

    <style type="text/css">
        body {
            background-color: rgba(5, 4, 31, 0.96);
        }
        body > .grid {
            height: 100%;
        }
        .image {
            margin-top: -100px;
        }
        .column {
            max-width: 450px;
        }
        .ui.image.header{
            color: white;
        }

    </style>
<head>
<div class="ui top fixed menu">
    <div class="item">
        <img src="images/logoen.png">
    </div>
    <div class="item"><b>Classroom Organization System</b></div>

</div>

<script>
$(function() {
  $("#save").on("click", function() {
         var pass = $("#pw").val();
          $.ajax({
              type: "POST",
              url: "resetpwsuccess.php" ,      
                data: ({pww:pass}),
              success: function(data) {
                  window.alert(data);
               window.location.replace("http://n00ne.xyz");
              }
            });  

      });
  });
 </script>
<div class="ui middle aligned center aligned grid">
    <div class="column">
        <h2 class="ui image header">
            <img src="images/logo_bordered.png" class="image">
            <div class="content">
                Reset your password
            </div>
        </h2>
        <form class="ui large form">
            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" id="pw" placeholder="enter new password">
                    </div>
                </div>
       

                <div class="ui fluid blue button" id="save">Save Password</div>
            </div>


            <div class="ui message">

            </div>
            <div class="ui error message"></div>
        </form>

    </div>
</div>
</body>

</html>
    ';

    } else
        echo "password actually changed with this link.";
}