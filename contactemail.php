<?php
    require 'libs/PHPMailer/PHPMailerAutoload.php';
    $naam = $_POST['naam']; 
    $email = $_POST['email']; 
    $onderwerp = $_POST['onderwerp']; 
    $bericht = $_POST['bericht']; 
    $telefoonnummer = $_POST['telefoonnummer'];
    $body = file_get_contents('contact-e-mailtemplate.html');
    $body = str_replace('%Naam%', $naam, $body); 
    $body = str_replace('%E-mailadres%', $email, $body);
    $body = str_replace('%Onderwerp%', $onderwerp, $body); 
    $body = str_replace('%Bericht%', $bericht, $body);
    $mail = new PHPMailer;
    $mail->isSMTP();                              // Zorgt dat SMTP gebruikt
    $mail->Debugoutput = 'html';
    $mail->Host = 'smtp.mailgun.org';             // Specifieert de SMTP server
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;                       // Activeert de SMTP-aanmelding
    $mail->Username = 'username hier';            // SMTP-e-mailadres
    $mail->Password = 'password hier';            // SMTP-wachtwoord
    $mail->IsHTML(true);                            

    $mail->From = 'zender@gmail.com';
    $mail->FromName = 'Klantendienst';
    $mail->addAddress('ontvanger1@gmail.com');                 // Ontvanger(s)
    $mail->addAddress('ontvanger2@gmail.com');                            
    $mail->Subject = $onderwerp;
    $mail->Body    = $body;
    if(!$mail->send()) {
	echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
?>

