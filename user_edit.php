<?php

/*
 * Creates a new user in the database, only the admin should have access
 * to this script
 */

require_once 'header.php';


$id = sanatizeString($_GET['user_id']);

$query1 = queryMysql("SELECT * from members WHERE user_id='$id'");
$query2 = mysqli_fetch_array($query1);


if ($_SESSION['auth']==True)
{

if (isset($_POST['submit']))
{
    $user_id = sanatizeString($_POST['user_id']);
    $user_name = sanatizeString($_POST['user_name']);
    $user_surname = sanatizeString($_POST['user_surname']);
    $pass = sanatizeString($_POST['pass']);
    $role = sanatizeString($_POST['role']);
    $e_mail = sanatizeString($_POST['e_mail']);
    $cell = sanatizeString($_POST['cell']);
    $lic_number = sanatizeString($_POST['lic_num']);

   $stored_password =md5(trim($pass));

    queryMysql("UPDATE members SET user_name='$user_name',"
        . "user_surname='$user_surname',"
        . "pass='$stored_password',"
        . "user_role='$role',"
        . "e_mail='$e_mail',"
        . "cell='$cell',"
        . "lic_num='$lic_number' WHERE user_id='$user_id'");

        header('Location:list_users.php');
        exit;

}
}
?>

<html>
    <body>
    <form method='post' action='user_edit.php'>
    Id: <input type='text' maxlength='16' name='user_id' id='user_id' value="<?php echo $query2['user_id'];?>"><br>
    Name: <input type='text' maxlength='30' name='user_name' id='user_name' value="<?php echo $query2['user_name'];?>"><br>
    Surname: <input type='text' maxlength='30' name='user_surname' id='user_surname' value="<?php echo $query2['user_surname'];?>"><br>
    Password: <input type='text' maxlength='16' name='pass' id='pass' value="<?php echo $query2['pass'];?>"><br>
    Role: <input type='text' maxlength='16' name='role' id='role' value="<?php echo $query2['user_role'];?>"><br>
    E-mail: <input type='text' maxlength='30' name='e_mail' id='e_mail' value="<?php echo $query2['e_mail'];?>"><br>
    Cell: <input type='text' maxlength='16' name='cell' id='cell' value="<?php echo $query2['cell'];?>"><br>
    Lic Num: <input type='text' maxlength='16' name='lic_num' id='lic_num' value="<?php echo $query2['lic_num'];?>"><br>
   <input type="submit" id ="submit" type ="submit" name="submit" value="Update">
    </form>
    </body>
</html>
