<?php
//returns all records in description table

require_once "functions.php";


$query=queryMysql("SELECT description FROM description");

while($r = mysqli_fetch_assoc($query)) {
    $rows[] = $r;
}

  echo json_encode($rows);
 ?>
