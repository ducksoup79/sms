<?php

/*
 * This script handels the reporting of incidents
 */

require_once 'header.php';

$error = "";

$inc_num = "00";//sanatizeString($_POST["inc_num"]);
$date = date_to_mysql(sanatizeString($_POST["inc_date"]));
$inc_time = convert_time(sanatizeString($_POST["inc_time"]));
$duty_time = convert_time(sanatizeString($_POST["duty_time"]));
$flight_time = convert_time(sanatizeString($_POST["flight_time"]));
$location = sanatizeString($_POST["location"]);
$aircraft_reg = sanatizeString($_POST["aircraft_reg"]);
$aircraft_type = sanatizeString($_POST["aircraft_type"]);
$departure = sanatizeString($_POST["departure"]);
$destination = sanatizeString($_POST["destination"]);
$type_flight = sanatizeString($_POST["type_flight"]);
$phase = sanatizeString($_POST["phase"]);
$airspeed = sanatizeString($_POST["airspeed"]);
$altitude = sanatizeString($_POST["altitude"]);
$heading = sanatizeString($_POST["heading"]);
$flight_rules = sanatizeString($_POST["flight_rules"]);
$flight_conditions = sanatizeString($_POST["flight_conditions"]);
$turbulance = sanatizeString($_POST["turbulance"]);
$winds_gusts = sanatizeString($_POST["winds_gusts"]);
$rain = sanatizeString($_POST["rain"]);
$other_info = sanatizeString($_POST["other_info"]);
$pic = sanatizeString($_POST["pic"]);
$training_captain = sanatizeString($_POST["training_captain"]);
$description_mulf_item = sanatizeString($_POST["description_mulf_item"]);
$details_mulf_item = sanatizeString($_POST["details_mulf_item"]);
$event_description = sanatizeString($_POST["event_description"]);
$reporter = sanatizeString($_POST["reporter_name"]);
$lic_number = sanatizeString($_POST["lic_number"]);
$contact_number = sanatizeString($_POST["contact_number"]);
$e_mail = sanatizeString($_POST["e_mail"]);
$report_date = date_to_mysql(sanatizeString($_POST["report_date"]));
$closed_date = date_to_mysql("");//date_to_mysql(sanatizeString($_POST["closed_date"]));
$closed_responsible = "";//sanatizeString($_POST["closed_responsible"]);
$status = "open";//sanatizeString($_POST["status"]);
$feedback = "pending";

queryMysql("INSERT INTO incident_reports VALUES('',"
        . "'$inc_num',"
        . "'$date',"
        . "'$inc_time',"
        . "'$duty_time',"
        . "'$flight_time',"
        . "'$location',"
        . "'$aircraft_reg',"
        . "'$aircraft_type',"
        . "'$departure',"
        . "'$destination',"
        . "'$type_flight',"
        . "'$phase',"
        . "'$airspeed',"
        . "'$altitude',"
        . "'$heading',"
        . "'$flight_rules',"
        . "'$flight_conditions',"
        . "'$turbulance',"
        . "'$winds_gusts',"
        . "'$rain',"
        . "'$other_info',"
        . "'$pic',"
        . "'$training_captain',"
        . "'$description_mulf_item',"
        . "'$details_mulf_item',"
        . "'$event_description',"
        . "'$reporter',"
        . "'$lic_number',"
        . "'$contact_number',"
        . "'$e_mail',"
        . "'$report_date',"
        . "'',"
        . "'$closed_date',"
        . "'$closed_responsible',"
        . "'$status',"
        . "'$feedback')");

        my_mail($e_mail,"Incident filed","Thank you for filing the incident, we will keep you updated on the investigation");
        my_mail($notification,"Incident filed","A Incident was filed {$report_date}");
