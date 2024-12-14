<?php

$logstatus = "";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BadyetKo Admin</title>
    <link rel="stylesheet" href="./admin.css">
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../system/jquery.js"></script>
    <script>
        function login() {
            event.preventDefault();
            let email = $("#email").val();
            let password = $("#password").val();

            if (email == "admin@badyetko.com" && password == "admin@badyetko") {
                window.location.href = "http://localhost/badyetko/admin/adminsession.php";
            } else {
                $("#logstatus").html("Incorrect email or password");
            }
        }
    </script>
</head>

<body>
    <form>
        <h1>BadyeKo Admin </h1>
        <input type="email" placeholder="Email" name="email" id="email">
        <input type="password" name="password" id="password" placeholder="Password">
        <?php echo $logstatus ?>
        <div id="logstatus"></div>
        <button onclick="login()">Log in</button>
    </form>
</body>

</html>