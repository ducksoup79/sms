<?php
//This script creates a new hazard from data received from ajax call in edit_risk Assesment

require_once "functions.php";

  $haz_id = sanatizeString($_POST['haz_id']);
  //$risk_ass_id = sanatizeString($_POST['risk_ass_id']);
  $category = sanatizeString($_POST['category']);
	$description = sanatizeString($_POST['description']);
  $likelihood = sanatizeString($_POST['likelihood']);
  $severity = sanatizeString($_POST['severity']);
  $risk = sanatizeString($_POST['risk']);
  $mitigation = sanatizeString($_POST['mitigation']);
  $mit_likelihood = sanatizeString($_POST['mit_likelihood']);
  $mit_severity = sanatizeString($_POST['mit_severity']);
  $mit_risk = sanatizeString($_POST['mit_risk']);


  if(sanatizeString($_POST['monitor']) == 'on'){

    $monitor = "Yes";
  }
  else{
    $monitor = "No";
  }


  if(sanatizeString($_POST['active']) == 'on'){

    $active = "Yes";
  }
  else{
    $active = "No";
  }

  $query= queryMysql("UPDATE hazards SET category='$category',"
          . "description='$description',"
          . "likelihood='$likelihood',"
          . "severity='$severity',"
          . "risk='$risk',"
          . "mitigation='$mitigation',"
          . "mitigated_likelihood='$mit_likelihood',"
          . "mitigated_severity='$mit_severity',"
          . "mitigated_risk='$mit_risk',"
          . "monitor='$monitor',"
          . "active='$active' WHERE haz_id='$haz_id';");



	//check if query were executed succesfully
	if($query){
		echo 'Hazard Created';
	}
	else{
		echo 'Error: Could not create Hazard';
	}
