<?php

//Include phpmailer files that is connected to the vendor
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';

//name space defining
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

////Load Composer's autoloader
require 'vendor/autoload.php';

//create a new email
$mail = new PHPMailer(true);

//Email components within the email + sending to the email of the user
try {
    $mail->isSMTP();                                                // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                           // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                       // Enable SMTP authentication
    $mail->Username   = 'rainbowteam11@gmail.com';                    // SMTP username
    $mail->Password   = 'fbycquwldbddnvot';                           // SMTP password
    $mail->SMTPSecure = 'tls';             // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                         // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('example@example.com', 'Company Name');
    $mail->addAddress('raisamahesvaraniadilova@gmail.com', 'Raisa.M.N');       // Add a recipient
    $mail->addReplyTo('info@example.com', 'Information');

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = '<b>Thank you for creating our account on our website! You have now full access to your account and to login!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();

} catch (Exception $e) {
    echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Login user</title>
</head>
    <body>
        <h1>Congrats!</h1>
        <h2>You now have an account registered in the database!</h2>
        <a href="/login.php">Now you can log into your account here!</a>
    </body>
</html>
