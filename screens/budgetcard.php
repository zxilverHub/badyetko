<?php
include("../system/config.php");
session_start();
?>

<?php
$userID = $_SESSION["userid"];

$s =
    "
    select * from schedule where user_id = $userID and isDone = 0;
    ";

if ($conn->query($s)->num_rows > 0) {
    $row = $conn->query($s)->fetch_assoc();

    $schid = $row["schedule_id"];
    $s = "select meal_id from meal where schedule_id = $schid";

    $mealid = $conn->query($s)->fetch_assoc()["meal_id"];

    $s = "select * from mealplan where meal_id = $mealid";

    $totalMealBudget = 0;

    $mealplansresult = $conn->query($s);
    if ($mealplansresult->num_rows > 0) {
        while ($mealplanrow = $mealplansresult->fetch_assoc()) {
            $totalMealBudget += $mealplanrow["meal_price"];
        }
    }

    $s = "select timeline_number from timeline where schedule_id = $schid";
    $timelinenum = 0;
    $timelinenumberresult = $conn->query($s);
    if ($timelinenumberresult->num_rows > 0) {
        $timelinenum = $timelinenumberresult->fetch_assoc()["timeline_number"];
    }

    $totalMealBudget *= $timelinenum;
    $possiblesavingamount = $row["amount"] - ($totalMealBudget + $row["transportation"] + $row["others"] + $row["groceries"]);

    $s = "select * from expenses where schedule_id = $schid";

    $mealsexpenses = 0;
    $transportationsexpenses = 0;

    $expensesresult = $conn->query($s);

    if ($expensesresult->num_rows > 0) {
        while ($expensesrow = $expensesresult->fetch_assoc()) {
            if ($expensesrow["expenses_type"] == "Meals") {
                $mealsexpenses += $expensesrow["expenses_amount"];
            } elseif ($expensesrow["expenses_type"] == "Transportation") {
                $transportationsexpenses += $expensesrow["expenses_amount"];
            }
        }
    }

    if ($totalMealBudget < $mealsexpenses) {
        $possiblesavingamount -= ($mealsexpenses - $totalMealBudget);
    }

    if ($row["transportation"] < $transportationsexpenses) {
        $possiblesavingamount -= ($transportationsexpenses - $row["transportation"]);
    }

?>
    <!-- if there is schedule -->
    <div class="data-section" id="saving-section">
        <div class="possible-savings">
            <p class="saving-amount">₱<?php echo $possiblesavingamount; ?></p>
            <p class="budget-label">Possible savings</p>
        </div>
        <div class="budget-division">
            <div class="budget-card">
                <p class="budget-amount">
                    ₱<?php echo $totalMealBudget ?>
                </p>
                <p class="budget-label">Meal</p>

                <p class="spent-in">-₱<?php echo $mealsexpenses; ?></p>
            </div>

            <div class="budget-card">
                <p class="budget-amount">
                    ₱<?php echo $row["transportation"] ?>
                </p>
                <p class="budget-label">Transportation</p>

                <p class="spent-in">-₱<?php echo $transportationsexpenses; ?></p>
            </div>

            <div class="budget-card">
                <p class="budget-amount">
                    ₱<?php echo $row["groceries"] ?>
                </p>
                <p class="budget-label">Groceries</p>

            </div>

            <div class="budget-card">
                <p class="budget-amount">
                    ₱<?php echo $row["others"] ?>
                </p>
                <p class="budget-label">Others</p>

            </div>
        </div>
    </div>
<?php
} else {
?>
    <div id="saving-section">No schedule</div>
    <!-- if there no schedule -->
<?php } ?>