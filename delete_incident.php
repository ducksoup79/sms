<?php

require_once 'header.php';

$id = $_GET['inc_num'];

queryMysql("DELETE FROM incident_reports WHERE inc_num='$id'");
queryMysql("DELETE FROM risk_assesment WHERE occurence_num='$id'");

exit(header("Location:AllOpen.php"));
