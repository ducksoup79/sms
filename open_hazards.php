<?php
    require_once "functions.php";

    $id = $_POST['id'];

    //fix this line up to get the open hazards for the particular risk assesment
    $result = queryMysql("SELECT * FROM hazards WHERE risk_ass_id = '".$id."'");

    $json = mysqli_fetch_all($result, MYSQLI_ASSOC);

    echo json_encode($json);
