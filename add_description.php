<?php

/*
 * Adds a decription to the decription table to be used
 * with risk assesment
 */

require_once 'header.php';
$error = "";
$description=  sanatizeString($_POST['description']);
queryMysql("INSERT INTO description VALUES('','$description')");
header('Location:list_description.php');
exit;
?>
