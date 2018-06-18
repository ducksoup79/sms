<?php
session_start();
require_once 'functions.php';

if(isset($_POST['do_login']))
{

 $email=$_POST['email'];
 $pass=$_POST['password'];
 $passhash =md5($pass);
 $select_data=queryMysql("select * from members where e_mail='$email' and pass='$passhash'");
 if($row=mysqli_fetch_array($select_data))
 {
  $_SESSION['email']=$row['e_mail'];
  $_SESSION['user']=$row['user_name'];
  $_SESSION['role']=$row['user_role'];
  echo "success";
 }
 else
 {
  echo "fail";
 }
 exit();
}
?>
