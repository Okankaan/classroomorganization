<?php
include "db_connection.php";
if(!empty($_SESSION["ID"])) {
    if ($_SESSION["user_type"] == "2") {
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
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
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
$(function () {
  $("#classroom22").on("change", function() {
       $("#segment_faculty22").show();
     $("#segment_submit2").hide();
      var clsrm22 = $("#classroom22").val();
          $.ajax({
      type: "GET",
      url: "rectorate_show_classroom.php",
      data: ({slct_classroom:clsrm22}),
      success: function(data) {
             $("#segment_show_timetable22").html(data);
      }
    }); 
    $("#segment_show_timetable22").show();
      });
$("#faculty22").on("change", function() { 
    $("#segment_day22").show();
});
 $("#day22").on("change", function() {
     $("#segment_time22").show();
     $("#segment_submit2").hide();
     
      });
$("#time22").on("change", function() {
     $("#segment_duration22").show();
     $("#segment_submit2").hide();
      });

$("#duration22").on("change", function() { 

 var selectclass22 = $("#classroom22").val();
  var selectfaculty22 = $("#faculty22").val();
  var selectday22 = $("#day22").val();
   var selecttime22 = $("#time22").val();
  var drtion22 = $("#duration22").val();
  console.log(selectclass22);
   console.log(selectfaculty22);
   console.log(selectday22);
   console.log(selecttime22);
   console.log(drtion22);

  $.ajax({
      type: "GET",
      url: "time_check_insert2.php",
      data: ({selectedclass:selectclass22,selectedfaculty:selectfaculty22,selectedday:selectday22,selectedtime:selecttime22,courseduration:drtion22}),
      success: function(data) {
       console.log(data);
       if(data=="1" || drtion22=="" || drtion22=="0"){
                $("#segment_error21").show();
                 $("#segment_submit2").hide();
           }
       else {
            $("#segment_error21").hide();             
           $("#segment_submit2").show();
         }
      }
    });  
});
$("#submit2").on("click", function() { 
     var selectclass22 = $("#classroom22").val();
     var selectfaculty22 = $("#faculty22").val();
     var selectday22 = $("#day22").val();
     var selecttime22 = $("#time22").val();
     var drtion22 = $("#duration22").val();
    $.ajax({
      type: "POST",
      url: "time_transfer_rectorate.php",
      data: ({selectedclass:selectclass22,selectedfaculty:selectfaculty22,selectedday:selectday22,selectedtime:selecttime22,courseduration:drtion22}),
      success: function(data) {
        window.alert(data);
        window.location.reload(true);
      }
    });  
});
});
</script>
<script>
//search part
    $(function() {
        $("#classroom_search").on("change", function() {
      var clsrm = $("#classroom_search").val();
          $.ajax({
      type: "GET",
      url: "rectorate_show_classroom.php",
      data: ({slct_classroom:clsrm}),
      success: function(data) {
             $("#sgm_class_search").html(data);
            $("#sgm_class_search").show();
      }
    }); 

    });
        $("#course_search").on("change", function() {
      var course12 = $("#course_search").val();
          $.ajax({
      type: "GET",
      url: "search_course_list2.php",
      data: ({slct_coursse:course12}),
      success: function(data) {
             $("#course_list").html(data);
            $("#course_list").show();
      }
    }); 

    });
      $("#day_search").on("change", function() {
      var daysearch = $("#day_search").val();
          $.ajax({
      type: "GET",
      url: "search_day_time2.php",
      data: ({src_day:daysearch}),
      success: function(data) {
             $("#day_time_list").html(data);
            $("#day_time_list").show();
      }
    }); 

    });
    //empty4
          $("#day_src").on("change", function() {
            $("#sg_search_time").show();
      
    }); 


          $("#time_src").on("change", function() {
            $("#sg_search_dr").show();
      
    }); 

          $("#duration_src").on("change", function() {
      var durationnn = $("#duration_src").val();
      var dayyy = $("#day_src").val();
      var timeee = $("#time_src").val();
          $.ajax({
      type: "GET",
      url: "search_empty_show2.php",
      data: ({src_day0:dayyy,src_duration0:durationnn,src_time0:timeee}),
      success: function(data) {
             $("#empty_show22").html(data);
            $("#empty_show22").show();
      }
    }); 

    });
     });
</script>
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
    $(\'select.dropdown\').dropdown();
    $(\'.ui.accordion\').accordion();

              $.ajax({
              type: "GET",
              url: "faculty_show_insert.php",
              data: ({}),
              success: function(data) {
                 $("#facultylist").html(data);
              }
            });  
               $.ajax({
      type: "GET",
      url: "mail/read_mail.php",
      data: ({}),
      success: function(data) {
             $("#outmail").html(data);
        
      }
    }); 
                 $.ajax({
      type: "GET",
      url: "mail/read_mail1.php",
      data: ({}),
      success: function(data) {
             $("#inmail").html(data);
        
      }
    }); 
});
</script>
<script>
    $(function(){
          $.validate({
    modules : \'html5\'
  });
        $("#savecls").on("click", function() {
         var intRegex = /[0-9 -()+]+$/;   
        
            var clsno = $("#class_no").val();
            var clsname = $("#class_name").val();
            var clsbuilding = $("#building").val();
            var clstype = $("#type").val();
            var clscapacity = $("#capacity").val();
            var clsfaculty = $("#faculty").val();

                 if($.trim(clsno)!=false){
                    if($.trim(clsname)!=false){
                      if($.trim(clsbuilding)!=false){
                        if($.trim(clstype)!=false){
                          if($.trim(clscapacity)!=false){
                             if( intRegex.test(clscapacity)==true){
                            if($.trim(clsfaculty)!=false){
                      
          $.ajax({
              type: "POST",
              url: "classroom_show_insert.php",
              data: ({snd_clsno:clsno,snd_clsname:clsname,snd_clsbuilding:clsbuilding,snd_clstype:clstype,snd_clscapacity:clscapacity,snd_clsfaculty:clsfaculty}),
              success: function(data) {
                console.log(data);
                
               if(data=="1"){
                    window.alert("New classroom added successfully");
                    console.log("success");
                    window.location.reload(true);
                   }
                   else {
                      window.alert(data);
                      console.log("Error");
                    
                      }
              }
            });  
                           }
                        }
                      }
                    }
                    }
                    }
                    }
      });

      });
      
</script>
<script>
$(document).ready(function(){ 

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
    $(function(){
        $("#savefaculty").on("click", function() {
            var F_Name = $("#F_Name").val();
                console.log(F_Name);
                    if($.trim(F_Name)!=false){

          $.ajax({
              type: "POST",
              url: "faculty_show_insert.php",
              data: ({snd_F_Name:F_Name}),
              success: function(data) {
                console.log(data);
                
               if(data=="1"){
                    window.alert("New faculty added successfully");
                    console.log("success");
                    window.location.reload(true);
                   }
                   else {
                      window.alert(data);
                      console.log("Error");
                    
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
          <a class="item" id="addf" data-tab="e">
             Show & Add Faculty List
          </a>
          <a class="item" id="update" data-tab="b">
            Show & Update & Delete Classroom
          </a>
          <a class="item" id="search" data-tab="c">
            Search Classroom
          </a>
          <a class="item" id="show" data-tab="d">
            Show Classroom Timetable
          </a>
          <a class="item" id="show" data-tab="g">
            Transfer Classroom
          </a>
          <a class="item" id="show" data-tab="f">
            Mailbox
          </a>
          
    </div>
  </div>
 </div>
  <div class="twelve wide stretched column" >
  <div class="ui tab segment" data-tab="g">
  <div class="ui form">
        <div class="field">
          <label>Please Select Classroom</label>
          <select class="ui search dropdown" id="classroom22">
           <option value="">Select Classroom</option>
          ';
        $class = "select * from class c,faculty f where c.faculty = f.F_ID";
        $result = $conn->query($class);
        if ($result->num_rows > 0) {
            while ($fill = $result->fetch_assoc()) {
                $class_id = $fill['class_no'];
                $name = $fill['cls_name'];
                $facname = $fill['F_Name'];
                echo "<option value=$class_id>$name / $facname</option>";
            }
        }

 echo '
        </select>
        </div>
        <div class="ui compact field" >
            <div class="ui basic segment" style="display: none" id="segment_show_timetable22">
                
            </div>
        </div>
               ';
        echo'
        
          <div class="ui basic segment" style="display: none;" id="segment_faculty22">
                <div class="field">
                 <label><b>Please Select Transfered Faculty</b></label>
                    <select class="ui search fluid dropdown" id="faculty22">
                               <option value="">Select Faculty</option>
                              ';

                            $scale21 = "select * from faculty ";
                            $result = $conn->query($scale21);
                            if ($result->num_rows > 0) {
                                while ($fill = $result->fetch_assoc()) {
                                    $fidd = $fill['F_ID'];
                                    $fnamee = $fill['F_Name'];
                                    echo "<option value=$fidd>$fnamee</option>";
                                }
                            }

                     echo '
                    </select>
                </div>
          </div>
            <div class="ui basic segment" style="display: none;" id="segment_day22">
                <div class="field">
                <label><b>Please Select Transfer Day</b></label>
                <select class="ui search fluid dropdown" id="day22">
                 <option value="">Select Day</option>
                  ';

                        $sql = "select * from days ";
                        $result1 = $conn->query($sql);
                        if ($result1->num_rows > 0) {
                            while ($fill = $result1->fetch_assoc()) {
                                $day_id = $fill['day_id'];
                                $day_name = $fill['day_name'];
                                echo "<option value=$day_id>$day_name</option>";
                            }
                        }
                echo '
                </select>
                </div>
            </div>
          <div class="ui basic segment" style="display: none;" id="segment_time22">
                <div class="field">
                 <label><b>Please Select Start Transfer Time</b></label>
                    <select class="ui search fluid dropdown" id="time22">
                               <option value="">Select Time</option>
                              ';
                            $scale = "select * from time_scale ";
                            $result = $conn->query($scale);
                            if ($result->num_rows > 0) {
                                while ($fill = $result->fetch_assoc()) {
                                    $section = $fill['time_section'];
                                    $duration_time = $fill['ts_duration'];
                                    echo "<option value=$section>$duration_time</option>";
                                }
                            }

                     echo '
                    </select>
                </div>
          </div>
          <div class="ui basic segment" style="display: none;" id="segment_duration22">
              <div class="ui field">
                 <label><b>Please Select Duration</b></label>
                <div class="ui field">
                    <select class="ui search dropdown" id="duration22">
                      <option value="">Select Duration</option>
                        <option value="1">1</option>
                         <option value="2">2</option>
                          <option value="3">3</option>
                           <option value="4">4</option>
                            <option value="5">5</option>
                             <option value="6">6</option>
                              <option value="7">7</option>
                         <option value="8">8</option>
                          <option value="9">9</option>
                           <option value="10">10</option>
                            <option value="11">11</option>
                             <option value="12">12</option>
                    </select>
                </div>
              </div>
          </div>
         
          <div class="ui basic segment" style="display: none;" id="segment_error21">
                <div class="ui tertiary inverted red segment"">
                  <i class="warning icon"></i>
                  For this day your selected time is full!
                </div>
          </div>
          <div class="ui basic segment" style="display: none;" id="segment_error22">
                <div class="ui tertiary inverted red segment"">
                  <i class="warning icon"></i>
                  Please re-select Duration !
                </div>
          </div>
          <div class="ui basic segment" style="display: none;" id="segment_submit2">
                <button class="ui fluid inverted blue button" id="submit2">Transfer to Faculty</button>
          </div>
</div>
</div>
    <div class="ui fluid tab segment" data-tab="f">
          <div class="ui fluid accordion">
                  <div class="title">
                   
                   <h4 class="ui horizontal divider header">
                    <i class="inbox icon"></i>
                     INBOX
                    </h4>
                     <i class="dropdown icon"></i>
                  </div>
                  <div class="content">
                    <div class="ui basic segment" id="inmail"></div>
                  </div>
                  <div class="title">
                   
                    <h4 class="ui horizontal divider header">
                    <i class="external icon"></i>
                    OUTBOX
                    </h4>
                     <i class="dropdown icon"></i>
                  </div>
                  <div class="content">
                  <div class="ui basic segment" id="outmail"></div>
                  </div>
          </div>
</div>
        <div class="ui tab segment" data-tab="e">
        <div class="ui segment" id="facultylist">
        <form id="addfc" class="ui form">
        </div>
             <div class="ui input">
             <div class="two fields">
             
                     
             </div>
             &nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
             <div class="ui input">
                         <div class="field">
                          <label><b>Faculty Name</b></label>
                          <br><input placeholder="Faculty Name" id="F_Name" type="text" data-validation="required">
                          </div>
             </div>
             </div>
             
                  <br><br><div class="ui teal button" type="submit" id="savefaculty"> Save Faculty</div>
                  </form>
        </div>
        <div class="ui tab segment active" data-tab="a">
                   <div class="ui form">
                      <div class="two fields">
                        <div class="field">
                          <label>Classroom No</label>
                          <input placeholder="Classroom Number" id="class_no" type="text" data-validation="required">
                        </div>
                        <div class="field">
                          <label>Classroom Name</label>
                          <input placeholder="Classroom Name" id="class_name" type="text" data-validation="required">
                        </div>
                        <div class="field">
                          <label>Building</label>
                          <select class="ui search dropdown" id="building" data-validation="required">
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
                          <select class="ui dropdown" id="type" data-validation="required">
                            <option value="class">Classroom</option>
                            <option value="lab">Labratory</option>
                          </select>
                        </div>
                        <div class="field">
                          <label>Capacity</label>
                          <input type="text" id="capacity" data-validation="number">
                        </div>
                      </div>
                      <div class="field">
                        <label>Faculty</label>
                          <select class="ui search dropdown" id="faculty" data-validation="required">
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
                      <div class="ui teal button" type="submit" id="savecls"> Save Classroom</div>
                      
                      
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
          <div class="ui styled fluid accordion">
          <div class="title" style="color:black">
            <i class="dropdown icon"></i>
            Class Based Search
          </div>
          <div class="content">
               <div class="field">
              <label><b>Please Select Classroom</b></label>
                      <select class="ui search fluid dropdown" id="classroom_search">
                       <option value="">Select Classroom</option>
                      ';
                    $class = "select * from class c,faculty f where f.F_ID=c.faculty";
                    $result = $conn->query($class);
                    if ($result->num_rows > 0) {
                        while ($fill = $result->fetch_assoc()) {
                            $class_id = $fill['class_no'];
                            $name = $fill['cls_name'];
                            $facult = $fill['F_Name'];
                            echo "<option value=$class_id>$name / $facult</option>";
                        }
                    }

             echo '
                    </select>
               </div>
            <div class="ui basic segment" style="display: none;" id="sgm_class_search"></div>
          </div>
          <div class="title" style="color:black">
            <i class="dropdown icon"></i>
           Course Based Search
          </div>
          <div class="content">
                <div class="field">
            <label><b>Please Select Course</b></label>
            <select class="ui search fluid dropdown" id="course_search">
                 <option value="">Select Course</option>
          ';

        $class = "select * from course ";
        $result = $conn->query($class);
        if ($result->num_rows > 0) {
            while ($fill = $result->fetch_assoc()) {
                $course_id = $fill['code_section'];
                $course_name = $fill['name'];
                echo "<option value=$course_id>$course_id - $course_name</option>";
            }
        }
echo '
            </select>
            <div class="ui basic segment" style="display: none" id="course_list"></div>
            </div>
          </div>
          <div class="title" style="color:black">
            <i class="dropdown icon"></i>
            Time Based Search
          </div>
          <div class="content">
             <div class="field">
            <label><b>Please Select Day</b></label>
            <select class="ui search fluid dropdown" id="day_search">
                 <option value="">Select Course</option>
          ';
                    $ddays = "select * from days";
                    $result334 = $conn->query($ddays);
                    if ($result334->num_rows > 0) {
                        while ($fill = $result334->fetch_assoc()) {
                            $day_id = $fill['day_id'];
                            $day_name = $fill['day_name'];
                            echo "<option value=$day_id>$day_name</option>";
                        }
                    }
            echo '
            </select>
            <div class="ui basic segment" style="display: none" id="day_time_list"></div>
          </div>
          </div>
           <div class="title" style="color:black">
            <i class="dropdown icon"></i>
            Search Empty Places
          </div>
          <div class="content">
                 <div class="field">
                <label><b>Please Select Searched Day</b></label>
                <select class="ui search fluid dropdown" id="day_src">
                 <option value="">Select Searched Day</option>
                      ';

                            $sql = "select * from days ";
                            $result1 = $conn->query($sql);
                            if ($result1->num_rows > 0) {
                                while ($fill = $result1->fetch_assoc()) {
                                    $day_id = $fill['day_id'];
                                    $day_name = $fill['day_name'];
                                    echo "<option value=$day_id>$day_name</option>";
                                }
                            }
                    echo '
                </select>
                </div>
                <div class="ui basic segment" >
                  <div class="field" style="display: none" id="sg_search_time">
                 <label><b>Please Select Searched Time</b> </label>
                   <select class="ui search fluid dropdown" id="time_src">
                               <option value="">Select Searched Time</option>
                              ';
                            $scale = "select * from time_scale ";
                            $result = $conn->query($scale);
                            if ($result->num_rows > 0) {
                                while ($fill = $result->fetch_assoc()) {
                                    $section = $fill['time_section'];
                                    $duration_time = $fill['ts_duration'];
                                    echo "<option value=$section>$duration_time</option>";
                                }
                            }

                     echo '
                    </select>
                    </div>  
                </div>
                 <div class="ui basic segment">
                  <div class="ui field" style="display: none" id="sg_search_dr">
                 <label><b>Please Select Duration</b></label>
                <div class="ui field">
                    <select class="ui fluid search dropdown" id="duration_src">
                       <option value="">Select Duration of Course</option>
                        <option value="1">1</option>
                          <option value="2">2</option>
                            <option value="3">3</option>
                              <option value="4">4</option>
                                <option value="5">5</option>
                                  <option value="6">6</option>
                    </select>
                </div>
              </div>
              <div class="ui basic segment" style="display: none" id="empty_show22"></div>
              </div>
                  </div>

        
        </div>
        </div>
        <div class="ui tab segment " data-tab="d">
             <div class="ui form">
         <div class="field">
              <label><b>Please Select Classroom</b></label>
                      <select class="ui search fluid dropdown" id="classroom">
                       <option value="">Select Classroom</option>
                      ';
                    $class = "select * from class c,faculty f where f.F_ID=c.faculty";
                    $result = $conn->query($class);
                    if ($result->num_rows > 0) {
                        while ($fill = $result->fetch_assoc()) {
                            $class_id = $fill['class_no'];
                            $name = $fill['cls_name'];
                            $facult = $fill['F_Name'];
                            echo "<option value=$class_id>$name / $facult</option>";
                        }
                    }

             echo '
                    </select>
               </div>
        <div class="ui compact field" >
            <div class="ui basic segment" style="display: none" id="segment_show_timetable">
                
            </div>
        </div>
        
        </div>
        
  </div>
  </div>
</body>

';
    }
}