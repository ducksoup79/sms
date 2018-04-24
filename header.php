<?php

/* 
 * This header script would be called on all pages to ensure they all look
 * the same
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
echo "<!DOCTYPE HTML><HTML><HEAD>";
require_once 'functions.php';

$userstr ='(Guest)';
if (isset($_SESSION['user']))
{
    $user = $_SESSION['user'];
    $loggedin = TRUE;
    $userstr = "($user)";
}
else $loggedin = FALSE;

echo "<title></title><link rel='stylesheet'" .
        "href='styles.css' type='text/css'>"                 .
        "</head><body><center><canvas id='logo' width='624'" .
        "height='96'></canvas></centre>"             .
        "<div class='appname'>SMS MANAGER</div>"        .
        "<script src='javascript.js'></script>";

if ($loggedin)
    echo "<br><ul class='menu'>".
        "<li><a href='IncidentReportForm.php'>File Incident</a></li>".
        "<li><a href='HazardReportForm.php'>File Hazard Report</a></li>".
        "<li><a href='manager.php'>Manager</a></li>".
        "<li><a href='logout.php'>Log Out</a></li></ul><br>";

else
{
        echo ("<br><a href='login.php'>Login</a>");
}   

