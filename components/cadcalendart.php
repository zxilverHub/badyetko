<?php
include("../system/config.php");
?>

<?php

$userLogId = $_SESSION["userid"] ?? 0;

$s = "select * from schedule where user_id = $userLogId ";
$schedidr = $conn->query($s);
$schedid = 0;
if ($schedidr->num_rows > 0) {
    $schedid = $schedidr->fetch_assoc()["schedule_id"];

    $s = "
    UPDATE timeline
    SET count = DATEDIFF(CURDATE(), date_added) + 1
    WHERE schedule_id = $schedid;
    ";

    $conn->query($s);
}



$s =
    "
    select * from user 
    join schedule
    on schedule.user_id = user.user_id
    join timeline
    on timeline.schedule_id = schedule.schedule_id
    where user.user_id = $userLogId and schedule.isDone = 0;
    ";

$result = $conn->query($s);


if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $count = $row["count"];
    $timeline_number = $row["timeline_number"];
    $daysPercentage = ($count / $timeline_number) * 100;
?>
    <div class="calendar-card">
        <p class="card-title">Budget Calendar</p>
        <div class="balance-highligth">
            <p class="current-balance"><?php echo $count; ?> <span> out of </span> <?php echo $timeline_number; ?></p>
            <p class="balance-percentage"><?php echo (int)$daysPercentage; ?>%</p>
        </div>
        <p class="from-balance"> days left</p>
    </div>
<?php } else { ?>
    <div class="calendar-card">
        <p class="card-title">Budget Calendar</p>
        <div class="balance-highligth">
            <p class="current-balance">...</span></p>
        </div>
        <p class="from-balance">Please add schedule</p>
    </div>
<?php } ?>