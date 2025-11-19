<?php
include('../config.php');

require PHP."phpmailer/class.phpmailer.php";
require PHP."phpmailer/class.smtp.php";


$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;

$mail->Port 	= 587;
$mail->Host 	= "mail.cuidamecuida.com.br";
$mail->Username = "envio@cuidamecuida.com.br";
$mail->Password = "cuida102030@";
$mail->SetFrom("envio@cuidamecuida.com.br", EMPRESA);
$mail->AddReplyTo("willian@quax.com.br", EMPRESA);


// $mail->SMTPSecure = 'ssl'; // tls
$mail->SMTPDebug = 2;

$mail->AddAddress("willian@quax.com.br");

$mail->IsHTML(true);
$mail->CharSet = 'utf-8';
$mail->Subject = "TESTE";

$mail->Body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Newsletter Carpintaria</title>
<style type="text/css">
body {
  margin-left: 0px;
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 0px;
}

img{display: block; float: left;}
</style>
</head>
<body>
CORPO DO EMAIL DE TESTE
</body>
</html>';

$mail->Send();

echo "enviado";