<?php
include("../system/config.php");
$id = $_GET["id"];
$amount = 0;
$meals = 0;
$transportation = 0;
$others = 0;
$groceries = 0;

$s = "select * from schedule where schedule_id = $id";

$schedule = $conn->query($s);

if ($schedule->num_rows > 0) {
    $row = $schedule->fetch_assoc();
    $amount = $row["amount"];
    $groceries = $row["groceries"];
    $transportation = $row["transportation"];
    $others = $row["others"];
}


?>

<script>
    $("#backbutton").click((e) => {
        $("#main-section").load("./history.php")
    })

    function deleteHistory(id) {
        $.post(`../components/deletehistory.php`, {
                id: id
            },
            function(data, status) {
                $("#main-section").load("./history.php")
            });
    }
</script>

<style>
    .delete-button:hover {
        opacity: .8;
        cursor: pointer;
    }
</style>

<div class="history-content-section">
    <div class="history-menu">
        <button id="backbutton">
            <img src="../assets/icons/arrowback.png" alt="">
            Back
        </button>

        <p>My history</p>

        <button class="delete-button" onclick="deleteHistory(<?php echo $id ?>)">Delete</button>
    </div>

    <div class="main-content">
        <div class="content">
            <h2>Budget categories</h2>

            <div class="content-cards">
                <div class="content-card">
                    <p class="amount">P <?php echo $amount ?></p>
                    <p class="label">Amount</p>
                </div>

                <div class="content-card">
                    <p class="amount">P <?php echo $groceries ?></p>
                    <p class="label">Groceries</p>
                </div>

                <div class="content-card">
                    <p class="amount">P <?php echo $transportation ?></p>
                    <p class="label">Transporation</p>
                </div>


                <div class="content-card">
                    <p class="amount">P <?php echo $others ?></p>
                    <p class="label">Others</p>
                </div>
            </div>
        </div>

        <div class="expenses-content">
            <h2>Expenses log</h2>

            <div class="expenses-cards">

                <?php

                $s = "select * from expenses where schedule_id = $id";
                $exp = $conn->query($s);

                if ($exp->num_rows > 0) {
                    while ($row = $exp->fetch_assoc()) {
                ?>

                        <div class="card">
                            <div class="heading">
                                <p class="title"><?php echo $row["expenses_type"]; ?></p>
                                <php class="date"><?php echo $row["date_added"] . " · " . $row["time_added"]; ?></p>
                            </div>
                            <p class="amount">-P <?php echo $row["expenses_amount"]; ?></p>
                        </div>


                <?php
                    }
                }

                ?>
            </div>
        </div>
    </div>
</div>