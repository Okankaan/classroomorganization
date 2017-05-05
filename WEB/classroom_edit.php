<?php
include "db_connection.php";
session_start();
if(!empty($_SESSION["ID"])) {
    if ($_SESSION["user_type"] == "2") {
        $classcombo=$_GET["snd_editcombo"];
        $_SESSION["comboclass"]=$classcombo;
        $temp=$_SESSION["comboclass"];
        $selectquery = "SELECT * FROM class c,faculty f,building b 
          where c.faculty=f.F_ID AND c.location=b.S_Name AND c.class_no='$temp'
          ORDER BY f.F_ID";
        $exe1 = $conn->query($selectquery);
        if ($exe1->num_rows > 0) {
            while ($row = $exe1->fetch_assoc()) {
                $fid = $row['F_ID'];
                $fname = $row['F_Name'];
                $bsname = $row['S_Name'];
                $bname = $row['B_Name'];
                $cname = $row['cls_name'];
                $ccapacity = $row['capacity'];
                $ctype = $row['type'];
            }
        }
    echo '

        <script>
        

            $(function() {
            
  $("#building2").prop("disabled", true);
  $("#editcls2").on("click", function() {
  
   var intRegex = /[0-9 -()+]+$/;   
            var clsname = $("#class_name2").val();
            var clsbuilding = $("#building2").val();
            var clstype = $("#type2").val();
            var clscapacity = $("#capacity2").val();
            var clsfaculty = $("#faculty2").val();
            
                    if($.trim(clsname)!=false){
                      if($.trim(clsbuilding)!=false){
                        if($.trim(clstype)!=false){
                          if($.trim(clscapacity)!=false){
                             if( intRegex.test(clscapacity)==true){
                            if($.trim(clsfaculty)!=false){
          $.ajax({
              type: "GET",
              url: "classroom_update_drop.php" ,      
              data: ({snd_clsname:clsname,snd_clsbuilding:clsbuilding,snd_clstype:clstype,snd_clscapacity:clscapacity,snd_clsfaculty:clsfaculty}),
              success: function(data) {
              window.alert(data);
                window.location.reload(true);
              }
          });
          }}}}}}
      });
   $("#deletecls2").on("click", function() {
                 var clsname = $("#class_name2").val();
            var clsbuilding = $("#building2").val();
            var clstype = $("#type2").val();
            var clscapacity = $("#capacity2").val();
            var clsfaculty = $("#faculty2").val();
             $(".ui.basic.modal").modal("show");
              $("#onaybutton").on("click", function() {
                              $.ajax({
                              type: "POST",
                              url: "classroom_update_drop.php" ,      
                              data: ({snd_clsname:clsname,snd_clsbuilding:clsbuilding,snd_clstype:clstype,snd_clscapacity:clscapacity,snd_clsfaculty:clsfaculty}),
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
        <body>
        <div class="ui form">
                      <div class="two fields">
                        <div class="field">
                          <label>Classroom Name</label>
                          <input placeholder="Classroom Name" id="class_name2" value='.$cname.' type="text">
                        </div>
                        <div class="field">
                          <label>Building</label>
                          <select class="ui dropdown" id="building2">
                          <option value='.$bsname.'>'.$bname.'</option>"
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
                          <select class="ui dropdown" id="type2">
                            <option value='.$ctype.'>'.$ctype.'</option>
                            <option value="class">Classroom</option>
                            <option value="lab">Labratory</option>
                          </select>
                        </div>
                        <div class="field">
                          <label>Capacity</label>
                          <input type="text" value='.$ccapacity.' id="capacity2">
                        </div>
                      </div>
                      <div class="field">
                        <label>Faculty</label>
                          <select class="ui dropdown" id="faculty2">
                            <option value='.$fid.'>'.$fname.'</option>
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
                      <div class="ui teal button" type="submit" id="editcls2">Update Class</div>
                       <div class="ui red button" type="submit" id="deletecls2">Delete Class</div>
                      <div class="ui error message"></div>
                      <div class="ui basic modal" >
                          <i class="close icon"></i>
                          <div class="header">
                            Delete Classroom
                          </div>
                          <div class="image content">
                            <div class="image">
                              <i class="trash icon"></i>
                            </div>
                            <div class="description">
                              <p>Do you want to delete selected classroom?</p>
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
                    </body>
                    ';
    }
}