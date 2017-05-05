<?php
include "db_connection.php";
session_start();
if(!empty($_SESSION["ID"])) {
    if ($_SESSION["user_type"] == "3") {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $classroom=$_POST["selectclass"];
            $_SESSION['selectedclass']=$classroom;

            echo '
             <script>
                $(function() {
                     $("#day_trnsfr").on("change", function () { 
                      var day = $("#day_trnsfr").val();
                       $.ajax({
                          type: "POST",
                          url: "transfer_taketime.php",
                          data: ({selectday:day}),
                          success: function(data) {
                           $("#t_time").show();
                           $("#t_time").html(data);
                          }
                        });  
                      });
                });
            </script>
            <div class="field">
                  <label>Please Select Day</label>
                          <select class="ui search dropdown" id="day_trnsfr">
                           <option value="">Select Day</option>
            ';
                        $faculty_id = $_SESSION["faculty_id"];
                        $class33 = "select DISTINCT d.day_name,d.day_id from ttable t,class c,days d where 
                    t.class_no=c.class_no and t.faculty='$faculty_id' and c.faculty != '$faculty_id' and
                     t.day = d.day_id and t.class_no='$classroom'";
                        $result3 = $conn->query($class33);
                        if ($result3->num_rows > 0) {
                            while ($fill = $result3->fetch_assoc()) {
                                $day = $fill['day_name'];
                                $day_id = $fill['day_id'];
                                echo "<option value=$day_id>$day</option>";
                            }
                        }

                 echo '
                        </select>
            </div>
                <div class="ui basic segment" style="display: none" id="t_time"></div>
                ';
        }
    }
}
?>