<?php

require_once 'header.php';

$id = $_GET['desc_id'];

queryMysql("DELETE FROM description WHERE desc_id='$id'");

exit(header("Location:list_description.php"));
