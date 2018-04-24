<?php

/*
 * This script handles logging into the program
 */

require_once 'header.php';
$error = $user =$pass ="";

if (isset($_POST['user']))
{
    $user = sanatizeString($_POST['user']);
    $pass = sanatizeString($_POST['pass']);
    $password_digest = md5(trim($pass));

    if ($user =="" || $pass =="")
        $error = "Not all fields were entered<br>";
    else
    {
        $result = queryMysql("SELECT user_name,pass FROM members WHERE user_name='$user' AND pass='$password_digest'");
        if ($result->num_rows ==0)
        {
            $error = "<span class='error'>Username/Password invalid"
                    . "</span><br><br>";
        }
        else
        {
            $_SESSION['user'] = $user;
            $_SESSION['pass'] = $pass;

            if ($user == "admin")              //add permission to users, then get it from query
            {
                $_SESSION['auth'] = True;   //different type of permissions can be build in here
            }
            else
            {
                $_SESSION['auth'] = False;
            }
            die("You are now logged in. Please <a href='portal.php"
                    . "?view=$user'>Click Here</a> to continue.<br><br>");
        }
    }

}

echo <<<_END
    <br><br>
    <form method='post' action='login.php'>$error
    <span class='fieldname'>Username </span><input type='text'
        maxlength='16' name='user' value='$user'><br>
    <span class='fieldname'>Password </span><input type='password'
        maxlength='16' name='pass' value='$pass'>
_END;
?>

<br>
<span class='fieldname'>&nbsp;</span>
<input type='submit' value='Login'>
</form><br><br></div>
</body>
</html>
