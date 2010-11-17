<html>
<head>
<title>PHPMailer - SMTP (Gmail) advanced test</title>
</head>
<body>

<?php
require_once('../class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail = new PHPMailer(true); 

$mail->IsSMTP(); 

try {
  $mail->SMTPDebug  = 2;                     
  $mail->SMTPAuth   = true;                 
  $mail->SMTPSecure = "ssl";                 
  $mail->Host       = "smtp.gmail.com";     
  $mail->Port       = 465;                   
  $mail->Username   = "yuxelo@gmail.com";  
  $mail->Password   = "14531453";
  $mail->AddAddress('yuxel@operamail.com', 'John Doe');
  $mail->SetFrom('yuxelo@gmail.com', 'First Last');
  $mail->Subject = 'Buraya konu';
  $mail->MsgHTML( "Buraya html");
  $mail->Send();
  return true;
} catch (phpmailerException $e) {
  echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  echo $e->getMessage(); //Boring error messages from anything else!
}
?>

</body>
</html>
