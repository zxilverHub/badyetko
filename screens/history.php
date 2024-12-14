<div class="history-section">
    <div class="history-menu">

        <p>My history</p>

    </div>

    <script>
        $(".history-card").click((e) => {
            let id = e.currentTarget.id;
            $("#main-section").load(`./historycontent.php?id=${id}`)
        })
    </script>

    <table class="table">
        <tr>
            <th>Title</th>
            <th>Amount</th>
            <th>Date added</th>
            <th>Balance</th>
        </tr>
        <?php
        include("../system/config.php");
        session_start();
        $userid = $_SESSION["userid"];
        $s = "select * from schedule
        join timeline on timeline.schedule_id = schedule.schedule_id
        where schedule.user_id = $userid
        order by schedule.schedule_id desc
        
        ";
        $schedules = $conn->query($s);

        if ($schedules->num_rows > 0) {
            while ($row = $schedules->fetch_assoc()) {

        ?>
                <tr class="history-card" id="<?php echo $row["schedule_id"]; ?>">
                    <td class="title"><?php echo $row["title"] ?></td>
                    <td class="amount">P <?php echo $row["amount"] ?></td>
                    <td class="start"><?php echo $row["date_added"] ?></td>
                    <td class="saving"><?php echo $row["balance"] ?></td>
                </tr>

        <?php
            }
        } else {
            echo "No schedule history";
        }

        ?>
    </table>





    <!-- CARDS -->
</div>
</div>

<?php exit(); ?>

<table>