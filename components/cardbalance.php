<?php
include("../system/config.php");
session_start();
?>

<?php
$userLogId = $_SESSION["userid"] ?? 0;

$s =
    "
    select * from user 
    join schedule
    on schedule.user_id = user.user_id
    where user.user_id = $userLogId and schedule.isDone = 0;
    ";

$result = $conn->query($s);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $currentbalance = $row["balance"];
    $balancepercentage = 100;
?>



    <div class="balance-card">
        <p class="card-title">Balance</p>
        <div class="balance-highligth">
            <p class="current-balance">₱ <?php echo $currentbalance ?></p>
            <p class="balance-percentage"><?php echo $balancepercentage ?>%</p>
        </div>
        <p class="from-balance">from <span>₱ <?php echo $row["amount"] ?></span></p>
        <img class="card-bg" src="../assets/bg/card-bg.png" alt="">
    </div>
<?php } else { ?>
    <div class="balance-card">
        <p class="card-title">Balance</p>
        <div class="balance-highligth">
            <p class="current-balance">...</p>
        </div>
        <p class="from-balance">No schedule today</p>
        <img class="card-bg" src="../assets/bg/card-bg.png" alt="">
    </div>
<?php } ?>