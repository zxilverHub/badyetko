<?php
session_start();
session_destroy();

header("Location: http://localhost/badyetko/screens/signuppage.php?");
