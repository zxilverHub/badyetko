<?php
include("../system/config.php");
session_start();
$id = $_POST["id"];
$uid = $_SESSION["userid"];

$s = "update reminder set status = 1 where reminder_id = $id and user_id = $uid";
$conn->query($s);
