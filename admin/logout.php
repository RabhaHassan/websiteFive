<?php
session_start();
unset($_SESSION["USERNAME"]);
unset($_SESSION["ID"]);
header('location:index.php');
exit();
?>