<?php
    
    require 'libs/PHPMailer/PHPMailerAutoload.php';

        $voornaam = $_POST['voornaam'];
        $achternaam = $_POST['achternaam'];
        $naam = $voornaam . ' ' . $achternaam; 
        $email = $_POST['email'];
        $telefoonnummer = $_POST['telefoonnummer']; 
        $straat = $_POST['straat']; 
        $nummer = $_POST['nummer'];  
        $bus = $_POST['bus'];
        $postcode = $_POST['postcode'];
        $stad = $_POST['stad'];
        $adres = $straat . ' ' . $nummer . $bus . ', ' . $postcode . ' ' . $stad; 
        $opmerkingen = $_POST['opmerkingen'];
        $materiaal = $_POST['materiaal'];
        $kleur = $_POST['kleur'];
        $onderwerp = "Nieuwe prijsaanvraag";

        $body = file_get_contents('3d-printingprijsaanvraag-e-mailtemplate.html');
        $body = str_replace('%naam%', $naam, $body); 
        $body = str_replace('%email%', $email, $body);
        $body = str_replace('%telefoonnummer%', $telefoonnummer, $body);
        $body = str_replace('%adres%', $adres, $body);
        $body = str_replace('%materiaal%', $materiaal, $body);
        $body = str_replace('%kleur%', $kleur, $body);
        $body = str_replace('%opmerkingen%', $opmerkingen, $body);

        $mail = new PHPMailer;
        $mail->isSMTP();                            // Zorgt dat SMTP gebruikt
        $mail->Host = 'smtp.mailgun.org';           // Specifieert de SMTP server
        $mail->SMTPAuth = true;                     // Activeert de SMTP-aanmelding
        $mail->Username = 'username hier';          // SMTP-e-mailadres
        $mail->Password = 'password hier'           // SMTP-wachtwoord
        $mail->SMTPSecure = 'tls';                  // Activeert TLS-encryptie
        $mail->IsHTML(true);                            
        $mail->From = 'zender@gmail.com';
        $mail->FromName = 'Klantendienst';
        $mail->addAddress('ontvanger1@gmail.com');
        $mail->addAddress('ontvanger2@gmail.com');
        $mail->Subject = $onderwerp;
        $mail->Body    = $body;

        if (isset($_FILES['bestand']) &&
            $_FILES['bestand']['error'] == UPLOAD_ERR_OK) {
            $mail->AddAttachment($_FILES['bestand']['tmp_name'],
                                 $_FILES['bestand']['name']);
        }

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
?>
