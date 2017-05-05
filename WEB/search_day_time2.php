<?php
include "db_connection.php";
session_start();
if(!empty($_SESSION["ID"])) {
    if ($_SESSION["user_type"] == "2") {
        echo '
            <script>
             $(function() {
                 $("#time34").on("change", function () { 
                  var tmt = $("#time34").val();
                  console.log(tmt);
                   $.ajax({
                      type: "POST",
                      url: "search_dt_show2.php",
                      data: ({slc_time:tmt}),
                      success: function(data) {
                      
                       $("#lst").show();
                       $("#lst").html(data);
                      }
                    }); 
                  });
             });
            </script>
        ';

        $day = $_GET['src_day'];
        $_SESSION['select_dy']=$day;
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
        $scale = "select * from time_scale,ttable WHERE
                                      time_section=time AND day='$day'";
        $result = $conn->query($scale);
        if ($result->num_rows > 0) {
            while ($fill = $result->fetch_assoc()) {
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


        echo ' <div class="field">
                 <label><b>Please Select Time Scale</b></label>
                   <select class="ui search fluid dropdown" id="time34">
                               <option value="">Select Time</option>
        ';                     for($i=1;$i<13;$i++)
            if($arr[$i]!=" ")
                echo "<option value=$arr3[$i]>".$arr2[$arr[$i]]."</option>";
        echo '
                   </select>
             </div>
             <div class="ui basic segment" style="display: none" id="lst"></div>
     ';

    }
}

?>