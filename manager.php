<?php

/*
 * This script allows the managment of the SMS
 */

require_once 'header.php';

//TODO: devide screen into frames, display all open incidents and hazards
//and their analysis allow to edit open occurences.
//add browsing function where you can browse the database
//add feedback option where feedback is send according to the actions taken

//$user = $_SESSION['user'];


if ($_SESSION['auth'] == True)
{
    echo "<ul class='menu'>"
    . "<li><a href='AllOpen.php'>View Open Occurences</a></li>"
    . "<li><a href='AllOcc.php'>View All Incidents</a></li>"
    . "<li><a href='AllHazards.php'>View All Hazards</a></li>"
    . "<li><a href='monthly_report.php'>Create Monthly Summary</a></li>"
    . "<li><a href='quarterly_summary.php'>Create Quarterly Summary</a></li>"
    . "<li><a href='list_description.php'>Manage Database</a></li>"
    . "<li><a href='list_users.php'>Manage Users</a></li>"
    . "<li><a href='portal.php'>Return to Portal</a></li><br>"
    . "<li><a href='safety_assurance_dash.php'>Safety Assurance</a></li></ul><br>";

}

else
{
    echo "You are not authorized to enter this area";
}
