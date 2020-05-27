<?php
ob_start();
//error Reporting
ini_set('display_errors','On');
error_reporting(E_ALL);
include "admin/connect.php";
$sessionUser="";
if(isset($_SESSION['USER'])){
    $sessionUser=$_SESSION['USER'];
}
//ROUTES
$tp1="includes/templates/";//Templates Directory
$lang="includes/languages/";
$func="includes/functions/";
$css="layout/css/";
$js="layout/js/";
//include  the important  files 
include $func."functions.php";


include $tp1."header.php";  
ob_end_flush();
?>
