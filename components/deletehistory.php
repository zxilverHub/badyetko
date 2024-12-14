<?php
include("../system/config.php");
$id =  $_POST["id"];

$s = "delete from schedule where schedule_id = $id";
$conn->query($s);
