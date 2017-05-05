<?php
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


    <script>

        $(document).ready(function()

        {
            $("#forgotPasword").on("click ", function () {
                
                var umail = $("#usermail").val();
                $.ajax({
                    type: "POST",
                    url: "forgotsendmail.php",
                    data: ({umaill:umail}),
                    success: function(data) {
                    window.alert("reset mail sent.");
                    }
                });
            });
            
            });
     
    </script>
</head>
<body>
';




echo '
<div class="ui top fixed menu">
    <div class="item">
        <img src="images/logoen.png">
    </div>
    <div class="item"><b>Classroom Organization System</b></div>

</div>


<div class="ui middle aligned center aligned grid">
    <div class="column">
        <h2 class="ui image header">
            <img src="images/logo_bordered.png" class="image">
            <div class="content">
                Send Password reset mail
            </div>
        </h2>
        <form class="ui large form">
            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text"  id="usermail" placeholder="User E-mail address">
                    </div>
                </div>


                <div class="ui fluid blue button" id="forgotPasword">Send Mail</div>
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
?>