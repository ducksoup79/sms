<?php

require_once 'header.php';

$id = $_GET['hazard_num'];

queryMysql("DELETE FROM hazard_reports WHERE hazard_num='$id'");
queryMysql("DELETE FROM risk_assesment WHERE occurence_num='$id'");

exit(header("Location:AllHazards.php"));
