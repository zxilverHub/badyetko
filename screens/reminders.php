<script>
    function reminderOpen() {
        console.log('openn')
        document.getElementById('remider-dialog').classList.remove('none-r');
    }

    function reminderDone(id) {
        $.post('../components/doneReminder.php', {
            id: id
        }, function(data, status) {
            window.location = "http://localhost/badyetko/screens/home.php?";
        })
    }
</script>

<button onclick="reminderOpen()" class="add-reminder">
    +
</button>
<div class="reminder-card labels">
    <div class="reminder-title">
        <p>Reminder</p>
    </div>
    <div class="date">Date</div>
    <div class="amount">Amount</div>
    <div>Status</div>
</div>

<div class="remider-cards">
    <?php

    use Google\Service\AdExchangeBuyerII\Date;

    include("../system/config.php");
    session_start();
    $id = $_SESSION["userid"];
    $s = "select * from reminder where user_id = $id order by status asc";

    $remiders = $conn->query($s);

    if ($remiders->num_rows > 0) {
        while ($row = $remiders->fetch_assoc()) {
    ?>
            <div class="reminder-card">
                <div class="reminder-title">
                    <img src="../assets/icons/<?php echo $row["reminder_type"] ?>.png" alt="">
                    <p><?php echo $row["reminder_type"] ?></p>
                </div>
                <div class="date">
                    <?php
                    $date = new DateTime($row["duedate"]);
                    $formattedDate = $date->format('M j, Y');
                    echo $formattedDate;

                    ?>
                </div>
                <div class="amount">P <?php echo $row["reminder_amount"] ?></div>
                <button class="status" onclick="reminderDone(<?php echo $row['reminder_id'] ?>)">
                    <?php
                    if ($row["status"] == 0) {
                        echo "Not paid";
                    } else {
                        echo "paid";
                    }
                    ?>
                </button>
            </div>
        <?php
        }
    } else {
        ?>
        <div>No reminders</div>
    <?php
    }
    ?>


</div>