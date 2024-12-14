<table>
    <tr>
        <th>User ID</th>
        <th>Email</th>
        <th>No. of Sched</th>
        <th>Last onlines</th>
    </tr>

    <?php
    include("../system/config.php");
    $key = $_GET["key"];

    $sql = "
            select *, count(schedule.schedule_id) as noofsched, count(schedule.isDone) as done from user
            join schedule on schedule.user_id = user.user_id
            join account on account.user_id = user.user_id
            where account.email like '$key%' or user.user_id like '$key%'
            group by user.user_id
            ";

    $users = $conn->query($sql);

    if ($users->num_rows > 0) {
        while ($row = $users->fetch_assoc()) {
    ?>

            <tr>
                <td><?php echo $row["user_id"] ?></td>
                <td><?php echo $row["email"] ?></td>
                <td><?php echo $row["noofsched"] ?></td>
                <td><?php echo $row["last_online"] ?></td>
                <td class="op"><button class="deleteuser" onclick="deleteuser(<?php echo $row['user_id'] ?>)">Delete</button></td>
            </tr>
    <?php

        }
    }
    ?>

</table>