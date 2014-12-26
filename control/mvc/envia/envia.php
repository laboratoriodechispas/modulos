<?php

include_once "swift_required.php";

function mail3($to,$subject,$cuerpo){
//$subject = 'Identidad Atleta, PHP!';
$from = array('noreply@identidadatleta.com' =>'Identidad Atleta');
/*$to = array(
 'sergio.nava@sparklabs.com.mx'  => 'Recipient1 Name',
 'alejandro.garcia@sparklabs.com.mx' => 'Recipient2 Name'
);*/

$text = "Mandrill speaks plaintext";
$html = "$cuerpo";

$transport = Swift_SmtpTransport::newInstance('smtp.mandrillapp.com', 587);
$transport->setUsername('ia2014');
$transport->setPassword('DCOWxiBepHtLk7V03dKqjQ');
$swift = Swift_Mailer::newInstance($transport);

$message = new Swift_Message($subject); 
$message->setFrom($from);
$message->setBody($html, 'text/html');
$message->setTo($to);
$message->addPart($text, 'text/plain');

if ($recipients = $swift->send($message, $failures))
{
 echo "<font color='#00FF00'>El correo fue enviado de manera exitosa</font>";
} else {
 echo "<font color='#FF0000'>Ocurrio un problema al enviar el corre: $to\n</font>";
}
}
?>