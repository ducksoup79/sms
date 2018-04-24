<?php

require_once 'header.php';

$id = $_GET['user_id'];

queryMysql("DELETE FROM members WHERE user_id='$id'");

exit(header("Location:list_users.php"));
