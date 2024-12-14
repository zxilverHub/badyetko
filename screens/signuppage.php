<?php
include("../system/config.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<?php

$isEmailTaken = false;
$accemail = "";

function isValidEmail($email)
{
    $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    return preg_match($pattern, $email);
}

function isValidPassword($pass)
{
    return strlen($pass) > 7;
}

// if cta sign up button clicked
if (isset($_POST['signup-button'])) {
    $inputedEmail = $_POST['email'];
    $password = $_POST["password"];
    $cPassword = $_POST["confirm-password"];

    // check if valid email and password
    if (isValidEmail($inputedEmail) && isValidPassword($password) && $password == $cPassword) {

        $s = "select email from account where email = '$inputedEmail'";
        $emailresult = $conn->query($s);

        if ($emailresult->num_rows > 0) {
            $isEmailTaken = true;
            $accemail = $inputedEmail;
        } else {
            $s = "insert into user (user_id, last_online) values (NULL, now())";
            if ($conn->query($s)) {
                $s = "select LAST_INSERT_ID() as newUserId";
                $newuserid = $conn->query($s)->fetch_assoc()['newUserId'];

                $hashpassword = md5($password);
                // insert new account
                $s =
                    "
                insert into account (account_id, username, email, password, user_id) values
                (NULL, 'user$newuserid', '$inputedEmail', '$hashpassword', $newuserid);
                ";

                if ($conn->query($s)) {
                    $_SESSION["userid"] = $newuserid;
                    header("Location: http://localhost/badyetko/screens/home.php?");
                }
            }
        }
    }
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BadyetKo Sign up</title>
    <link rel="icon" href="../assets/Logo.png" type="image/icon">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/registration.css">
</head>

<body>
    <?php
    require_once '../vendor/autoload.php';

    // init configuration
    $clientID = '1015891508153-92j3ji4oo4ipk6ibefr8u1f5di04tehc.apps.googleusercontent.com';
    $clientSecret = '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';
    $redirectUri = 'http://localhost/badyetko/screens/signuppage.php';

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
        $username = $google_account_info->given_name;

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

        header("Location: http://localhost/badyetko/screens/home.php?");
        exit();

    ?>
    <?php
        // now you can use this profile info to create account in your website and make user logged in.
    } else { ?>

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

                <form action="" method="POST">
                    <div class="email">
                        <label for="email">
                            Email
                            <span id="email-error">Please enter valid email</span>
                        </label>
                        <input type="email" placeholder="example@badyetko.org" name="email" id="email">
                        <?php echo $isEmailTaken ? "<div class='email-taken'>$accemail is not available!</div>" : "" ?>
                    </div>
                    <div class="password">
                        <label for="password">
                            Password
                            <span id="password-error">Invalid password</span>
                        </label>
                        <div class="password-input">
                            <input type="password" placeholder="Must be 8 or more characters" name="password" id="password" onfocus="onPassFocus()" onblur="onPassBlur()">
                            <button id="show-password" onclick="showPassword(event)">Show</button>
                        </div>
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

                    <div class="password">
                        <label for="password">
                            Confirm password
                            <span id="confirm-password-error">Password don't match</span>
                        </label>
                        <div class="password-input2">
                            <input type="password" placeholder="Confirm password" name="confirm-password" id="confirm-password" class="confirm-password" onfocus="onPassFocus2()" onblur="onPassBlur2()">
                            <button id="show-password2" onclick="showPassword2(event)">Show</button>
                        </div>
                    </div>

                    <script>
                        function onPassFocus2(e) {
                            event.preventDefault();
                            document.querySelector('.password-input2').classList.add('active-pass');
                        }

                        function onPassBlur2() {
                            event.preventDefault();
                            document.querySelector('.password-input2').classList.remove('active-pass');
                        }

                        function showPassword2(e) {
                            event.preventDefault();
                            let isShown = e.target.innerText;
                            const inputPass = document.querySelector('#confirm-password');
                            if (isShown.toLowerCase() == 'show') {
                                inputPass.type = "text";
                                e.target.innerText = "Hide"
                            } else {
                                inputPass.type = "password";
                                e.target.innerText = "Show"
                            }
                        }
                    </script>


                    <div class="registration-cta">
                        <input type="submit" value="Sign up" name="signup-button" id="signup-button">
                        <div class="resitration-option">
                            <p>Already have an account?</p>
                            <a href="./loginpage.php">Log in here</a>
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
            <script src="../scripts/formregistrationvalidation.js"></script>
        </section>
    <?php } ?>
</body>

</html>