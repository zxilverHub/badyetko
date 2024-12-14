<?php
include("../system/config.php");
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Include PHPMailer (Composer)

$mail = new PHPMailer(true); // Create a new PHPMailer instance
$emailLabel = "";
if (isset($_POST["send-code"])) {
    $newPasscode = substr(uniqid(), -5);
    $uemail = $_POST["email"];

    $s = "select * from account where email = '$uemail'";
    $acc = $conn->query($s);

    if ($acc->num_rows > 0) {

        try {
            // SMTP Configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'badyetko@gmail.com'; // Your email
            $mail->Password = 'smpl ajdb gaxh rtxd'; // Your email password or app password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Encryption type
            $mail->Port = 587; // SMTP port

            // Email Settings
            $mail->setFrom('badyetko@gmail.com', 'Badyet Ko'); // Sender's email
            $mail->addAddress($uemail); // Recipient's email
            $mail->Subject = 'Password Reset Code';
            $mail->Body = "Your password reset code is: $newPasscode";

            // Send the email
            $mail->send();
            echo 'Message sent successfully!';

            $accuid = $acc->fetch_assoc()["user_id"];

            $s = "update user set passcode = '$newPasscode' where user_id = $accuid";
            if ($conn->query($s) == TRUE) {
                $_SESSION["uid"] = $accuid;
                header("Location: http://localhost/badyetko/screens/enterpasscode.php");
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $emailLabel = "Email not found";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>BadyetKo</title>

    <link rel="icon" href="../assets/Logo.png" type="image/icon type">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/forgotpassword.css">
</head>

<body>
    <form action="" method="POST">
        <img src="../assets/Logo.png" alt="">
        <h1>Please enter your email</h1>
        <input type="email" name="email" required>
        <div class="btns">
            <a href="http://localhost/badyetko/screens/loginpage.php?">Cancel</a>
            <input type="submit" value="Send verification code" name="send-code">
        </div>
        <div class="email-stat"><?php echo $emailLabel; ?></div>
    </form>
</body>

</html>