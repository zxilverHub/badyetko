<?php
include("../system/config.php");
?>

<?php
$userLogId = $_SESSION["userid"] ?? 0;

$s =
    "
    select *, sum(mealplan.meal_price) as totalmeal from mealplan
    join meal on meal.meal_id = mealplan.meal_id 
    join schedule on schedule.schedule_id = meal.schedule_id 
    join user on schedule.user_id = user.user_id 
    join timeline on schedule.schedule_id = timeline.schedule_id 
    WHERE user.user_id = $userLogId and schedule.isDone = 0 
    GROUP by meal.meal_id;
    ";

$result = $conn->query($s);
// $scheduleid = $result->fetch_assoc()["schedule_id"] ?? 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if ($row["totalmeal"] != null) {
        $amount = $row["amount"];
        $transportation = $row["transportation"];
        $groceries = $row["groceries"];
        $others = $row["others"];
        $totalmeal = $row["totalmeal"] * $row["timeline_number"];
?>

        <div class="graph-range">
            <p><?php echo $amount ?></p>
            <p><?php echo (int)($amount * 0.75) ?></p>
            <p><?php echo (int)($amount * 0.50) ?></p>
            <p><?php echo (int)($amount * 0.25) ?></p>
            <p>0</p>
        </div>

        <div class="range-data" data-value="<?php echo $amount ?>">
            <div class="range meal" title="Meals" data-value="<?php echo $totalmeal ?>"></div>
            <div class="range transport" title="Transportation" data-value="<?php echo $transportation ?>"></div>
            <div class="range snacks" title="Groceries" data-value="<?php echo $groceries ?>"></div>
            <div class="range others" title="Others" data-value="<?php echo $others ?>"></div>
        </div>

        <script>
            document.querySelectorAll(".range-data .range").forEach((i) => {
                let amount = document.querySelector('.range-data').dataset.value;
                let percentage = (Number(i.dataset.value) / Number(amount)) * 100;

                i.setAttribute('style', `height: ${percentage}% !important`);
            })
        </script>

    <?php } else { ?>
        <div class="no-graph">No data to show</div>
    <?php
    } ?>
<?php } else { ?>
    <div class="no-graph">No data to show</div>
<?php } ?>