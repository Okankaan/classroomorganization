<?php
include "db_connection.php";
session_start();
if(!empty($_SESSION["ID"])) {
    if ($_SESSION["user_type"] == "1") {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $id=$_GET["snd_edituser"];
            $_SESSION["userid"]=$id;
            $temp=$_SESSION["userid"];
            $faculty = "SELECT * FROM users u,faculty f where u.faculty=f.F_ID AND ID='$id'";
            $faculty2 = "SELECT * FROM users  where (faculty='0' OR faculty='-1') AND ID='$id'";
            $facultyOfAdmin = "SELECT * FROM users u,faculty f where u.faculty=f.F_ID AND ID='112'";
            $result2 = $conn->query($faculty);
            $result3 = $conn->query($faculty2);
            if($faculty!=$facultyOfAdmin)
            {
                if ($result2->num_rows > 0) {
                    while ($fill2 = $result2->fetch_assoc()) {
                        $id2 = $fill2['ID'];
                        $uname2 = $fill2['U_Name'];
                        $surname2 = $fill2['surname'];
                        $pw2 = $fill2['pw'];
                        $type2 = $fill2['user_type'];
                        $mail2 = $fill2['e_mail'];
                        $fac2 = $fill2['faculty'];
                        $fac22 = $fill2['F_Name'];
                        $recoverymail2=$fill2['recovery_email'];
                        if($type2=="1")
                            $type22="Administrator";
                        else if($type2=="3")
                            $type22="Faculty Staff";
                        else if($type2=="2")
                            $type22="Rectorate Staff";
                    }
                }
                if ($result3->num_rows > 0) {
                    while ($fill2 = $result3->fetch_assoc()) {
                        $id2 = $fill2['ID'];
                        $uname2 = $fill2['U_Name'];
                        $surname2 = $fill2['surname'];
                        $pw2 = $fill2['pw'];
                        $type2 = $fill2['user_type'];
                        $mail2 = $fill2['e_mail'];
                        $fac2 = $fill2['faculty'];
                        $recoverymail2=$fill2['recovery_email'];
                        if($type2=="1")
                            $type22="Administrator";
                        else if($type2=="3")
                            $type22="Faculty Staff";
                        else if($type2=="2")
                            $type22="Rectorate Staff";
                    }
                }
            }
            else
            {
                echo "You can not edit to Admin";
                EditCheck();
            }




            echo '
                <script>
        function EditCheck() {
            
            document.getElementById("editPart").style.visibility = "hidden";
        }
        </script>
      <script>
        

            $(function() {
                    $("#usertype2").on("change", function() {
                       var usertype = $("#usertype2").val();
                     if(usertype=="3"){
                      $("#faculty2").show();
                      
                      document.getElementById("faculty212").style.visibility = "visible";
                     }
                     else{
                          $("#faculty2").hide();
                     document.getElementById("faculty212").style.visibility = "hidden";
                     }
                     });
             $("#edituser2").on("click", function() {
                 
                    var email = $("#email2").val();
                    var uname = $("#uname2").val();
                    var surname = $("#surname2").val();
                    var usertype = $("#usertype2").val();
                    var faculty = $("#faculty2").val();
                    var recoverymail=$("#recoverymail2").val();
                    if(usertype=="1")
                     {
                         faculty="0";
                     }
                     else if(usertype=="2")
                         {
                             faculty="-1";
                         }
               
                    console.log("1");
                    console.log(email);
                    console.log("2");
                    console.log(recoverymail);
                    console.log("3");
                    console.log(uname);
                    console.log("4");
                    console.log(surname);
                    console.log("5");
                    console.log(faculty);
                    console.log("6");
                    console.log(usertype);
               $.ajax({
              type: "GET",
              url: "user_exsisting_check.php",
                data: ({}),
              success: function(data) {
              if(data=="false"){
              window.location.href = "index.html";
              }
                else{
                if(usertype=="3" && (faculty=="-1"  || faculty=="0"))
                     window.alert("Please change faculty");
                    else 
                  $.ajax({
                      type: "GET",
                      url: "user_update_drop.php" ,      
                      data: ({snd_email2:email,snd_recoverymail2:recoverymail,snd_uname2:uname,snd_surname2:surname,snd_faculty2:faculty,snd_usertype2:usertype}),
                      success: function(data) {
                      window.alert(data);
                        window.location.reload(true);
                      }
                    });  
                    }
                    }
              });
              });
            $("#delete").on("click", function() {
                $.ajax({
              type: "GET",
              url: "user_exsisting_check.php",
                data: ({}),
              success: function(data) {
              if(data=="false"){
              window.location.href = "index.html";
              }
                else{
                     $(".ui.basic.modal").modal("show");
                      $("#onaybutton").on("click", function() {
                                      $.ajax({
                                      type: "POST",
                                      url: "user_update_drop.php" ,      
                                      data: ({}),
                                      success: function(data) {
                                      if(data=="delete successful"){
                                      window.alert(data);
                                      window.location.reload(true);
                                      }
                                      else {
                                       window.alert(data);
                                      }      
                                      }
                                    });  
        
                       });
                       $("#redbutton").on("click", function() {
                       window.location.reload(true);
                       });
                                           }
                    }
              });
             });
            });
        </script>
    <script>
        $(document).ready(function(){ 
         $(\'select .dropdown\').dropdown(); 
  var faculty = $("#faculty2").val();
         //var $labelfaculty = $("faculty212");
             if(faculty=="0" || faculty=="-1"){
                     $("#faculty2").hide();
                    document.getElementById("faculty212").style.visibility = "hidden";
                     }
                    else 
                        {
                         $("#faculty2").show();
                         document.getElementById("faculty212").style.visibility = "visible";
                         }
                    });
                    </script>
      
              <div class="ui form" id="editPart">
              <div class="two fields">

                    <div class="field">
                      <label>E-mail</label>
                      <input  id="email2" type="text" value='.$mail2.' >
                    </div>
                    <div class="field">
                    <label>Recovery Mail</label>
                      <input  id="recoverymail2" type="text" value='.$recoverymail2.' >
                    </div>
                
              </div>

              <div class="two fields">
                <div class="field">
                  <label>Name</label>
                  <input  id="uname2" type="text" value='.$uname2.'> 
                </div>
                <div class="field">
                  <label>Surname</label>
                  <input id="surname2" type="text" value='.$surname2.'>
                </div>
              </div>
              <div class="two fields">
                <div class="field">
                 <label>User Type</label>
                     <select class="ui search dropdown" id="usertype2" >
                        <option value='.$type2.'>'.$type22.'</option>
                        <option value="1">Administrator</option>
                        <option value="3">Faculty Staff</option>
                        <option value="2">Rectorate Staff</option>
                    </select>
                </div>
                <div class="field">
                <label id="faculty212">Faculty</label>
                 <select class="ui search dropdown" id="faculty2">
                        <option value='.$fac2.'>'.$fac22.'</option>
                        ';
            $faculty = "select * from faculty";
            $result2 = $conn->query($faculty);
            if ($result2->num_rows > 0) {
                while ($fill2 = $result2->fetch_assoc()) {
                    $fac_id = $fill2['F_ID'];
                    $fac_name = $fill2['F_Name'];
                    echo "<option value=$fac_id>$fac_name</option>";
                }
            }
            echo '
                </select>
                </div>
              </div>
              <div class="ui teal submit button" id="edituser2"><i class="write square icon"></i>Edit User</div>
              <div class="ui red submit button" id="delete">Delete User</div>
              <div class="ui error message"></div>
              <div class="ui basic modal" >
                          <i class="close icon"></i>
                          <div class="header">
                            Delete User
                          </div>
                          <div class="image content">
                            <div class="image">
                              <i class="trash icon"></i>
                            </div>
                            <div class="description">
                              <p>Do you want to delete selected user?</p>
                            </div>
                          </div>
                          <div class="actions">
                            <div class="two fluid ui inverted buttons">
                              <div class="ui cancel red basic inverted button" id="redbutton">
                                <i class="remove icon"></i>
                                No
                              </div>
                              <div class="ui ok green basic inverted button" id="onaybutton">
                                <i class="checkmark icon"></i>
                                Yes
                              </div>
                            </div>
                          </div>
                        </div>
            </div>
        ';
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

        }
    }
}