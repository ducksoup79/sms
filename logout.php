<?php

/*
 * logout.php log out the user and end the session
 *
 */

require_once 'header.php';

if(isset($_SESSION['user']))
{
    destroySession();
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=login.html">';
    exit();
}
