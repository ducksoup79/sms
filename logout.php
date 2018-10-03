<?php

/*
 * logout.php log out the user and end the session
 *
 */

require_once 'functions.php';

destroySession();
exit(header("location:login.html"));

