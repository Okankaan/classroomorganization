<?php
include "db_connection.php";
session_start();
if(!empty($_SESSION["ID"])) {
    if ($_SESSION["user_type"] == "3") {
        $dday=$_POST["selectday"];
        $_SESSION['selectedday']=$dday;
        $sessionday=$_SESSION['selectedday'];
        $sessionclass=$_SESSION['selectedclass'];
        $faculty_id = $_SESSION["faculty_id"];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $arr= array(
                1 => " ", 2 => " ", 3 => " ", 4 => " ", 5 => " ", 6 => " ",
                7 => " ", 8 => " ", 9 => " ", 10 => " ", 11 => " ", 12 => " ",
            );
            $arr2= array(
                1 => "9:00-10:00", 2 => "10:00-11:00", 3 => "11:00-12:00",
                4 => "12:00-13:00", 5 => "13:00-14:00", 6 => "14:00-15:00",
                7 => "15:00-16:00", 8 => "16:00-17:00", 9 => "17:00-18:00",
                10 => "18:00-19:00", 11 => "19:00-20:00", 12 => "20:00-21:00",
            );
            $arr3= array(
                1 => " ", 2 => " ", 3 => " ", 4 => " ", 5 => " ", 6 => " ",
                7 => " ", 8 => " ", 9 => " ", 10 => " ", 11 => " ", 12 => " ",
            );

                echo '
  <script>
            /*    $(function() {
                     $("#course_add").on("change", function () { 
                      var time = $("time_trnsfr").val();
                       $.ajax({
                          type: "POST",
                          url: "transfer_takeduration.php",
                          data: ({selecttime:time}),
                          success: function(data) {
                           $("#sg_duration22").show();
                           $("#sg_duration22").html(data);
                          }
                        });  
                      });
                });*/
            </script>
                      <script>
                $(function() {
                     $("#time_trnsfr").on("change", function () { 
                           $("#sg_course").show();
                            $("#sg_submit22").hide();
                            $("#sg_dration22").hide();
                      });

                     $("#course_add").on("change", function () { 
                      var timert = $("#time_trnsfr").val();
                       var crs = $("#course_add").val();
                       $("#sg_submit22").hide();
                       console.log(timert);
                       $.ajax({
                          type: "POST",
                          url: "transfer_takeduration.php",
                          data: ({selecttime221:timert}),
                          success: function(data) {
                          
                           $("#duration22").html(data);
                          }
                        });  
                        if(crs!="")
                          $("#sg_dration22").show();
                          

                      });
                     $("#duration22").on("change", function () { 
                          $("#sg_submit22").show();

                        });  
                      });
                       $("#submit22").on("click", function () { 
                       var dration = $("#duration22").val();
                         var course = $("#course_add").val();
                          var time = $("#time_trnsfr").val();
                           $.ajax({
                          type: "GET",
                          url: "transfer_submit.php",
                          data: ({selectdration:dration,addcourse:course,tata:time}),
                          success: function(data) {
                         if(data=="error1"){
                              $("#segment_error22").show();
                            }
                         else 
                             window.alert("course successfully added to selected hours.");
                               window.location.reload(true);
                          }
                        });  
                      });
                 
    ';      $a="select F_Name from faculty where F_ID='$faculty_id'";
            $result4 = $conn->query($a);
            while ($fill = $result4->fetch_assoc()) {
                $facn = $fill['F_Name'];
            }

            $day33 = "select DISTINCT ts.time_section,t.duration,t.time from ttable t,class c,time_scale ts where 
                    t.class_no=c.class_no and t.faculty='$faculty_id' and c.faculty != '$faculty_id' and
                     t.time = ts.time_section and t.class_no='$sessionclass' and t.day='$dday' and t.course='$facn'";
            $result3 = $conn->query($day33);
            if ($result3->num_rows > 0) {
                while ($fill = $result3->fetch_assoc()) {
                    $section = $fill['time_section'];
                    $duration = $fill['duration'];
                    $time = $fill['time'];
                    $result2 = ($time + $duration);
                    $x=0;
                    for ($i = $time; $i < $result2; $i++) {
                        $arr[$i]=$section+$x;
                        $arr3[$i]=$section;
                        $x++;
                    }

                }
            }

            echo '
            </script>
                  <div class="field">
                  <label>Please Select Time</label>
                          <select class="ui search dropdown" id="time_trnsfr">
                           <option value="">Select Time</option>
             ';                     for($i=1;$i<13;$i++)
                                if($arr[$i]!=" ")
                          echo "<option value=".$i.">".$arr2[$arr[$i]]."</option>";
                     echo '
                         </select>
                </div>
                <div class="ui basic segment"    style="display: none" id="sg_course">
                  <div class="field">
                  <label>Please Select course</label>
                          <select class="ui search dropdown" id="course_add">
                           <option value="">Select course</option>
            ';

                        $day33 = "select * from course WHERE faculty='$faculty_id'";
                        $result3 = $conn->query($day33);
                        if ($result3->num_rows > 0) {
                            while ($fill = $result3->fetch_assoc()) {
                                $course = $fill['name'];
                                $course_id = $fill['code_section'];
                                echo "<option value=$course_id>$course_id - $course</option>";
                            }
                        }

                 echo '
                         </select>
                </div>
               </div>  
                <div class="ui basic segment" style="display: none" id="sg_dration22">
                          <label><b>Please Enter using duration</b></label>
                       <div class="ui field" >
                         <select class="ui fluid search dropdown" id="duration22">
                                    
                         </select>
                       </div>
                </div>
               <div class="ui basic segment" style="display: none;" id="segment_error22">
                <div class="ui tertiary inverted red segment"">
                  <i class="warning icon"></i>
                  You do not have enough duration!
                </div>
          </div>
      
                        <div class="ui basic segment" style="display: none" id="sg_submit22">
                      <button class="ui inverted fluid blue button" id="submit22">Save Course</button>
                </div>

               
                ';
        }

    }
}