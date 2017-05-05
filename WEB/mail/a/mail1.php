<?php
/**
 * Created by PhpStorm.
 * User: SULEYMAN
 * Date: 10.11.2016
 * Time: 19:01
 */

include 'class.phpmailer.php';
include 'class.smtp.php';



$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug = 2; // hata ayiklama: 1 = hata ve mesaj, 2 = sadece mesaj
$mail->SMTPAuth = false;
//$mail->SMTPSecure = 'ssl'; // Güvenli baglanti icin ssl normal baglanti icin tls

$mail->Host = "localhost"; // Mail sunucusuna ismi
$mail->Port = 25; // Gucenli baglanti icin 465 Normal baglanti icin 587
$mail->SetLanguage("tr", "phpmailer/language");
$mail->CharSet  ="utf-8";
$mail->Username = "murat_aya94@hotmail.com"; // Mail adresimizin kullanicı adi
//$mail->Password = "kptn46120"; // Mail adresimizin sifresi
$mail->SetFrom("murat_aya94@hotmail.com", "Murat"); // Mail attigimizda gorulecek ismimiz


$mail->AddAddress("suleyman.ezer@std.gau.edu.tr"); // Maili gonderecegimiz kisi yani alici
$mail->Subject = "Deneme"; // Konu basligi





$mail->Body = "kjabsndasd "; // Mailin icerigi
if(!$mail->Send()){
    echo "Mailer Error: ".$mail->ErrorInfo;
} else {
    echo "Mail Sended";
}
?>