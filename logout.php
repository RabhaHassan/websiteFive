<?php
session_start();
include "admin/connect.php";    
global $con;
unset($_SESSION["USER"]);
unset($_SESSION["UID"]);
unset($_SESSION["UIDITEM"]);
unset($_SESSION["NAMEITEM"]);
unset($_SESSION["resetEmail"]);

unset($_SESSION["AVATARM"]);

unset($_SESSION["UIDconfirm"]);
header('location:index.php');
exit();
?>