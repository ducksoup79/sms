<?php

require_once 'header.php';

$id = $_GET['haz_num'];

$query = queryMysql("DELETE FROM hazard_reports WHERE hazard_num = '$id'");

if($query){
  echo 'Hazard Deleted';
  exit(header("location:AllOpen.php"));
}
else{
  echo 'Error: Could not delete hazard';
}
