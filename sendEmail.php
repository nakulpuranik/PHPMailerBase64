<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
require_once('PHPMailer.php');
require_once('SMTP.php');


$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {

    $base64 = file_get_contents('sample64.txt');            //base64 file content
    $resource = base64_decode($base64);                     //base64 decode 
    

    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = '<samtpHostName>';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = '<SMTP USERNAM>';                 // SMTP username
    $mail->Password = '<SMTP Password>';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('xxxx@xxxxx.com', 'info');       //sender Email
    $mail->addAddress('xxx@xxxxx.com', 'Dev');     // Add a recipient email

    
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->addStringAttachment($resource, "fileName.jpg", "base64", "image/jpg");           //add attachment

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
