<?php
include("../system/config.php");
?>

<?php
$userLogId = $_SESSION["userid"] ?? 0;


$s =
    "
    select * from schedule where user_id = $userLogId and isDone = 0;
    ";

$scheduleidresult = $conn->query($s);

// checks if there is scheduled
if ($scheduleidresult->num_rows > 0) {
    $schedresult = $scheduleidresult->fetch_assoc();
    $title = $schedresult["title"];
    $scheduleid = $schedresult["schedule_id"];

    $s =
        "
    select * from expenses where schedule_id = $scheduleid order by expenses_id desc;
    ";

    $result = $conn->query($s);

    if ($result->num_rows > 0) {
?>

        <div class="expenses">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="expenses-card">
                    <img src="../assets/icons/<?php echo $row["expenses_type"]; ?>.png" alt="">
                    <div class="expenses-label">
                        <p class="name"><?php echo $row["expenses_type"]; ?></p>
                        <p class="date"><?php echo $row["date_added"]; ?> | <?php echo $row["time_added"]; ?></p>
                    </div>
                    <p class="expenses-action"><?php echo $row["operation"] ? "+" : "-" ?> ₱<?php echo $row["expenses_amount"]; ?></p>
                </div>
            <?php endwhile; ?>
        </div>


    <?php     } else {
        echo "<div class='no-graph'>No expenses...</div>";
    }
} else { ?>
    <div class="no-graph">No expenses...</div>
<?php } ?>