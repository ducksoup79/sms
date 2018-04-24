<?php

/*
 * logout.php log out the user and end the session
 *
 */

require_once 'header.php';

if (isset($_SESSION['user']))
{
    destroySession();
    echo "<div> <class='main'>You have been logged out. Please ".
            "<a href='index.php'>click here</a> to return to home.";
                }
                else
                {
                    echo "<div class='main'><br>".
                            "You are not logged in, please log in";
                }

?>

<br><br></div>
</body>
</html>
