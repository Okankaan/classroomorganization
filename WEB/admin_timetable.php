<?php
include "db_connection.php";
session_start();
if(!empty($_SESSION["ID"])) {
    if ($_SESSION["user_type"] == "1") {

        $classroom=$_GET['slct_classroom'];
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $selectquery = "select * from ttable where
      class_no='$classroom'";
            $exe1 = $conn->query($selectquery);
            $mon = array(
                1 => " ", 2 => " ", 3 => " ", 4 => " ", 5 => " ", 6 => " ",
                7 => " ", 8 => " ", 9 => " ", 10 => " ", 11 => " ", 12 => " ",
            );
            $tue = array(
                1 => " ", 2 => " ", 3 => " ", 4 => " ", 5 => " ", 6 => " ",
                7 => " ", 8 => " ", 9 => " ", 10 => " ", 11 => " ", 12 => " ",
            );
            $wed = array(
                1 => " ", 2 => " ", 3 => " ", 4 => " ", 5 => " ", 6 => " ",
                7 => " ", 8 => " ", 9 => " ", 10 => " ", 11 => " ", 12 => " ",
            );
            $thu = array(
                1 => " ", 2 => " ", 3 => " ", 4 => " ", 5 => " ", 6 => " ",
                7 => " ", 8 => " ", 9 => " ", 10 => " ", 11 => " ", 12 => " ",
            );
            $fri = array(
                1 => " ", 2 => " ", 3 => " ", 4 => " ", 5 => " ", 6 => " ",
                7 => " ", 8 => " ", 9 => " ", 10 => " ", 11 => " ", 12 => " ",
            );
            $sat = array(
                1 => " ", 2 => " ", 3 => " ", 4 => " ", 5 => " ", 6 => " ",
                7 => " ", 8 => " ", 9 => " ", 10 => " ", 11 => " ", 12 => " ",
            );
            if ($exe1->num_rows > 0) {

                while ($row = $exe1->fetch_assoc()) {

                    $ttime = $row['time'];
                    $dduration = $row['duration'];
                    $course = $row['course'];
                    $day = $row['day'];
                    $result = ($ttime + $dduration);
                    for ($i = $ttime; $i < $result; $i++) {
                        if ($day == 'mon')
                            $mon[$i] = $course;
                        elseif ($day == 'tue')
                            $tue[$i] = $course;
                        elseif ($day == 'wed')
                            $wed[$i] = $course;
                        elseif ($day == 'thu')
                            $thu[$i] = $course;
                        elseif ($day == 'fri')
                            $fri[$i] = $course;
                        elseif ($day == 'sat')
                            $sat[$i] = $course;
                    }
                }
            }


            echo '
           


            <table class="ui compact celled definition table">
            <thead>

            <tr>
            <th>'.$classroom.'</th>
                <th>MONDAY</th>
                  <th>TUESDAY</th>
                    <th>WEDNESDAY</th>
                      <th>THURSDAY</th>
                        <th>FRIDAY</th>
                          <th>SATURDAY</th>
            </tr>
            </thead>
            <tbody>
              
               '; for ($i = 1; $i < 13; $i++){
                echo '
                <tr>
                ';
                if($i==1)
                    echo '<td>9:00-10:00</td>';
                if($i==2)
                    echo '<td>10:00-11:00</td>';
                if($i==3)
                    echo '<td>11:00-12:00</td>';
                if($i==4)
                    echo '<td>12:00-13:00</td>';
                if($i==5)
                    echo '<td>13:00-14:00</td>';
                if($i==6)
                    echo '<td>14:00-15:00</td>';
                if($i==7)
                    echo '<td>15:00-16:00</td>';
                if($i==8)
                    echo '<td>16:00-17:00</td>';
                if($i==9)
                    echo '<td>17:00-18:00</td>';
                if($i==10)
                    echo '<td>18:00-19:00</td>';
                if($i==11)
                    echo '<td>19:00-20:00</td>';
                if($i==12)
                    echo '<td>20:00-21:00</td>';
                echo '

                <td>'.$mon[$i].'</td>
                <td>'.$tue[$i].'</td>
                <td>'.$wed[$i].'</td>
                <td>'.$thu[$i].'</td>
                <td>'.$fri[$i].'</td>
                <td>'.$sat[$i].'</td>
                </tr>';
            }
            echo '
            </tbody> 
             </table>
                ';

        }

    }
}