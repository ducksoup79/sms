<<<<<<< HEAD
<?php

require_once 'header.php';

$id = $_GET['haz_num'];

queryMysql("DELETE FROM hazard_reports WHERE hazard_num='$id'");
queryMysql("DELETE FROM risk_assesment WHERE occurence_num='$id'");

exit(header("Location:AllOpen.php"));
=======
<?php

require_once 'header.php';

$id = $_GET['hazard_num'];

queryMysql("DELETE FROM hazard_reports WHERE hazard_num='$id'");
queryMysql("DELETE FROM risk_assesment WHERE occurence_num='$id'");

exit(header("Location:AllHazards.php"));
>>>>>>> 81ddcce9ee9bcae6994e63c0074dc6f0e5a6899b
