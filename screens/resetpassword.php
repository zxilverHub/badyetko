<?php
include("../system/config.php");
session_start();

$uid = $_SESSION["uid"];
$emailLabel = "";

if (!isset($_SESSION["uid"])) {
    header("Location: http://localhost/badyetko/screens/forgotpassword.php");
    exit();
}

if (isset($_POST["confirm-pass"])) {
    $newpass = $_POST["new-password"];

    if (strlen($newpass) >= 8) {
        $hashpass = md5($newpass);
        $s = "update account set password = '$hashpass' where user_id = $uid";
        $conn->query($s);
        header("Location: http://localhost/badyetko/screens/loginpage.php");

        exit();
    } else {
        $emailLabel = "Must be 8 or more characters";
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
        <h3>Enter your new password</h3>
        <input type="password" name="new-password" required>
        <div class="btns">
            <a href="http://localhost/badyetko/screens/loginpage.php?">Cancel</a>
            <input type="submit" value="Confirm" name="confirm-pass">
        </div>
        <div class="email-stat"><?php echo $emailLabel; ?></div>
    </form>
</body>

</html>