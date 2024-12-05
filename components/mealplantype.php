<?php
include('../system/config.php');
session_start();
?>

<?php
$userid = $_SESSION["userid"];
$s =
    "
    select schedule_id from schedule where user_id = $userid and isDone = 0;
    ";
if ($conn->query($s)->num_rows <= 0) {
    echo "<p>No selected meals</p>";
    exit();
}
$scheduleID = $conn->query($s)->fetch_assoc()["schedule_id"];

$s =
    "
select meal_id from meal where schedule_id = $scheduleID;
";

$mealID = $conn->query($s)->fetch_assoc()["meal_id"];

$s = "select timeline_number from timeline where schedule_id = $scheduleID";

$timeline = $conn->query($s)->fetch_array()["timeline_number"];

$s =
    "
select * from mealplan where meal_id = $mealID;
";

$mealplans = $conn->query($s);
$mealplansrows = $mealplans->num_rows;

if ($mealplansrows > 0) {
    while ($row = $mealplans->fetch_assoc()) {

        $meal_desciption = "";
        $mealtotalbudget = $row["meal_price"] * $timeline;
        $mealprice = $row["meal_price"];

        switch ($mealprice) {
            case 30:
                $meal_desciption = "Veggie meal";
                break;
            case 40:
                $meal_desciption = "Meat meal";
                break;
            case 50:
                $meal_desciption = "Budget meal";
                break;
            case 60:
                $meal_desciption = "2 meats combo";
                break;
            default:
                $meal_desciption = "Meal";
                break;
        }
?>
        <!-- While contents -->
        <div class="meal-plan-type">
            <div class="meal-plan-header">
                <img class="meal-bg" src="../assets/meal/<?php echo strtolower($row["meal_name"]); ?>.png" alt="">
                <h2 class="title"><?php echo $row["meal_name"]; ?></h2>

                <div class="description">
                    <p class="total-for"> ₱ <?php echo $mealtotalbudget; ?></p>
                    <p>Total budget for <?php echo $row["meal_name"]; ?> (<?php echo $meal_desciption; ?>)</p>
                </div>
            </div>


            <div class="meal-plans">

                <?php
                $s =
                    "
                    select * from mealtypes where price = $mealprice;
                    ";
                $mealresult = $conn->query($s);
                $mealscount = $mealresult->num_rows;

                $i = 1;

                while ($mealsrow = $mealresult->fetch_assoc()) {
                    if ($i > $timeline) {
                        break;
                    }
                ?>
                    <div class="meal-card">
                        <div class="meal">
                            <p class="day"><?php echo $i; ?></p>
                            <p class="meal-name"><?php echo $mealsrow["meal"] ?></p>
                        </div>
                        <p class="ingredients">
                            <?php echo $mealsrow["ingredients"] ?>
                        </p>

                        <div class="in-plate">
                            <?php echo $mealsrow["inplate"] ?>
                        </div>

                        <div class="meal-price">
                            ₱ <?php echo $mealsrow["price"] ?>
                        </div>
                    </div>

                <?php
                    $i++;
                }
                ?>
            </div>
        </div>
    <?php
    }
} else {
    ?>
    <!-- If no meals -->
    <p>No selected meals</p>
<?php
}
?>