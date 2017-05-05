<?php
include "db_connection.php";
if(!empty($_SESSION["ID"])) {
    if ($_SESSION["user_type"] == "1") {
        $id=$_SESSION["ID"];
        echo '
<!DOCTYPE html>

<html>
<head>
    <title>Classroom Organization System</title>
    <link rel="stylesheet" type="text/css" href="semantic/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="semantic/semantic.css">
    <script src="scripts/jquery.min.js"></script>
     <script src="semantic/semantic.min.js"></script>
      <script src="semantic/semantic.js"></script>
    <script src="scripts/form.js"></script>
    <script src="semantic/components/tab.js"></script>
     <script src="semantic/components/tab.min.js"></script>
    <script src="scripts/transition.js"></script>
    <script type="text/javascript" src="scripts/html2canvas.js"></script>
	<script type="text/javascript" src="scripts/jspdf.min.js"></script>
	<script src="scripts/jquery.table2excel.js"></script>


    <style type="text/css">
        body {
            background-color: rgba(5, 4, 31, 0.96);
        }
        body > .grid {
            height: 100%;
        }
    </style>
</head>
<body>

<script>


$(document).ready(function(){

    $("#signout").on("click", function () {
          $.ajax({
            type: "GET",
            url: "logout.php",
            cache: false,
            dataType: "json",
            beforeSend: function () {
              $(\'#logout\').addClass(\'loading\');
            },
            success: function (data) {
              if (data["success"] != 1) {
                $(\'#logout\').removeClass(\'loading\');
              }
              else {
                window.location.href = "index.html";
              }
            }
          });
    });
    $(\'.menu .item\').tab();
    $(\'select .dropdown\').dropdown();  
     $(\'.ui.accordion\').accordion();
       $.ajax({
      type: "GET",
      url: "mail/read_mail2.php",
      data: ({}),
      success: function(data) {
             $("#mail").html(data);
        
      }
    }); 
});
</script>
<script>
   /* $(document)
                .ready(function() {
                    $(\'.ui.form\').form({
                                inline: true,
                                on:  \'blur\',
                                fields: {
                                    id: {
                                        identifier  : \'id\',
                                        rules: [
                                            {
                                                type   : \'empty\',
                                                prompt : \'Please enter id number\'
                                            }
                                        ]
                                    },
                                     email: {
                                        identifier  : \'email\',
                                        rules: [
                                            {
                                                type   : \'empty\',
                                                prompt : \'Please enter email\'
                                            },
                                            {
                                                type   : \'email\',
                                                prompt : \'Please enter email in email format\'
                                            }
                                        ]
                                    },
                                     password: {
                                        identifier  : \'password\',
                                        rules: [
                                            {
                                                type   : \'empty\',
                                                prompt : \'Please enter password\'
                                            }
                                        ]
                                    },
                                      uname: {
                                        identifier  : \'uname\',
                                        rules: [
                                            {
                                                type   : \'empty\',
                                                prompt : \'Please enter name\'
                                            }
                                        ]
                                    },
                                     surname: {
                                        identifier  : \'surname\',
                                        rules: [
                                            {
                                                type   : \'empty\',
                                                prompt : \'Please enter surname\'
                                                
                                            }
                                        ]
                                    },
                                    usertype: {
                                        identifier  : \'usertype\',
                                        rules: [
                                            {
                                                type   : \'empty\',
                                                prompt : \'Please select usertype\'
                                            }

                                        ]
                                    },
                                    faculty: {
                                        identifier  : \'faculty\',
                                        rules: [
                                            {
                                                type   : \'empty\',
                                                prompt : \'Please select faculty\'
                                            }

                                        ]
                                    }
                                }

                            })

                });*/
    $(function(){
     $.ajax({
              type: "GET",
              url: "user_add_show.php",
              success: function(data) {  
               $("#showusers").html(data); 
               $("#showusers2").html(data); 
              }
            });  
        $("#adduser").on("click", function() {
          var intRegex=/[0-9 -()+]+$/;
          var emailRegex = \'^[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}$\';
            var id = $("#id").val();
            var email = $("#email").val();
            var password = $("#password").val();
            var recoveryemail = $("#recoveryemail").val();
            var uname = $("#uname").val();
            var surname = $("#surname").val();
            var usertype = $("#usertype").val();
            var faculty = $("#faculty").val();
            
             if(usertype=="1")
                     {
                         faculty="0";
                     }
              else if(usertype=="2")
                     {
                             faculty="-1";
                      }
            
            if($.trim(id)!=false) {
                if(intRegex.test(id)==true){
                    
                    if($.trim(email)!=false){
                        if($.trim(password)!=false){
                            if($.trim(recoveryemail)!=false){
                                if($.trim(uname)!=false){
                                     if(intRegex.test(uname)==false){
                                            if($.trim(surname)!=false){
                                                if(intRegex.test(surname)==false)
                                                    {
                                                    if($.trim(usertype)!=false){
                                                                  $.ajax({
              type: "GET",
              url: "user_exsisting_check.php",
                data: ({}),
              success: function(data) {
              if(data=="false"){
              window.location.href = "index.html";
              }
                else{
  

                                                            $.ajax({
                                                                      type: "POST",
                                                                      url: "user_add_show.php",
                                                                      data: ({snd_id:id,snd_email:email,snd_password:password,snd_recoveryemail:recoveryemail,snd_usertype:usertype,snd_uname:uname,snd_surname:surname,snd_faculty:faculty}),
                                                                      success: function(data) {  
                                                                       if(data==1){
                                          
                                                                            window.alert("New record added successfully");
                                                                            window.location.reload(true);
                                                                           }
                                                                           else {
                                                                              window.alert(data);
                                                                              }
                                                                      }
                                                            }); 
                                                            }
                                                                       }
            });
                                                    }
                                                     else {
                                                         alert("Please enter all informations");
                                                             }
                                                }
                                                else {
                                                    alert("Please enter just string character");
                                                  }
                                            }
                                             else {
                                                    alert("Please enter all informations");
                                                  }
                                         }
                                         
                                         else {
                                                    alert("Please enter just string character");
                                                  }
                                }
                                 else {
                                      alert("Please enter all informations");
                             }
                            
                            }
                            else {
                                      alert("Please enter all informations");
                             }
                        }
                         else {
                              alert("Please enter all informations");
                               }
                    }
                     else {
                           alert("Please enter all informations");
                          }
                } 
                 else {
                        alert("Please enter just number");
                       }
            }
             else {
                        alert("Please enter all informations");
                   }
      });
        
        });
     
</script>
<script>
$(document).ready(function(){ 
$("#nne").prop(\'disabled\', true);

       $.ajax({
              type: "GET",
              url: "user_exsisting_check.php",
                data: ({}),
              success: function(data) {
              if(data=="false"){
              window.location.href = "index.html";
              }
              }
            });  
  

   }); 
</script>
<script>
$(function() {
$("#usercombo").on("change", function() {
             var comboedit2 = $("#usercombo").val();
             $.ajax({
              type: "GET",
              url: "user_edit.php",
                data: ({snd_edituser:comboedit2}),
              success: function(data) {
                $("#editform").html(data); 
              }
            });  
     $("#editform").show();
      });
   }); 
</script>
<div class="ui top fixed menu">
    <div class="item">
        <img src="images/logoen.png">
    </div>
    <div class="item"><b>Classroom Organization System</b></div>
   <div class="right menu">
    <div class="item">
      <b>
   ';
        $user = "select U_Name,surname from users where ID=$id";
        $result212 = $conn->query($user);
        if ($result212->num_rows > 0) {
            while ($fill = $result212->fetch_assoc()) {
                $nn = $fill['U_Name'];
                $sn =  $fill['surname'];
            }
        }
        echo $nn." ".$sn;
        echo '
</b>
</div>
    <div class="item">
   <b> Admin Panel</b>
    </div>
    <div class=" item">
        <button class="ui grey button" id="signout">Logout</button>
    </div>
    </div>
</div>
<br>
<br><br>
<table align="center" width="1300"><tr><td>
<div class="ui grid">
<div class="four wide column">
   <div class="ui segment">
     <div class="ui vertical fluid tabular menu">
      <a class="active item" data-tab="a">
        Add User
      </a>
      <a class="item" data-tab="b">
        Edit/Delete User
      </a>
      <a class="item" data-tab="c">
        Export Classroom as PDF/CSV
      </a>
       <a class="item" data-tab="d">
        Mailbox
      </a>
    </div>
  </div>

  </div>
  <div class="twelve wide stretched column" >
      <div class="ui fluid tab segment" data-tab="d">
          <div class="ui fluid accordion">
                  <div class="active title">
                   
                   <h4 class="ui horizontal divider header">
                    <i class="mail icon"></i>
                       MAIL LOGS
                    </h4>
                     <i class="dropdown icon"></i>
                  </div>
                  <div class="active content">
                    <div class="ui basic segment" id="mail"></div>
                  </div>
                 
          </div>
</div>
    <div class="ui tab segment active" data-tab="a">
    <div id="showusers"></div>
    <div class="ui segment">
        <form class="ui form">
  <div class="two fields">
    <div class="field">
      <label>ID</label>
      <input name="id" id="id" type="text" >
    </div>
    <div class="field">
      <label>E-mail Username</label>
      <input name="email" id="email" type="text">
      <input name="nne" id="nne" type="text" value="@n00ne.xyz">
    </div>
  </div>
   <div class="two fields">
 
  <div class="field">
      <label>Password</label>
      <input name="password" id="password" type="password"> 
    </div>
     <div class="field">
      <label>Recovery E-mail</label>
      <input name="email" id="recoveryemail" type="text" >
    </div>
    </div>
  <div class="two fields">
    <div class="field">
      <label>Name</label>
      <input name="uname" id="uname" type="text">
    </div>
    <div class="field">
      <label>Surname</label>
      <input name="surname" id="surname" type="text">
    </div>
  </div>
  <div class="two fields">
    <div class="field">
     <label>User Type</label>
         <select class="ui search dropdown" id="usertype" onChange="FacultyFunction()">
            <option value="">Select User Type</option> 
            <option value="1">Administrator</option>
            <option value="3">Faculty Staff</option>
            <option value="2">Rectorate Staff</option>
        </select>
    </div>
    <div class="field">
    <label id="facultyLabel" style="visibility:hidden;">Faculty</label>
     <select class="ui search dropdown" id="faculty" style="visibility:hidden;">
           <option value="">Select Faculty</option>
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
  <script>
       function FacultyFunction() 
               {
                var x = document.getElementById("usertype").selectedIndex;
               // alert(x);
                if(x!=2)
                    {
                        document.getElementById("faculty").style.visibility = "hidden";
                        document.getElementById("facultyLabel").style.visibility = "hidden";
                    }
                    else 
                    {
                            document.getElementById("faculty").style.visibility = "visible";
                            document.getElementById("facultyLabel").style.visibility = "visible";
                            // facultyBos="1"; 
                    }
                }
        
  </script>
  <div class="ui teal submit button" id="adduser"><i class="add user icon"></i>Add User</div>
  <div class="ui error message"></div>
</form>
</div>
    </div>
    
    <script>
$(function() {
  $("#usercombo").on("change", function() {
         var comboedit = $("#usercombo").val();
          $.ajax({
              type: "GET",
              url: "user_edit.php" ,      
                data: ({snd_edituser:comboedit}),
              success: function(data) {
                $("#editform").html(data); 
              }
            });  
     $("#editform").show();
      });

});           
</script>
    
    <div class="ui tab segment" data-tab="b">
    
               
                 <div id="showusers2"></div>
                 <div class="ui segment">
                         <div class="field">
                             <select class="ui fluid search dropdown" id="usercombo">
                                             <!--Comboboxtan seçilenlere göre yukarıda scriptle çağrılan fonksiyon var ve o fonksiyon user_edit.php yi açıyor-->
                                           <option value="">Select User For Edit</option>
                                ';
                                $users = "select * from users";
                                $result2 = $conn->query($users);
                                if ($result2->num_rows > 0) {
                                while ($fill2 = $result2->fetch_assoc()) {
                                    $user_id = $fill2['ID'];
                                $user_name = $fill2['U_Name'];
                                    $user_surname = $fill2['surname'];
                                echo "<option value=$user_id>$user_name $user_surname</option>";

                                }
                                }
                                echo '
                             </select>
                         </div>
                            <div class="ui segment" style="display: none;" id="editform">       
                             
                             </div>
                  </div>   
                                
    </div>
    <script>
    $(function() {
        $("#classroom_search").on("change", function() {
      var clsrm = $("#classroom_search").val();
          $.ajax({
      type: "GET",
      url: "admin_timetable.php",
      data: ({slct_classroom:clsrm}),
      success: function(data) {
             $("#sgm_table").html(data);
            $("#sgm_table").show();
             $("#pdf_sgm").show();
             
             $(\'#csvbutton\').click(function () {
                           
         $("#sgm_table").table2excel({
                    name: "Worksheet Name",  
                    filename: "SomeFile" //do not include extension

                  });

            });
            
            $(\'#pdfbutton\').click(function () {
                 
                var table = tableToJson($(data).get(0))
                var doc = new jsPDF(\'p\',\'pt\', \'a3\', true);
                doc.cellInitialize();
                $.each(table, function (i, row){
                    console.debug(row);
                    $.each(row, function (j, cell){
                        doc.cell(30, 50,110, 50, cell, i);  // 2nd parameter=top margin,1st=left margin 3rd=row cell width 4th=Row height
                    })
                })


                doc.save(\'sample-file.pdf\');
            });
            function tableToJson(table) {
                var data = [];

                // first row needs to be headers
                var headers = [];
                for (var i=0; i<table.rows[0].cells.length; i++) {
                    headers[i] = table.rows[0].cells[i].innerHTML.toLowerCase().replace(/ /gi,\'\');
                }


                // go through cells
                for (var i=0; i<table.rows.length; i++) {

                    var tableRow = table.rows[i];
                    var rowData = {};

                    for (var j=0; j<tableRow.cells.length; j++) {

                        rowData[ headers[j] ] = tableRow.cells[j].innerHTML;

                    }

                    data.push(rowData);
                }

                return data;
            }  
      }
    }); 
    });
   
    

 });
</script>
  
     <div class="ui tab segment" data-tab="c">
          <div class="field">
              <label><b>Please Select Classroom</b></label>
                      <select class="ui search fluid dropdown" id="classroom_search">
                       <option value="">Select Classroom</option>
                      ';

                    $class33 = "select * from class ";
                    $result3 = $conn->query($class33);
                    if ($result3->num_rows > 0) {
                        while ($fill = $result3->fetch_assoc()) {
                            $class_id = $fill['class_no'];
                            $name = $fill['cls_name'];
                            echo "<option value=$class_id>$name</option>";
                        }
                    }

             echo '
                    </select>
            </div>
            <div class="ui basic segment" style="display: none;" id="sgm_table"></div>
            <div class="ui basic segment" style="display: none;" id="pdf_sgm">
            <button class="ui youtube button" id="pdfbutton">
              <i class="file pdf outline icon"></i>
              Export table to PDF
            </button>
            <button class="ui green button" id="csvbutton">
             <i class="file excel outline icon"></i>
             Export table to CSV
            </button>
            </div>
    </div>     
    </div>

  </div>

</div>
</td></tr></table>
</body>


';

    }
}
?>