<?php
/**
 * Created by PhpStorm.
 * User: SULEYMAN
 * Date: 10.11.2016
 * Time: 19:01
 */

include 'class.phpmailer.php';
include 'class.smtp.php';
include 'connection.php';

$sql = "select * from users where name='Suleyman'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug = 0; // hata ayiklama: 1 = hata ve mesaj, 2 = sadece mesaj
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl'; // Güvenli baglanti icin ssl normal baglanti icin tls
$mail->Host = "ashe.ilgihosting.com"; // Mail sunucusuna ismi
$mail->Port = 465; // Gucenli baglanti icin 465 Normal baglanti icin 587
$mail->IsHTML(true);
$mail->SetLanguage("tr", "phpmailer/language");
$mail->CharSet  ="utf-8";
$mail->Username = "suleymanezer@n00ne.xyz"; // Mail adresimizin kullanicı adi
$mail->Password = "kptn46120"; // Mail adresimizin sifresi
$mail->SetFrom("suleymanezer@n00ne.xyz", "Suleyman EZER"); // Mail attigimizda gorulecek ismimiz


$mail->AddAddress($row["e_mail"]); // Maili gonderecegimiz kisi yani alici
$mail->Subject = "Deneme Mail'i"; // Konu basligi





$mail->Body = "Staff Id : " . $row["ID"]. " Name: " . $row["name"]. " " . $row["surname"] . "<br>"; // Mailin icerigi
if(!$mail->Send()){
    echo "Mailer Error: ".$mail->ErrorInfo;
} else {
    echo "Mail Sended";
}
?>