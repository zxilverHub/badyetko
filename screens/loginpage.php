<?php
include("../system/config.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<?php

$isNotFoundEmail = false;
$accemail = "";

$isIncorrectPassword = false;

function isValidEmail($email)
{
    $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    return preg_match($pattern, $email);
}

// Normal log in
if (isset($_POST["login-button"])) {
    $inputedEmail = $_POST['email'];
    $password = $_POST['password'];

    if (isValidEmail($inputedEmail)) {
        $s = "select email, password from account where email = '$inputedEmail'";
        $accresult = $conn->query($s);

        if ($accresult->num_rows > 0) {
            $accrow = $accresult->fetch_assoc();
            $userpassword = $accrow['password'];
            $useremail = $accrow['email'];

            $hashpassword = md5($password);
            if ($hashpassword == $userpassword) {
                $s = "select user.user_id from user
                join account on account.user_id = user.user_id 
                where account.email = '$inputedEmail' and account.password = '$hashpassword'";
                $userid = $conn->query($s)->fetch_assoc()['user_id'];

                $_SESSION["userid"] = $userid;

                $s = "update user set last_online = now() where user_id = $userid";
                $conn->query($s);

                header("Location: http://localhost/badyetko/screens/home.php?");
            } else {
                $isIncorrectPassword = true;
            }
        } else {
            $isNotFoundEmail = true;
            $accemail = $inputedEmail;
        }
    }
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BadyetKo log in</title>
    <link rel="icon" href="../assets/Logo.png" type="image/icon type">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/registration.css">
</head>

<body>

    <?php
    require_once '../vendor/autoload.php';

    $clientID = '1015891508153-92j3ji4oo4ipk6ibefr8u1f5di04tehc.apps.googleusercontent.com';
    $clientSecret = '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';
    $redirectUri = 'http://localhost/badyetko/screens/loginpage.php';

    // create Client Request to access Google API
    $client = new Google_Client();
    $client->setClientId($clientID);
    $client->setClientSecret($clientSecret);
    $client->setRedirectUri($redirectUri);
    $client->addScope("email");
    $client->addScope("profile");

    // authenticate code from Google OAuth Flow
    if (isset($_GET['code'])) {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token['access_token']);

        // get profile info
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        $email =  $google_account_info->email;
        $name =  $google_account_info->name;
        $img = $google_account_info->picture;

        $userGoogleId = $google_account_info->id;
        $fname = $google_account_info->given_name;

        // log in via google
        $s = "select google_id, user_id from user where google_id = '$userGoogleId'";
        $googleidresult = $conn->query($s);

        if ($googleidresult->num_rows > 0) {
            $_SESSION["userid"] = $googleidresult->fetch_assoc()["user_id"];
        } else {
            $s = "insert into user (user_id, google_id, last_online) values (NULL, '$userGoogleId', now())";
            $conn->query($s);

            $s = "select LAST_INSERT_ID() as newUserID";
            $newGoogleUserId = $conn->query($s)->fetch_assoc()['newUserID'];


            $s = "INSERT INTO account (account_id, username, email, user_id, google_id) VALUES 
            (NULL, '$username', '$email', $newGoogleUserId, '$userGoogleId');";
            $conn->query($s);

            $_SESSION["userid"] = $newGoogleUserId;
        }

        echo $_SESSION["userid"];
        header("Location: http://localhost/badyetko/screens/home.php?");
        exit();
    } else {
    ?>

        <section class="form-in-section">
            <a href="../index.php" class="back-page">
                <img src="../assets/landingpage/icons/close.png" alt="">
            </a>
            <div class="forms">
                <div class="logo">
                    <img src="../assets/Logo.png" alt="">
                    <img src="../assets/BadyetKo.png" alt="">
                </div>

                <div class="welcome">
                    <h1>Welcome</h1>
                    <p class="slogan">Budgeting Made Easy for Students!</p>
                </div>

                <form action="" method="POST" id="log-in-form">
                    <div class="email">
                        <label for="email">
                            Email
                            <span id="email-error">Please enter valid email</span>
                        </label>
                        <input type="email" placeholder="example@badyetko.org" name="email" id="email">
                        <?php echo $isNotFoundEmail ? "<div class='email-not-found'>$accemail is not found!</div>" : "" ?>
                    </div>
                    <div class="password">
                        <label for="password">
                            Password
                        </label>
                        <div class="password-input">
                            <input type="password" placeholder="Password" name="password" id="password" onfocus="onPassFocus()" onblur="onPassBlur()">
                            <button id="show-password" onclick="showPassword(event)">Show</button>
                        </div>
                        <?php echo $isIncorrectPassword ? "<div class='incorrect-password'>Incorrect Password</div>" : "" ?>
                    </div>

                    <script>
                        function onPassFocus(e) {
                            event.preventDefault();
                            document.querySelector('.password-input').classList.add('active-pass');
                        }

                        function onPassBlur() {
                            event.preventDefault();
                            document.querySelector('.password-input').classList.remove('active-pass');
                        }

                        function showPassword(e) {
                            event.preventDefault();
                            let isShown = e.target.innerText;
                            const inputPass = document.querySelector('#password');
                            if (isShown.toLowerCase() == 'show') {
                                inputPass.type = "text";
                                e.target.innerText = "Hide"
                            } else {
                                inputPass.type = "password";
                                e.target.innerText = "Show"
                            }
                        }
                    </script>

                    <a href="http://localhost/badyetko/screens/forgotpassword.php?" id="forgot-password">Forgot password</a>

                    <div class="registration-cta">
                        <input type="submit" value="Log in" name="login-button" id="login-button">
                        <div class="resitration-option">
                            <p>Don't have account yet?</p>
                            <a href="./signuppage.php">Sign up here </a>
                        </div>
                    </div>
                    <div class="third-party-account">
                        <a href="<?php echo $client->createAuthUrl(); ?>">
                            <img src="../assets/landingpage/icons/google.png" alt="">
                            Google
                        </a>
                        <a href="">
                            <img src="../assets/landingpage/icons/colored-facebook.png" alt="">
                            Facebook
                        </a>
                    </div>
                </form>
            </div>
            <div class="illustration">
                <img src="../assets/student.jpg" alt="Illustration">
            </div>
        </section>

        <script src="../scripts/formregistrationvalidation.js"></script>
    <?php } ?>
</body>

</html>