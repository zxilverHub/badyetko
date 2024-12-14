<?php
include("../system/config.php");

$id = $_POST["userid"];

$s = "delete from user where user_id = $id";
$conn->query($s);
echo "User $id is deleted";
