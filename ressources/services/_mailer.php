<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//L'autoload s'occupera de require automatiquement les classes demandées.
require __DIR__."/../../../phpmailer/vendor/autoload.php";

/**
 * Envoi un mail
 *
 * @param string $from
 * @param string $to
 * @param string $subject
 * @param string $body
 * @return string
 */
function sendMail(string $from, string $to, string $subject, string $body):string{
    $mail = new PHPMailer(true);
    try
    {
        /* 
            On active l'utilisation de SMTP
            (simple mail transfer Protocol)
        */
        $mail->issMTP();
        //On indique notre serveur de mail:
        $mail->Host="sandbox.smtp.mailtrap.io";
        //on active l'authentification par SMTP:
        $mail->SMTPAuth = true;
        //On indique le port du serveur de mail.
        $mail->Port=2525;
        //On indique les informations d'authification à notre serveur mail:
        $mail->Username="a0937716150894";
        $mail->Password="8fb41c01de120a";
        /* 
            PErmet d'avoir de nombreux détails sur le déroulement de l'envoi de mail:
            $mail->SMTPDebug = SMTP::DEBUG_SERVER  
        */
        /* 
            Quel type de chiffrement sera utilisé pour envoyer les mails.
            (ici je ne l'active pas car il peut poser probleme avec le serveur de mail que j'ai choisi)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS
        */

            //Paramètre de l'expediteur du mail
            $mail->setFrom($from);
            //Paramètre du destinataire
            $mail->addAddress($to);
            //Active le format HTML pour le mail
            $mail->isHTML(true);
            //Le sujet du mail
            $mail->Subject=$subject;
            //Le corp du mail:
            $mail->Body=$body;

            /* 
                On peut ajouter un "AltBody" dans le cas où le client de l'utilisateur ne gère pas le HTML
            */

            $mail->send();
            return"Message envoyé";

    }catch(Exception $e)
    {
        return "Le message n'a pas pu être envoyé.
        Mail Error:{$mail->ErrorInfo}";
    }
}
?>