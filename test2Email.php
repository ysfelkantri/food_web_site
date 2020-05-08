<?php

require './email/PHPMailerAutoload.php';


try {
    $mail = new PHPMailer(true);

    // Enable verbose debug output

    $mail->isSMTP();                                 // Set mailer to use SMTP
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPDebug = 0;
    // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'htmlphpcss3@gmail.com';                 // SMTP username
    $mail->Password = 'anasgmail';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom('htmlphpcss3@gmail.com', 'anas mansouri food project ');
    $mail->addAddress('rizkiyounes8991@gmail.com');     // Add a recipient

    $mail->addReplyTo('htmlphpcss3@gmail.com');
    // print_r($_FILES['file']); exit;
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = "test ";
    $mail->Body    = '<div style="border:2px solid red;">Hello world</div>';
    $mail->AltBody = "msg from GSEII";

    if ($mail->send()) {
        echo "message envoyer";
    } else {
        echo "error" . $mail->ErrorInfo;
    }
} catch (Exception $e) {
    echo "lsd";
}
// header("location: https://www.facebook.com/");
