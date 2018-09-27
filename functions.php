<?php

/*
 * functions.php contains the database login details and all the functions
 * for smsReport
 */

/*this file lives in a secure location on the server and contains all the dbase
 *login details:
 * $dbhost = '';
 * $dbname = '';
 * $dbuser = '';
 * $dbpass = '';
 *
 */
 //session_start();

include "/var/www/html/sms/config/dbase_config.php";


$connection = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
if ($connection->connect_error) die ($connection->connect_error);


//this function is used for all queries to the database
function queryMysql($query)
{
    global $connection;
    $result = $connection->query($query);
    if (!$result) die($connection->error);
    return $result;

}

//destroys the session when done
function destroySession()
{
    $_SESSION=array();

    if (session_id() !="" || isset($_COOKIE[session_name()]))
        setcookie (session_name (), '', time()-2592000, '/');
    session_destroy();
}

//cleans input data to prevent malicious code
function sanatizeString($var)
{
    global $connection;
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return $connection->real_escape_string($var);
}

//creates a table in the database
function createTable($name, $query)
{
    echo "<br><br>";
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "<br><br> Table '$name' created or already exists.<br>";
}

//convert date from mysql format to normal
function convert_date($mysqldate){
    return date("d/m/Y",strtotime($mysqldate));
}

//convert mysql time h:m:s into h:m
function convert_time($mysqltime){
    if ($mysqltime != "")
    {
        return date("H:i",strtotime($mysqltime));
    }
    else
    {
        return NULL;
    }
}

//convert date d/m/y into mysql date y/m/d
function date_to_mysql($mydate){
    if ($mydate !="")
    {
        $date = str_replace('/','-',$mydate);
        return date('Y-m-d',strtotime($date));
    }
    else
    {
        return NULL;
    }
}

//sends a message to the provided e-mail containing the subject and message
function my_mail($e_mail,$subject,$msg){

  // Always set content-type when sending HTML email
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

  // More headers
  //$headers .= 'From: <webmaster@example.com>' . "\r\n";
  //$headers .= 'Cc: myboss@example.com' . "\r\n";

  // use wordwrap() if lines are longer than 70 characters
  $msg = wordwrap($msg,70);

  // send email
  mail($e_mail,$subject,$msg,$headers);

  echo "Mail was send!!!";

}

function checkStatus($rowValue) {

    //Define the colors first
    $color1 = '#FF0000';
    $color2 = '#ADFF2F';
    $color3 = '#D3D3D3';

    $row_string = implode($rowValue);


    switch ($row_string) {

        case "open":
             return $color1;
            break;

        case "pending":
            return $color1;
            break;

        case "closed":
             return $color2;
            break;

        case "send":
            return $color2;
            break;

        default:
             return $color3;
    }
}
