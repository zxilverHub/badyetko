<?php
$conn = new mysqli("localhost", "root", "", "badyetko");

if ($conn->connect_error) {
    echo "Something went wrong";
}
