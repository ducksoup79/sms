<?php

require_once 'header.php';

$id = $_POST['haz_id'];

queryMysql("DELETE FROM hazards WHERE haz_id = '$id'");

if($query){
  echo 'Hazard Deleted';
}
else{
  echo 'Error: Could not delete hazard';
}
