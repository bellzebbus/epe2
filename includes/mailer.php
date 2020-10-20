<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if (isset($_POST["submit"])) {
    
    $nombre = $_POST["name"];
    $email = $_POST["email"];
    $cuerpo = $_POST["cuerpo"];

    $mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 1;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.sendgrid.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'mrdigitalau';                     // SMTP username
    $mail->Password   = '&!P@Pz`5=a+X^8:B';                               // SMTP password
    $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom($email, $nombre);
    $mail->addAddress('xlro.vergara@gmail.com', 'Sebastian');     // Add a recipient
    


    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'FeedBack';
    $mail->Body    = $cuerpo;

    $mail->send();
    header("location: ../contacto.php?success=Mailenviado!");
    exit();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
    
}else{
    header("location: ../registrarse.php");
}

