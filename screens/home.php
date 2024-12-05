<?php
include("../system/config.php");
session_start();
date_default_timezone_set('Asia/Manila');

if (!isset($_SESSION["userid"])) {
    header("Location: http://localhost/badyetko/screens/signuppage.php?");
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
    <link rel="stylesheet" href="../styles/home.css">
    <link rel="stylesheet" href="../styles/mealplan.css">
    <link rel="stylesheet" href="../styles/history.css">
    <link rel="stylesheet" href="../styles/historcontent.css">


    <script src="../system/jquery.js"></script>
</head>

<body>
    <header>
        <?php
        $id = isset($_SESSION["userid"]) ?? "";

        if (isset($_SESSION["userid"])) {
            $id = $_SESSION["userid"];
        }

        if (isset($_POST["submit-spend"])) {
            $expensestype = $_POST["expense-type"];
            $expenseamount = $_POST["spend-amount"];
            $dateNow = date("F j, Y");
            $timeNow = date("g:ia");

            $s = "select schedule_id, amount, balance from schedule where user_id = $id and isDone = 0";
            $scresult = $conn->query($s)->fetch_assoc();
            $thisScheduleId = $scresult["schedule_id"];
            $balance = $scresult["balance"];

            $s =
                "
                insert into expenses values
                (null, '$expensestype', $expenseamount, 0, '$dateNow', '$timeNow', $thisScheduleId);
                ";

            $conn->query($s);

            $newBalance = $balance - $expenseamount;

            $s =
                "
            update schedule
            set balance = $newBalance
            where schedule_id = $thisScheduleId;
            ";

            $conn->query($s);

            // header("Location: http://localhost/badyetko/screens/home.php");
        }

        ?>
        <div class="account-bar">
            <div class="profile">
                <img src="../assets/Logo.png" alt="">
                <img src="../assets/BadyetKo.png" alt="">
            </div>

            <div class="account-bar-cta">
                <a href="http://localhost/badyetko/screens/addschedule.php" class="add-schedule-cta">
                    <img src="../assets/icons/add.png" alt="">
                    <span>Add schedule</span>
                </a>


            </div>
        </div>

    </header>

    <main>
        <nav class="menu">
            <ul>
                <li>
                    <button id="nav-home" href="#" class="active nav-btn">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 10H7C7.55 10 8 9.55 8 9V1C8 0.45 7.55 0 7 0H1C0.45 0 0 0.45 0 1V9C0 9.55 0.45 10 1 10ZM1 18H7C7.55 18 8 17.55 8 17V13C8 12.45 7.55 12 7 12H1C0.45 12 0 12.45 0 13V17C0 17.55 0.45 18 1 18ZM11 18H17C17.55 18 18 17.55 18 17V9C18 8.45 17.55 8 17 8H11C10.45 8 10 8.45 10 9V17C10 17.55 10.45 18 11 18ZM10 1V5C10 5.55 10.45 6 11 6H17C17.55 6 18 5.55 18 5V1C18 0.45 17.55 0 17 0H11C10.45 0 10 0.45 10 1Z" fill="#1E0342" />
                        </svg>

                        <span>Home</span>
                    </button>
                </li>

                <li>
                    <button class="nav-btn" id="nav-meal">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.50414 10.81C5.52214 10.825 8.38914 7.961 8.38914 7.929C8.38914 7.897 3.34214 2.855 2.08014 1.622C1.61814 1.172 1.21814 0.802 1.19514 0.802C1.11243 0.846996 1.03964 0.908218 0.98114 0.982C0.641867 1.35765 0.385625 1.80062 0.22914 2.282C0.17014 2.451 0.12914 2.59 0.12914 2.59C0.124197 2.63992 0.115506 2.68939 0.10314 2.738C-0.0217891 3.29128 -0.0333551 3.86413 0.0691395 4.422C0.282139 5.438 0.596139 5.882 2.38214 7.686C2.97214 8.284 5.39914 10.707 5.50414 10.81ZM12.3991 9.181C12.4751 9.20699 12.5437 9.25089 12.5991 9.309C12.8032 9.50073 13.0436 9.64959 13.3062 9.74677C13.5688 9.84396 13.8482 9.8875 14.1279 9.87482C14.4076 9.86214 14.6819 9.7935 14.9346 9.67295C15.1873 9.55241 15.4133 9.3824 15.5991 9.173C15.9901 8.835 16.1881 8.642 18.0991 6.738L19.9991 4.842L19.5221 4.36C19.2621 4.093 19.0421 3.88 19.0361 3.886C19.0301 3.892 18.2781 4.638 17.3661 5.547L15.7071 7.203L15.2331 6.735C15.0683 6.57808 14.9096 6.41496 14.7571 6.246C14.7571 6.237 15.5001 5.479 16.4121 4.567L18.0651 2.908L17.5991 2.431C17.4426 2.26687 17.2805 2.10811 17.1131 1.955C17.1041 1.955 16.3491 2.701 15.4371 3.61L13.7731 5.269L13.2881 4.789L12.8021 4.309L14.4601 2.651C15.0188 2.09764 15.5718 1.53861 16.1191 0.974C16.1191 0.965 15.5441 0.374 15.2541 0.095L15.1541 0L14.1891 0.983C12.2281 2.988 11.3571 3.892 10.8631 4.443C10.7681 4.549 10.6791 4.643 10.6701 4.65C10.6067 4.71785 10.5457 4.7879 10.4871 4.86C10.2982 5.11095 10.1778 5.40675 10.1379 5.71831C10.0979 6.02988 10.1397 6.34648 10.2591 6.637C10.3662 6.89635 10.5003 7.14371 10.6591 7.375C10.6711 7.384 10.7331 7.449 10.7991 7.517L10.9171 7.641L5.94814 12.614L0.97814 17.584L1.70114 18.313L2.42114 19.044L5.97514 15.49L9.52614 11.939L13.0571 15.469C14.2385 16.6544 15.4251 17.8344 16.6171 19.009C16.6321 19.015 18.0171 17.649 18.0381 17.593C18.0441 17.578 16.4571 15.973 14.5111 14.027L10.9741 10.488L11.5221 9.946C12.2631 9.211 12.2991 9.181 12.3991 9.181Z" fill="#1E0342" />
                        </svg>

                        <span>Meal</span>
                    </button>
                </li>

                <li>
                    <button class="nav-btn" id="nav-history">
                        <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16 9C17.49 9 18.87 9.47 20 10.26V6C20 4.89 19.11 4 18 4H14V2C14 0.89 13.11 0 12 0H8C6.89 0 6 0.89 6 2V4H2C0.89 4 0.00999999 4.89 0.00999999 6L0 17C0 18.11 0.89 19 2 19H9.68C9.17265 17.9335 8.94357 16.7559 9.01414 15.577C9.08471 14.3981 9.45262 13.2563 10.0836 12.2579C10.7145 11.2596 11.588 10.4373 12.6225 9.86758C13.6571 9.2979 14.819 8.99943 16 9ZM8 2H12V4H8V2Z" fill="#1E0342" />
                            <path d="M16 11C13.24 11 11 13.24 11 16C11 18.76 13.24 21 16 21C18.76 21 21 18.76 21 16C21 13.24 18.76 11 16 11ZM17.65 18.35L15.5 16.2V13H16.5V15.79L18.35 17.64L17.65 18.35Z" fill="#1E0342" />
                        </svg>

                        <span>History</span>
                    </button>
                </li>
            </ul>

            <a href="http://localhost/badyetko/screens/logout.php?" class="log-out-button">
                <span>Log out</span>
                <img src="../assets/icons/log out.png" alt="">
            </a>
        </nav>

        <div id="main-section">

        </div>

        <script>
            $("#main-section").load("./midsection.php");

            $("#nav-home").click(() => {
                $("#main-section").load("./midsection.php");
            })

            $("#nav-meal").click(() => {
                $("#main-section").load("./mealplan.php");
            })

            $("#nav-history").click((e) => {
                $("#main-section").load("./history.php");
            })



            let btns = document.querySelectorAll('.nav-btn');

            btns.forEach(btn => {
                btn.addEventListener('click', (b) => {

                    btns.forEach(bs => {
                        bs.classList.remove('active');
                    })

                    b.currentTarget.classList.add('active');
                })
            })
        </script>


    </main>

    <div class="modal-out none" id="add-spend-modal">
        <div class="modal">
            <form action="" method="POST" id="add-spend-form">
                <div class="expenses-type">
                    <p>Expenses type</p>
                    <label for="others" class="expense-type-radio">
                        <input type="radio" name="expense-type" id="others" value="Others" checked>
                        <span>Others</span>
                    </label>

                    <label for="meals" class="expense-type-radio">
                        <input type="radio" name="expense-type" value="Meals" id="meals">
                        <span>Meals</span>
                    </label>

                    <label for="transportation" class="expense-type-radio">
                        <input type="radio" name="expense-type" value="Transportation" id="transportation">
                        <span>Transportation</span>
                    </label>

                    <label for="biils" class="expense-type-radio">
                        <input type="radio" name="expense-type" value="Bills" id="biils">
                        <span>Biils</span>
                    </label>

                </div>
                <div class="input-spend-amount">
                    <label for="spend-amount">
                        <span>Amount</span>
                        <input type="number" placeholder="Amount" name="spend-amount" id="spend-amount">
                    </label>

                    <input type="submit" value="Add spend" name="submit-spend" id="add-spend-button">
                </div>
            </form>

            <div class="close-modal" id="close-modal">
                <img src="../assets/icons/close.png" alt="">
            </div>
        </div>
    </div>


</body>

</html>