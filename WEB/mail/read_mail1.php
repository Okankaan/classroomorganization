<?php
//INBOX

include "connection.php";
session_start();

$imap = imap_open("{ashe.ilgihosting.com:995/pop3/ssl/novalidate-cert}", "nnexyz@ashe.ilgihosting.com", "t6q1d1B0Yu");
$id=$_SESSION['ID'];

$sql = "SELECT * FROM users WHERE ID = '$id'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$email = $row["e_mail"];

if( $imap ) {

    //Check no.of.msgs
    $num = imap_num_msg($imap);
 //   echo $num;

    echo' <div class="ui styled fluid accordion">';
    if ($num > 0) {
        //read that mail recently arrived
        for ($i = $num; $i >= 1; $i--) {
            $z = imap_headerinfo($imap, $i);
            $x = $z->toaddress;

            if ($x == $email)
            {

                echo '  <div class="title" style="text-align: justify; text-align-last:justify">
            <i class="dropdown icon"></i>
            
             '. "From : " . $z->fromaddress. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ."Subject : " .$z->subject. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ."Date : " . $z->Date. '';
                echo'</div>'; //takesubject
                echo '<div class="content">';
                echo "From     :" . $z->fromaddress . "<br>";
                echo "To       :" . $z->toaddress . "<br>";
                echo "Date     :" . $z->Date."<br>" ;
                echo imap_qprint(imap_body($imap, $i));
                echo '</div>';
            }
        }
    }
    else
        echo 'There is no mail.';
    echo '</div>';
}

    imap_close($imap);

?>