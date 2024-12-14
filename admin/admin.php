<?php
include("../system/config.php");
session_start();

if (!isset($_SESSION["adminlog"])) {
    header("Location: http://localhost/badyetko/admin/adminlogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BadyetKo Admin</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../system/jquery.js"></script>
    <script>
        $(document).ready(() => {
            loadUsers();
        })


        function loadUsers() {
            $("#users").load("users.php");
        }

        function filterUser() {
            let k = $("#search").val();

            if (k == "") {
                $("#users").load("users.php");
            } else {
                $("#users").load("filtereduser.php?key=" + k);
            }

        }

        function deleteuser(id) {
            $.post("processdelete.php", {
                    userid: id
                },
                function(data, status) {
                    loadUsers();
                });
        }
    </script>
</head>

<body>
    <div class="admin-nav">
        <a href="#" class="admin-logo">
            <img src="../assets/BadyetKo.png" alt="">
        </a>
        <h1>Admin page </h1>
        <input type="text" placeholder="Search Email or ID" id="search" onkeyup="filterUser()">
        <a href="http://localhost/badyetko/admin/logout.php" class="admin-logout">
            Log out
        </a>
    </div>
    <div id="users"></div>
</body>

</html>