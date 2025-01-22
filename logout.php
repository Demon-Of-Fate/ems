<?php
session_start();
session_destroy();
// echo " you are logeed out";
header("Location: login.php");
exit();
?>