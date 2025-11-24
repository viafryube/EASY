<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    $mail = new PHPMailer(true);

    try {

        // SMTP configuration (Mailtrap)
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '124289faf4dfde';
        $mail->Password = 'abdec70072f114';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        // From harus email dummy, bukan email user
        $mail->setFrom('no-reply@example.com', 'Website Contact');

        // === PENTING ===
        // GANTI dengan email Mailtrap kamu di tab "Email → Sandbox Email Address"
        $mail->addAddress('e3d138bc43-f4a262+user1@inbox.mailtrap.io');

        // Email content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = "
            <b>Name:</b> $name<br>
            <b>Email:</b> $email<br><br>
            <b>Message:</b><br>$message
        ";

        $mail->send();
        echo "OK";

    } catch (Exception $e) {
        http_response_code(500);
        echo "Mailer Error: {$mail->ErrorInfo}";
    }

} else {
    http_response_code(403);
    echo "Unauthorized request.";
}
?>
