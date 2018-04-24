<?php

/*
 * This script handels the reporting of hazards
 *
 */

require_once 'header.php';

$error = "";

$hazard_num = "h0";
$haz_date = date_to_mysql(sanatizeString($_POST["haz_date"]));
$aircraft_reg = sanatizeString($_POST["aircraft_reg"]);
$aircraft_type = sanatizeString($_POST["aircraft_type"]);
$departure = sanatizeString($_POST["departure"]);
$arrival = sanatizeString($_POST["arrival"]);
$hazard_detail = sanatizeString($_POST["hazard_detail"]);
$name = sanatizeString($_POST["name"]);
$tel_number = sanatizeString($_POST["tel_number"]);
$e_mail = sanatizeString($_POST["e_mail"]);
$lic_number = sanatizeString($_POST["lic_number"]);
$status = "open";
$target_date ="";
$date_closed = "";
$person_responsible ="";
$feedback = "pending";

queryMysql("INSERT INTO hazard_reports VALUES('',"
        . "'$hazard_num',"
        . "'$haz_date',"
        . "'$aircraft_reg',"
        . "'$aircraft_type',"
        . "'$departure',"
        . "'$arrival',"
        . "'$hazard_detail',"
        . "'$name',"
        . "'$tel_number',"
        . "'$e_mail',"
        . "'$lic_number',"
        . "'$status',"
        . "'$target_date',"
        . "'$date_closed',"
        . "'$person_responsible',"
        . "'$feedback')");

my_mail($e_mail,"Hazard filed","Thank you for filing the hazard, we will keep you updated on the investigation");
my_mail("safaripilot1@gmail.com","Hazard filed","A Hazard was filed {$haz_date}");
