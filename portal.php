<?php

/*
 * Creates the portal where users can interact with the system
 */
require_once'header.php';

//TODO: add frames to the screen, display hazards, and latest bulletins.
require_once 'functions.php';

if(isset($_SESSION['user'])){

  echo "You are now loggedd in";

}

else {
  echo "You are not authorized";
  echo $_SESSION['email'];
}
