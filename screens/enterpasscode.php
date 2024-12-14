<?php
include("../system/config.php");
session_start();

$uid = $_SESSION["uid"];
$emailLabel = "";

// if (!isset($_SESSION["uid"])) {
//     header("Location: http://localhost/badyetko/screens/forgotpassword.php");
//     exit();
// }

if (isset($_POST["confirm-code"])) {

    $passcodeEntered = $_POST["passcode"];

    $s = "select * from user where user_id = $uid";
    $user = $conn->query($s);

    if ($user->num_rows > 0) {
        $u = $user->fetch_assoc();

        if ($u["passcode"] == $passcodeEntered) {
            header("Location: http://localhost/badyetko/screens/resetpassword.php");
        }
    } else {
        $emailLabel = "Incorrect passcode";
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
        <h3>Enter passcode sent to your email</h3>
        <input type="text" name="passcode" required>
        <div class="btns">
            <a href="http://localhost/badyetko/screens/loginpage.php?">Cancel</a>
            <input type="submit" value="Confirm" name="confirm-code">
        </div>
        <div class="email-stat"><?php echo $emailLabel; ?></div>
    </form>
</body>

</html>