<?php
include "db_connection.php";
if(1) {
    if (1) {
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


    <style type="text/css">
        body {
            background-color: rgba(5, 4, 31, 0.96);
        }
        body > .grid {
            height: 100%;
        }
    </style>
<script>
$(function() {
  $("#editcombo").on("change", function() {
         var comboedit = $("#editcombo").val();
          $.ajax({
              type: "GET",
              url: "classroom_edit.php" ,      
                data: ({snd_editcombo:comboedit}),
              success: function(data) {
                $("#editclass").html(data); 
              }
            });  
     $("#editclass").show();
      });
$("#classroom").on("change", function() {
     $("#segment_course").show();
     $("#segment_submit").hide();
      var clsrm = $("#classroom").val();
          $.ajax({
      type: "GET",
      url: "rectorate_show_classroom.php",
      data: ({slct_classroom:clsrm}),
      success: function(data) {
             $("#segment_show_timetable").html(data);
      }
    }); 
    $("#segment_show_timetable").show();
      });
});           
</script>
<script>
$(document)
                .ready(function() {
                    $(\'.ui.form\').form({
                                inline: true,
                                on:  \'blur\',
                                fields: {
                                    class_no: {
                                        identifier  : \'class_no\',
                                        rules: [
                                            {
                                                type   : \'empty\',
                                                prompt : \'Please enter classroom number\'
                                            }
                                        ]
                                    },
                                     type: {
                                        identifier  : \'type\',
                                        rules: [
                                            {
                                                type   : \'empty\',
                                                prompt : \'Please select classroom type\'
                                            }
                                        ]
                                    },
                                     type: {
                                        identifier  : \'class_name\',
                                        rules: [
                                            {
                                                type   : \'empty\',
                                                prompt : \'Please enter classroom name\'
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
                                    },
                                     capacity: {
                                        identifier  : \'capacity\',
                                        rules: [
                                            {
                                                type   : \'empty\',
                                                prompt : \'Please enter capacity\'
                                                
                                            },
                                            {
                                                type   : \'integer\',
                                                prompt : \'Please enter just number\'
                                            }
                                        ]
                                    },
                                    building: {
                                        identifier  : \'building\',
                                        rules: [
                                            {
                                                type   : \'empty\',
                                                prompt : \'Please select building\'
                                            }

                                        ]
                                    }
                                }

                            })

                });

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
    $(\'select.dropdown\').dropdown();  
});
</script>
<script>
    $(function(){
        $("#savecls").on("click", function() {
            var clsno = $("#class_no").val();
            var clsname = $("#class_name").val();
            var clsbuilding = $("#building").val();
            var clstype = $("#type").val();
            var clscapacity = $("#capacity").val();
            var clsfaculty = $("#faculty").val();
                 console.log(clsno);
                console.log(clsname);
                 console.log(clsbuilding);
                 console.log(clstype);
                  console.log(clscapacity);
                  console.log(clsfaculty);
          $.ajax({
              type: "POST",
              url: "classroom_show_insert.php",
              data: ({snd_clsno:clsno,snd_clsname:clsname,snd_clsbuilding:clsbuilding,snd_clstype:clstype,snd_clscapacity:clscapacity,snd_clsfaculty:clsfaculty}),
              success: function(data) {
                console.log(data);
                
               if(data=="1"){
                    window.alert("New record added successfully");
                    console.log("success");
                    window.location.reload(true);
                   }
                   else {
                      window.alert(data);
                      console.log("Error");
                    
                      }
              }
            });  
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
   <div class="right menu">
    <div class="item">
   <b> Rectorate Panel</b>
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
          <a class="active item" id="add" data-tab="a">
             Add Classroom
          </a>
          <a class="item" id="restore" data-tab="b">
            Update & Delete Classroom
          </a>
          <a class="item" id="change" data-tab="c">
            Change Faculty Classroom
          </a>
          <a class="item" id="show" data-tab="d">
            Show Classrooms
          </a>
    </div>
  </div>
 </div>
  <div class="twelve wide stretched column" >
        <div class="ui tab segment active" data-tab="a">
                   <div class="ui form">
                      <div class="two fields">
                        <div class="field">
                          <label>Classroom No</label>
                          <input placeholder="Classroom Number" id="class_no" type="text">
                        </div>
                        <div class="field">
                          <label>Classroom Name</label>
                          <input placeholder="Classroom Name" id="class_name" type="text">
                        </div>
                        <div class="field">
                          <label>Building</label>
                          <select class="ui search dropdown" id="building">
                          <option value="">Select Building</option>"
                    ';
                            $building = "select * from building";
                            $result = $conn->query($building);
                            if ($result->num_rows > 0) {
                                while ($fill = $result->fetch_assoc()) {
                                    $id = $fill['S_Name'];
                                    $name = $fill['B_Name'];
                                    echo "<option value=$id>$name</option>";
                                }
                            }
                            echo '
                          </select>
                        </div>
                      </div>
                      <div class="two fields">
                        <div class="field">
                        <label>Classroom Type</label>
                          <select class="ui dropdown" id="type">
                            <option value="class">Classroom</option>
                            <option value="lab">Labratory</option>
                          </select>
                        </div>
                        <div class="field">
                          <label>Capacity</label>
                          <input type="text" id="capacity">
                        </div>
                      </div>
                      <div class="field">
                        <label>Faculty</label>
                          <select class="ui search dropdown" id="faculty">
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
                      <div class="ui teal button" type="submit" id="savecls"> Save</div>
                      <div class="ui error message"></div>
                    </div>
        </div>
        <div class="ui tab segment"  data-tab="b">
        ';
        $sql = "SELECT * FROM class c,faculty f,building b 
          where c.faculty=f.F_ID AND c.location=b.S_Name
          ORDER BY f.F_ID";
        $result=$conn->query($sql);
        if ($result->num_rows > 0) {
            echo '
            <table class="ui compact celled table" >
                <thead>
                    <th>Faculty Name</th>
                    <th>Building Code</th>
                    <th>Building Name</th>
                    <th>Classroom No</th>
                    <th>Classroom Name</th>
                    <th>Capacity</th>
                    <th>Type</th>
                </thead>
                <tbody>
                    ';
                    while($fill = $result->fetch_assoc()) {
                        $fname = $fill['F_Name'];
                        $bsname = $fill['S_Name'];
                        $bname = $fill['B_Name'];
                        $bcclassno = $fill['class_no'];
                        $cname = $fill['cls_name'];
                        $ccapacity = $fill['capacity'];
                        $ctype = $fill['type'];

                        echo "
                     <tr>
                        <td>$fname</td>
                        <td>$bsname</td>
                        <td>$bname</td>
                        <td>$bcclassno</td>
                        <td>$cname</td>
                        <td>$ccapacity</td>
                        <td>$ctype</td>

                    </tr>
                    ";
                    }
                echo '
                </tbody>
            </table>
            ';
        }
 echo '
                          <select class="ui search dropdown" id="editcombo">
                          <option value="">Select Classroom</option>"
                    ';
                            $classcombo = "select * from class";
                            $result3 = $conn->query($classcombo);
                            if ($result3->num_rows > 0) {
                                while ($fill = $result3->fetch_assoc()) {
                                    $id3 = $fill['class_no'];
                                    $name3 = $fill['cls_name'];
                                    echo "<option value=$id3>$name3</option>";
                                }
                            }
                            echo '
                          </select>
        <div class="ui segment" style="display: none;" id="editclass">       
             
        </div>
        </div>
        <div class="ui tab segment " data-tab="c">
          3
        </div>
        <div class="ui tab segment " data-tab="d">
             <div class="ui form">
        <div class="field">
          <label>Please Select Classroom</label>
          <select class="ui search dropdown" id="classroom">
           <option value="">Select Classroom</option>
                   
          ';

        $class = "select * from class";
        $result = $conn->query($class);
        if ($result->num_rows > 0) {
            while ($fill = $result->fetch_assoc()) {
                $class_id = $fill['class_no'];
                $name = $fill['cls_name'];
                echo "<option value=$class_id>$name</option>";
            }
        }

 echo '
        
        </select>
        </div>
        <div class="ui compact field" >
            <div class="ui basic segment" style="display: none" id="segment_show_timetable">
                
            </div>
            <div class="ui teal button" type="submits" id="savecls" name="printRectorate"> Save</div>
        </div>
        </div>
  </div>
  </div>
</body>

';
    }
}