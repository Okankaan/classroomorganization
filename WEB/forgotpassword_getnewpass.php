

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
    <script language="JavaScript">
        $(document)
            .ready(function() {
                $('.ui.form').form({
                    inline: true,
                    on:  'blur',
                    fields: {
                        email: {
                            identifier  : 'email',
                            rules: [
                                {
                                    type   : 'empty',
                                    prompt : 'Please enter your e-mail'
                                },
                                {
                                    type   : 'email',
                                    prompt : 'Please enter a valid e-mail'
                                }
                            ]
                        }
                    }

                })

            });

    </script>

    <script>

        $(document).ready(function()

        {
            $("#forgotPasword").on("click ", function () {

                var email = $("#email").val();
                if($.trim(email).length>0) {

                    $.ajax({
                        type: "POST",
                        url: "login.php",
                        data: dataString,
                        cache: false,
                        dataType: "json",
                        beforeSend: function () {
                            $('#forgotPasword').addClass('loading');
                        },
                        success: function (data) {
                            if (data["success"] != 1) {

                                $('#signin').removeClass('loading');
                                Window.alert("Wrong e-mail");
                            }
                            else {
                                window.location.href = "index2.php";
                            }
                        }
                    });

                }
            });
        });

    </script>
</head>
<body>
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
                Log-in to your account
            </div>
        </h2>
        <form class="ui large form">
            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text" name="email" id="email" placeholder="E-mail address">
                        <br>
                        <input type="password" name="pwforgot" id="pwforgot" placeholder="New Password">
                        <br>
                        <input type="password" name="pwforgot" id="pwforgot" placeholder="Repeat New Password">
                    </div>
                </div>

                <div class="ui fluid blue button" id="forgotPasword">Login</div>
            </div>


            <div class="ui message">
                <h5 class="ui header">
                    <div class="sub header">
                        If you do not have account please contact with system administrator.
                    </div>
                </h5>
            </div>
            <div class="ui error message"></div>
        </form>

    </div>
</div>

</body>
</html>

