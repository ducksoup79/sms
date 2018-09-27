<?php
//edits the fdp details, and closes a flight.

require_once "functions.php";

$id = sanatizeString($_POST['id']);


$query=queryMysql("SELECT * FROM hazards WHERE haz_id='$id'");
$result = mysqli_fetch_row($query);

//get the data rady to send back to the ajax call whom called it in pilot_profile

  echo json_encode($result);
 ?>
