<?php
//This script loads the date and duty time into the database

require_once "functions.php";



	$description = sanatizeString($_POST['description']);

	$query = queryMysql("INSERT INTO description VALUES(DEFAULT,'$description')");

	//check if query were executed succesfully
	if($query){
		echo 'Description Added';
	}
	else{
		echo 'Error: Description not added';
	}
