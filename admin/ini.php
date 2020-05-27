<?php
include "connect.php";
//ROUTES
$tp1="includes/templates/";//Templates Directory
$lang="includes/languages/";
$func="includes/functions/";
$css="layout/css/";
$js="layout/js/";
//include  the important  files 
include $func."functions.php";
include $lang."english.php";
include $tp1."header.php";
//include navbar on all pages expect the one with nonavbar variable 
if(!isset($nonavbar)){include $tp1."navbar.php";}
?>