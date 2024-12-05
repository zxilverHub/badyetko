<?php

use Google\Service\AdExchangeBuyerII\Date;
use Google\Service\Analytics\Resource\Data;

include("../system/config.php");
session_start();
date_default_timezone_set('Asia/Manila');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add schedule</title>

    <link rel="icon" href="../assets/Logo.png" type="image/icon type">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/addschedule.css">
</head>

<body>
    <?php
    if (isset($_POST["add-schedule"])) {

        $title = "";
        $amount = 0;
        $timeline = 0;
        $timeline_type = "";
        $breakfast = 0;
        $lunch = 0;
        $dinner = 0;


        // var_dump($_POST);
        // exit();

        // check inputs and assigning values
        if (
            isset($_POST["title"]) && !empty($_POST["title"]) &&
            isset($_POST["amount"]) && !empty($_POST["amount"]) &&
            isset($_POST["timeline"]) && !empty($_POST["timeline"])
        ) {
            $title = $_POST["title"];
            $amount = $_POST["amount"];
            $timeline = $_POST["timeline"];
            $breakfast = $_POST["breakfast-meal"];;
            $lunch = $_POST["lunch-meal"];;
            $dinner = $_POST["dinner-meal"];;

            $timeline_type = $_POST["timeline-type"] ?? "Daily";

            switch ($timeline_type) {
                case "Daily":
                    (int)$timeline *= 1;
                    break;
                case "Weekly":
                    (int)$timeline *= 7;
                    break;
                case "Monthly":
                    (int)$timeline *= 30;
                    break;
            }

            $groceries = isset($_POST["groceries"]) ? (int)$_POST["groceries"] : 0;
            $transportation = isset($_POST["transportation"]) ? (int)$_POST["transportation"] : 0;
            $others = isset($_POST["others"]) ? (int)$_POST["others"] : 0;

            $userLogId = $_SESSION["userid"] ?? 0;

            if (isset($_SESSION["userid"])) {
                $userLogId = $_SESSION["userid"];
            }

            $s =
                "
            update schedule
            set isDone = 1 
            where user_id = $userLogId;
            ";

            $conn->query($s);

            $s = "
            INSERT INTO schedule 
            VALUES (NULL, 
            '$title',
             $amount,
             $amount,
             $groceries,
             $transportation,
             $others,
             0,
             $userLogId);
            ";

            if ($conn->query($s)) {
                $lastSId = $conn->query("select LAST_INSERT_ID() as lastId")->fetch_assoc()['lastId'];

                $dateNow = date("Y-m-d");
                $timeNow = date("g:ia");

                $s =
                    "
                insert into timeline values
                (NULL, 1, $timeline, '$dateNow', '$timeNow', $lastSId);
                ";

                if ($conn->query(($s))) {
                    $s =
                        "
                    insert into meal values
                    (NULL, $lastSId);
                    ";


                    if ($conn->query($s)) {
                        $mealLastId = $conn->query("select LAST_INSERT_ID() as lastId")->fetch_assoc()["lastId"];

                        $dinnermeal = $_POST["dinner-meal"];
                        $lunchmeal = $_POST["lunch-meal"];
                        $breakfastmeal = $_POST["breakfast-meal"];

                        if ($breakfastmeal != 0) {
                            $s =
                                "
                            insert into mealplan values
                            (NULL, 'Breakfast', $breakfastmeal, $mealLastId);
                            ";

                            $conn->query($s);
                        }

                        if ($lunchmeal != 0) {
                            $s =
                                "
                            insert into mealplan values
                            (NULL, 'Lunch', $lunchmeal, $mealLastId);
                            ";

                            $conn->query($s);
                        }

                        if ($dinnermeal != 0) {
                            $s =
                                "
                            insert into mealplan values
                            (NULL, 'Dinner', $dinnermeal, $mealLastId);
                            ";

                            $conn->query($s);
                        }

                        $s =
                            "
                        select * from mealplan
                        where meal_id = $mealLastId;
                        ";

                        $result = $conn->query($s);
                        header("Location: http://localhost/badyetko/screens/home.php");
                    }
                }
            }
        }
    }
    ?>

    <form action="addschedule.php" method="POST">
        <div class="add-schedule-header">
            <div class="leading">
                <a href="http://localhost/badyetko/screens/home.php" class="back-to-home">
                    <img src="../assets/icons/arrowback.png" alt="">
                    <span>Cancel</span>
                </a>

                <h1>Add schedule</h1>
            </div>

            <input type="submit" value="Save and Add schedule" name="add-schedule" class="add-schedule-button">
        </div>
        <div class="schedule-inputs">
            <label for="title">
                Title
                <div class="input-div">
                    <input type="text" placeholder="My schedule" name="title" id="title">
                </div>
            </label>

            <label for="amount">
                Amount
                <div class="input-div">
                    <input type="number" placeholder="Amount" name="amount" id="amount">
                    <img src="../assets/icons/peso.png" alt="">
                </div>
            </label>

            <label for="transportation">
                Transportation
                <div class="input-div">
                    <input type="number" placeholder="Transportation" name="transportation" id="transportation">
                    <img src="../assets/icons/peso.png" alt="">
                </div>
            </label>

            <label for="groceries">
                Groceries
                <div class="input-div">
                    <input type="number" placeholder="Groceries" name="groceries" id="groceries">
                    <img src="../assets/icons/peso.png" alt="">
                </div>
            </label>

            <label for="others">
                Others
                <div class="input-div">
                    <input type="number" placeholder="Others" name="others" id="others">
                    <img src="../assets/icons/peso.png" alt="">
                </div>
            </label>
        </div>

        <div class="after-inputs">
            <div class="badget-timeline">
                <label for="timeline" class="timeline-input">
                    Timeline
                    <div class="input-div">
                        <input type="number" placeholder="Timeline" name="timeline" id="timeline">
                        <img src="../assets/icons/timeline.png" alt="">
                    </div>
                </label>

                <div class="timelines">
                    <label for="daily">
                        <input checked type="radio" name="timeline-type" value="Daily" class="timeline-type" id="daily">
                        Daily
                    </label>
                    <label for="weekly">
                        <input type="radio" name="timeline-type" value="Weekly" class="timeline-type" id="weekly">
                        Weekly
                    </label>
                    <label for="monthly">
                        <input type="radio" name="timeline-type" value="Monthly" class="timeline-type" id="monthly">
                        Monthly
                    </label>
                </div>

            </div>

            <div class="meal-plans">
                <div class="meal-options">
                    <p class="meal-title">Breakfast plan</p>
                    <div id="breakfast-meal" class="meals">

                    </div>
                </div>

                <div class="meal-options">
                    <p class="meal-title">Lunch plan</p>
                    <div id="lunch-meal" class="meals">

                    </div>
                </div>

                <div class="meal-options">
                    <p class="meal-title">Dinner plan</p>
                    <div id="dinner-meal" class="meals">

                    </div>
                </div>
            </div>
        </div>
    </form>
    <script src="../scripts/selectmeal.js"></script>
</body>

</html>