<?php
include "db_connection.php";
session_start();
if(!empty($_SESSION["ID"])) {
    if ($_SESSION["user_type"] == "3") {
       $faculty_id= $_SESSION['faculty_id'];
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
     <script src="scripts/form.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
    <script src="semantic/components/tab.js"></script>
     <script src="semantic/components/tab.min.js"></script>
      <script src="semantic/components/modal.js"></script>
    <script src="scripts/transition.js"></script>


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

  

$(function(){

$("#classroom").on("change", function() {
     $("#segment_course").show();
     $("#segment_submit").hide();
      var clsrm = $("#classroom").val();
          $.ajax({
      type: "GET",
      url: "time_show.php",
      data: ({slct_classroom:clsrm}),
      success: function(data) {
             $("#segment_show_timetable").html(data);
      }
    }); 
    $("#segment_show_timetable").show();
      });
$("#course").on("change", function() {
     $("#segment_day").show();
     $("#segment_submit").hide();
      
      });
 $("#day").on("change", function() {
     $("#segment_time").show();
     $("#segment_submit").hide();
     
      });
$("#time").on("change", function() {
     $("#segment_duration").show();
     $("#segment_submit").hide();
      });
 /* $.validate({
    modules : \'html5\'
  });*/
  
$("#savecourse").click(function() { 
      var intRegex = /[0-9 -()+]+$/;   
    
      var code = $("#code").val();
      var section = $("#section").val();
      var coursename = $("#coursename").val();
       var totalduration = $("#totalduration").val();
  
if($.trim(code)!=false){
          if( intRegex.test(section)==true || section==0){
       //   window.alert(section);
        if($.trim(coursename)!=false){
           

    $.ajax({
 
      type: "POST",
      url: "course_add.php",
      data: ({coursecode:code,coursesection:section,ccoursename:coursename,duration:totalduration}),
      success: function(data) {
        
   console.log("xx");
                
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
  
});

$("#duration").on("change", function() { 
  var selectclass = $("#classroom").val();
  var selectcourse = $("#course").val();
  var selectday = $("#day").val();
   var selecttime = $("#time").val();
  var drtion = $("#duration").val();

  $.ajax({
      type: "GET",
      url: "time_check_insert.php",
      data: ({selectedclass:selectclass,selectedcourse:selectcourse,selectedday:selectday,selectedtime:selecttime,courseduration:drtion}),
      success: function(data) {
       // console.log(data);
       if(data=="1" || drtion=="" || drtion=="0"){
           $("#segment_error").show(); 
            $("#segment_submit").hide();
           }
       else {
            $("#segment_submit").show();
            $("#segment_error").hide();
         }
      }
    });  

  });
    $("#submit").on("click", function() { 
    
      var selectclass = $("#classroom").val();
       var selectcourse = $("#course").val();
         var selectday = $("#day").val();
            var selecttime = $("#time").val();
               var drtion = $("#duration").val(); 
     console.log(selectclass);
    console.log(selectcourse);
    console.log(drtion);
    console.log(selectday);
    console.log(selecttime);
      $.ajax({
      type: "POST",
      url: "time_check_insert.php",
      data: ({selectedclass2:selectclass,selectedcourse2:selectcourse,selectedday2:selectday,selectedtime2:selecttime,courseduration2:drtion}),
      success: function(data) {
       // console.log(data);
       alert(data);
       window.location.reload(true);
      }
    });
    });
});
</script>
<script>
/*$(document)
                .ready(function() {
             
                    
                         $(\'.ui.form\').form({
                          
                                inline: true,
                                on:  \'blur\',
                                fields: {
                                    code: {
                                        identifier  : \'code\',
                                        rules: [
                                            {
                                                type   : \'empty\',
                                                prompt : \'Please enter course code\'
                                            }
                                        ]
                                    },
                                     section: {
                                        identifier  : \'section\',
                                        rules: [
                                            {
                                                type   : \'empty\',
                                                prompt : \'Please enter section\'
                                            },
                                             {
                                                type   : \'integer\',
                                                prompt : \'Please enter integer number\'
                                            }
                                        ]
                                    },
                                     coursename: {
                                        identifier  : \'coursename\',
                                        rules: [
                                            {
                                                type   : \'empty\',
                                                prompt : \'Please enter coursename\'
                                            }
                                        ]
                                    },
                                      totalduration: {
                                        identifier  : \'totalduration\',
                                        rules: [
                                            {
                                                type   : \'empty\',
                                                prompt : \'Please enter totalduration\'
                                            },
                                            {
                                                type   : \'integer\',
                                                prompt : \'Please enter integer number\'
                                            }
                                        ]
                                    }
                                    
                                }

                            })
                       
                });*/
</script>
<script>
$(function () {
  $("#classroom22").on("change", function() {
       $("#segment_faculty22").show();
     $("#segment_submit2").hide();
      var clsrm22 = $("#classroom22").val();
          $.ajax({
      type: "GET",
      url: "time_show.php",
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
      url: "time_check_insert.php",
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
      url: "time_transfer.php",
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
    $.ajax({
      type: "GET",
      url: "course_add.php",
      data: ({}),
      success: function(data) {
        $("#coursetable").html(data);
      }
    });  
});

$(document).ready(function(){ 
    $(\'.menu .item\').tab();
    $(\'select.dropdown\').dropdown();    
    $(\'.ui.accordion\').accordion();
    
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
    //dropdown1
   /*    $.ajax({
      type: "GET",
      url: "faculty_take_dropdown.php",
      data: ({}),
      success: function(data) {
             $("#classroom").html(data);
        
      }
    }); */
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
    $(function() {
         $("#classroom_trnsfr").on("change", function () { 
          var classroom = $("#classroom_trnsfr").val();
           $.ajax({
              type: "POST",
              url: "transfer_takeday.php",
              data: ({selectclass:classroom}),
              success: function(data) {
               $("#trnsfr_day").show();
                $("#trnsfr_day").html(data);
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
      url: "time_show.php",
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
      url: "search_course_list.php",
      data: ({slct_coursse:course12}),
      success: function(data) {
             $("#course_list").html(data);
            $("#course_list").show();
      }
    }); 

    })
      $("#day_search").on("change", function() {
      var daysearch = $("#day_search").val();
          $.ajax({
      type: "GET",
      url: "search_day_time.php",
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
      console.log(durationnn);
      console.log(dayyy);
      console.log(timeee);
          $.ajax({
      type: "GET",
      url: "search_empty_show.php",
      data: ({src_day0:dayyy,src_duration0:durationnn,src_time0:timeee}),
      success: function(data) {
             $("#empty_show").html(data);
            $("#empty_show").show();
      }
    }); 

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
        $user = "select U_Name,surname from users where ID='$id'";
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
   <b>  ';  $class = "select F_Name from faculty where F_ID='$faculty_id'";
        $result = $conn->query($class);
        if ($result->num_rows > 0) {
            while ($fill = $result->fetch_assoc()) {
                $fname22 = $fill['F_Name'];
            }
        }
        echo "Faculty of ".$fname22;
                echo '
                </b>
    </div>
    <div class="item">
   <b> Faculty Panel</b>
    </div>
    <div class="item">
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
      <a class="active item" data-tab="a" id="dsgn_timetable">
      Add Course to Faculty Classroom
      </a>
      <a class="item" data-tab="b">
       Use Other Faculty Classrooms
      </a>
      <a class="item" data-tab="c">
        Search Classroom
      </a>
      <a class="item" data-tab="d">
        Transfer Classroom
      </a>
       <a class="item" data-tab="e">
        Show/Add/Delete Lecture
      </a>
      <a class="item" data-tab="f">
        Mailbox
      </a>
    </div>
  </div>

  </div>
  <div class="twelve wide stretched column" >
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

    <div class="ui fluid tab segment active" data-tab="a">
    <div class="ui form">
                <div class="field">
                          <label>Please Select Classroom</label>
                  <select class="ui search dropdown" id="classroom">
                  <option value="">Select Classroom</option>
                
                  ';

              $faculty_id = $_SESSION["faculty_id"];
                $class = "select * from class c,faculty f where f.F_ID=c.faculty AND c.faculty='$faculty_id'";
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
               ';
        echo'
        <div class="ui basic segment" style="display: none;" id="segment_course">
            <div class="field">
            <label>Please Select Course</label>
            <select class="ui search dropdown" id="course">
                 <option value="">Select Course</option>
          ';

        $faculty_id = $_SESSION["faculty_id"];
        $class = "select * from course where faculty='$faculty_id'";
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
            </div>
        </div>
            <div class="ui basic segment" style="display: none;" id="segment_day">
                <div class="field">
                <label>Please Select Course Day</label>
                <select class="ui search dropdown" id="day">
                 <option value="">Select Course Day</option>
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
          <div class="ui basic segment" style="display: none;" id="segment_time">
                <div class="field">
                 <label>Please Select Course Start Time</label>
                   <select class="ui search fluid dropdown" id="time">
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
          <div class="ui basic segment" style="display: none;" id="segment_duration">
              <div class="ui field">
                 <label>Please Select Course Duration</label>
                <div class="ui field">
                    <select class="ui search dropdown" id="duration">
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
          </div>

          <div class="ui basic segment" style="display: none;" id="segment_error">
                <div class="ui tertiary inverted red segment"">
                  <i class="warning icon"></i>
                  For this day your selected time is full!
                </div>
          </div>
          <div class="ui basic segment" style="display: none;" id="segment_error2">
                <div class="ui tertiary inverted red segment"">
                  <i class="warning icon"></i>
                  Please re-select Duration !
                </div>
          </div>
          <div class="ui basic segment" style="display: none;" id="segment_submit">
                <button class="ui fluid inverted blue button" id="submit">Save</button>
          </div>
    </div>
</div>
<div class="ui tab segment" data-tab="b">
<div class="ui form">
            <div class="field">
              <label>Please Select Classroom</label>
                      <select class="ui search dropdown" id="classroom_trnsfr">
                       <option value="">Select Classroom</option>
                      ';
                    $faculty_id = $_SESSION["faculty_id"];

                    $class33 = "select DISTINCT t.class_no,f.F_Name from ttable t,class c,faculty f where f.F_ID=c.faculty and t.class_no=c.class_no and t.faculty='$faculty_id' and c.faculty != '$faculty_id'";
                    $result3 = $conn->query($class33);
                    if ($result3->num_rows > 0) {
                        while ($fill = $result3->fetch_assoc()) {
                            $class_id = $fill['class_no'];
                            $name = $fill['class_no'];
                            $fac = $fill['F_Name'];
                            echo "<option value=$class_id>$name / $fac </option>";
                        }
                    }

             echo '
                    </select>
            </div>
            <div class="ui basic segment" style="display: none;" id="trnsfr_day"></div>

          
</div>
</div>
<div class="ui tab segment" data-tab="c">
        <div class="ui styled fluid accordion">
          <div class="title" style="color:rgba(5, 4, 31, 0.96)">
            <i class="dropdown icon"></i>
           Search for CLASSROOM
          </div>
          <div class="content">
             <div class="field">
              <label><b>Please Select Classroom</b></label>
                      <select class="ui search fluid dropdown" id="classroom_search">
                       <option value="">Select Classroom</option>
                      ';
                    $faculty_id = $_SESSION["faculty_id"];
                    $class = "select * from class c,faculty f where f.F_ID=c.faculty AND c.faculty='$faculty_id'";
                    $result = $conn->query($class);
                    if ($result->num_rows > 0) {
                        while ($fill = $result->fetch_assoc()) {
                            $class_id = $fill['class_no'];
                            $name = $fill['cls_name'];
                            $facult = $fill['F_Name'];
                            echo "<option value=$class_id>$name / $facult</option>";
                        }
                    }
                    $class33 = "select DISTINCT t.class_no,f.F_Name from ttable t,class c,faculty f where f.F_ID=c.faculty and t.class_no=c.class_no and t.faculty='$faculty_id' and c.faculty != '$faculty_id'";
                    $result3 = $conn->query($class33);
                    if ($result3->num_rows > 0) {
                        while ($fill = $result3->fetch_assoc()) {
                            $class_id = $fill['class_no'];
                            $name = $fill['F_Name'];
                            echo "<option value=$class_id>$class_id / $name</option>";
                        }
                    }

             echo '
                    </select>
            </div>
            <div class="ui basic segment" style="display: none;" id="sgm_class_search"></div>
          </div>
          <div class="title" style="color:rgba(5, 4, 31, 0.96)">
            <i class="dropdown icon"></i>
           Search for COURSE / Delete COURSE on Time Table
          </div>
          <div class="content">
                <div class="field">
            <label><b>Please Select Course</b></label>
            <select class="ui search fluid dropdown" id="course_search">
                 <option value="">Select Course</option>
          ';

        $faculty_id = $_SESSION["faculty_id"];
        $class = "select * from course where faculty='$faculty_id'";
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
          <div class="title" style="color:rgba(5, 4, 31, 0.96)">
            <i class="dropdown icon"></i>
           Search for DAY & TIME
          </div>
          <div class="content">
             <div class="field">
            <label><b>Please Select Day</b></label>
            <select class="ui search fluid dropdown" id="day_search">
                 <option value="">Select Day</option>
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
           <div class="title" style="color:rgba(5, 4, 31, 0.96)">
            <i class="dropdown icon"></i>
            Search for EMPTY PLACES
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
              <div class="ui basic segment" style="display: none" id="empty_show"></div>
              </div>
                  </div>

        </div>
</div>
<div class="ui tab segment" data-tab="d">
<div class="ui form">
        <div class="field">
          <label>Please Select Classroom</label>
          <select class="ui search dropdown" id="classroom22">
           <option value="">Select Classroom</option>
          ';
        $faculty_id = $_SESSION["faculty_id"];
        $class = "select * from class c,faculty f where c.faculty = f.F_ID AND c.faculty='$faculty_id'";
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

                            $scale21 = "select * from faculty where F_ID != '$faculty_id'";
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
                 <label><b>Please Select Course Duration</b></label>
                <div class="ui field">
                    <select class="ui search dropdown" id="duration22">
                      <option value="">Select Duration of Course</option>
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
<div class="ui tab segment" data-tab="e">
    <div class="ui segment" id="coursetable" ></div>
 <div class="ui segment">
    <div class="ui form">
              <div class="two fields">
                <div class="field">
                  <label>Course Code</label>
                  <input id="code" type="text">
                </div>
                <div class="field">
                  <label>Section</label>
                  <input  id="section" type="text" >
                </div>
              </div>
              <div class="two fields">
                <div class="field">
                  <label>Course Name</label>
                  <input name="coursename" id="coursename" type="text">
                </div>
                <div class="field">
                  <label>Total Duration</label>
                  <select class="ui dropdown" id="totalduration" >
                    <option value="1">1</option>
                     <option value="2">2</option>
                      <option value="3">3</option>
                       <option value="4">4</option>
                        <option value="5">5</option>
                         <option value="6">6</option>
                  </select>
                </div>
              </div>
              
              <button class="ui submit button" id="savecourse">Save Course</button>
              <div class="ui error message"></div>
    </div>
</div>

  <div class="ui horizontal divider">
    Or
  </div>
  <div class="ui segment">
  <center>
 
<label><b>Delete Course</b></label><br>
            <select class="ui search dropdown" id="coursedelete">
                 <option value="">Select Course</option>
          ';

        $faculty_id = $_SESSION["faculty_id"];
        $class = "select * from course where faculty='$faculty_id'";
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
            <div class="ui basic segment" style="display: none" id="dltt">
              <div class="ui red submit button" id="deletecrs">Delete Course</div>
            </div>
            </div>
            </center>
            <script>
    $(function() {
         $("#coursedelete").on("change", function () { 
                $("#dltt").show();
          });
                   $("#deletecrs").on("click", function () { 
                    var crsd = $("#coursedelete").val();
                     $(".ui.basic.modal").modal("show");
              $("#onaybutton").on("click", function() {
                          $.ajax({
              type: "POST",
              url: "course_delete.php",
              data: ({dltcourse:crsd}),
              success: function(data) {
              window.alert(data);
               window.location.reload(true);
              }
            });

               });
               $("#redbutton").on("click", function() {
               window.location.reload(true);
               });
           
              });
    });
</script>
         <div class="ui basic modal" >
                          <i class="close icon"></i>
                          <div class="header">
                            Delete Course
                          </div>
                          <div class="image content">
                            <div class="image">
                              <i class="trash icon"></i>
                            </div>
                            <div class="description">
                              <p>Do you want to delete selected course?</p>
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
</td></tr></table>
</body>


';
    }
}
?>