<?php
require_once "vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
function SendMail($Toemail,$subject,$message)
{

$mail = new PHPMailer(true);

//Enable SMTP debugging.
$mail->SMTPDebug = false;                               
//Set PHPMailer to use SMTP.
$mail->isSMTP();            
//Set SMTP host name                          
$mail->Host = "smtp.gmail.com";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;                          
//Provide username and password     
$mail->Username = "testuser1447@gmail.com";                 
$mail->Password = "tgwogmrilitmfprz";                           
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "tls";                           
//Set TCP port to connect to
$mail->Port = 587;                                   

$mail->From = "testuser1447@gmail.com";
$mail->FromName = "Test User";

$mail->addAddress($Toemail, "Test");

$mail->isHTML(true);

$mail->Subject = $subject;
$mail->Body = "<i>".$message."</i>";
$mail->AltBody = $message;

try {
   $email =  $mail->send();
   if($email)
   {
    return array('code'=>"1","message"=>"Email Send Successfully");
    exit;
   }
   
} catch (Exception $e) {
    return array('code'=>"0","message"=>"Mailer Error: " . $mail->ErrorInfo);
    
}
}

?>