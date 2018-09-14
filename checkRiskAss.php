<?php
// Check if risk assesment exists
// If it doesn't exist then re-direct to risk_ass.html
// If exist then re-direct to edit_risk_ass.php

require_once 'header.php';

$occurence_num = sanatizeString($_GET['inc_num']);

$query = queryMysql("SELECT * FROM risk_assesment WHERE occurence_num='$occurence_num'");

if(mysqli_num_rows($query) != 0)
{
header("Location:edit_risk_ass.php?occurence_num=$occurence_num");
exit();
}
else
{
header("Location:risk_ass_form.php?occurence_num=$occurence_num");
exit();
}
