<?php 
header('Access-Control-Allow-Origin: *');

require 'mail/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'jon.reinagel@gmail.com';                 // SMTP username
$mail->Password = 'IwtkC&tfoHs';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom('jon.reinagel@gmail.com', 'Mailer');
$mail->addAddress('jon@equipmoz.org', 'Jon Reinagel');     // Add a recipient
$mail->addAddress('nordino@equipmoz.org', 'Nordino Armando');               // Name is optional

$mail->isHTML(false);                                  // Set email format to HTML
$name = $_REQUEST['name'];
$organization = $_REQUEST['organization'];

if(isset($_REQUEST['teaching'])) {
    $subject = "Fonte da Vida Copyright Submission";
    $message = $name . ", email: " . $_REQUEST['email'] . " from the organization " . $organization . " had a copyright concern about the following teaching:" . "\n\n" . $_REQUEST['teaching'] . "\n Details: " . $_REQUEST['issue'];
} else {
    $subject = "Fonte da Vida Partnership Submission";
    $message = $name . ", email: " . $_REQUEST['email'] . " from the organization " . $organization . " has a partnership request. They may be contacted at the following phone number: " . $_REQUEST['phone'] . "\n\n Languages: " . $_REQUEST['languages'] . "\n Details: " . $_REQUEST['details'];
    }

$mail->Subject = $subject;
$mail->Body    = $message;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}