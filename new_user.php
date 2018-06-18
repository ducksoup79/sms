<?php

/*
 * Creates a new user in the database, only the admin should have access
 * to this script
 */

require_once 'header.php';


if ($_SESSION['role']=='admin')
{

if (isset($_POST['submit']))
{
    $user_name = sanatizeString($_POST['user_name']);
    $user_surname = sanatizeString($_POST['user_surname']);
    $pass = sanatizeString($_POST['pass']);
    $role = sanatizeString($_POST['role']);
    $e_mail = sanatizeString($_POST['e_mail']);
    $cell = sanatizeString($_POST['cell']);
    $lic_number = sanatizeString($_POST['lic_num']);

   $stored_password =md5(trim($pass));

    queryMysql("INSERT INTO members VALUES('',"
        . "'$user_name',"
        . "'$user_surname',"
        . "'$stored_password',"
        . "'$role',"
        . "'$e_mail',"
        . "'$cell',"
        . "'$lic_number')");

        header('Location:list_users.php');
        exit;

}
}
?>

<html>
    <body>
    <form method='post' action='new_user.php'>
    Name: <input type='text' maxlength='20' name='user_name' id='user_name' ><br>
    Surname: <input type='text' maxlength='20' name='user_surname' id='user_surname'><br>
    Password: <input type='text' maxlength='40' name='pass' id='pass'><br>
    Role: <input type='text' maxlength='10' name='role' id='role'><br>
    E-mail: <input type='text' maxlength='30' name='e_mail' id='e_mail'><br>
    Cell: <input type='text' maxlength='15' name='cell' id='cell'><br>
    Lic Num: <input type='text' maxlength='10' name='lic_num' id='lic_num'><br>
   <input type="submit" id ="submit" type ="submit" name="submit" value="Create">
    </form>
    </body>
</html>
