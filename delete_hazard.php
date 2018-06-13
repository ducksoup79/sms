<?php

require_once 'header.php';

$id = $_GET['haz_num'];

queryMysql("DELETE FROM hazard_reports WHERE hazard_num='$id'");
queryMysql("DELETE FROM risk_assesment WHERE occurence_num='$id'");

exit(header("Location:AllOpen.php"));
