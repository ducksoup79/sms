<?php

/* 
 * This script requires a occurence type and number before opening a new
 * risk assesment.
 */

require_once 'header.php';

//if ($_SESSION['auth']== True)
        
//{
  //  if(isset($_POST['submit'])) //if the form is submitted, do the following
//{
        
    //call the update query to save changes in form
    //$type=$_POST['type'];
    $occurence_num=$_POST['occurence_num'];
    $description=$_POST['description'];
    $category=$_POST['category'];
    $hazards=$_POST['hazards'];
    $hazard1=$_POST['hazard1'];
    $risk1=$_POST['risk1'];
    $hazard2=$_POST['hazard2'];
    $risk2=$_POST['risk2'];
    $hazard3=$_POST['hazard3'];
    $risk3=$_POST['risk3'];
    $hazard4=$_POST['hazard4'];
    $risk4=$_POST['risk4'];
    $total_risk=$_POST['total_risk'];
    $root_cause=nl2br($_POST['root_cause']);
    $defence=nl2br($_POST['defence']);
    $defence_req=$_POST['defence_req'];
    $action_taken=$_POST['action_taken'];
    $risk_status=$_POST['risk_status'];

    if ($risk_status=='closed'){
	$risk_status='closed';
    }
    else {
        $risk_status='open';
    }

             
    queryMysql("INSERT INTO risk_assesment VALUES('',"
        . "'$occurence_num',"
        . "'$description',"
        . "'$category',"
        . "'$hazards',"
        . "'$hazard1',"
        . "'$risk1',"
        . "'$hazard2',"
        . "'$risk2',"
        . "'$hazard3',"
        . "'$risk3',"
        . "'$hazard4',"
        . "'$risk4',"
        . "'$total_risk',"
        . "'$root_cause',"
        . "'$defence',"
        . "'$defence_req',"
        . "'$action_taken',"
        . "'$risk_status')");
    
 
    header('location:AllOpen.php');
    exit;
