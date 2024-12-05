<section class="mid-section">
    <h1>My Dashboard</h1>

    <!-- Cards components -->
    <div class="balance-section">
        <?php include("../components/cardbalance.php"); ?>

        <?php include("../components/cadcalendart.php"); ?>
    </div>

    <div class="mid-navbar">
        <button class="active" id="reminder-btn">Reminders</button>
        <button id="saving-btn">Saving goals</button>
    </div>

    <div class="data-section" id="reminder-section">

    </div>
</section>

<section class="summary">
    <h3>Expenses categories</h3>
    <div class="graph">
        <div class="graph-data">
            <!-- Categories Component-->
            <?php include("../components/amountcategories.php"); ?>
        </div>
        <div class="data-cta">
            <!-- <button class="add-budget">Income</button> -->
            <button class="add-expenses">Add spent</button>
            <!-- <button class="next-day">Next day</button> -->
        </div>
    </div>
    <h3 class="summary-title">Expenses summary</h3>
    <div class="expenses">
        <?php include("../components/expensescard.php"); ?>
    </div>
</section>

<script>
    $("#reminder-section").load("./reminders.php");

    $("#reminder-btn").click(() => {
        $("#reminder-section").load("./reminders.php");
    })

    $("#saving-btn").click(() => {
        $("#reminder-section").load("./budgetcard.php");
    })
</script>

<script src="../scripts/modals.js"></script>
<script src="../scripts/middata.js"></script>