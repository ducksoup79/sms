<?php
/*
 * This lists all users
 */

require_once 'header.php';

$error = "";

if ($_SESSION['role']=='admin')
{
    print "\n<table>\n<tr>\n".
          "\n\t<th><h2>Users</h2></th>".
          "</tr>";

    $result = queryMysql("SELECT * FROM members");

    echo "<table border='1'>
<tr>
<th>Name</th>
<th>Surname</th>
<th>Role</th>
<th>E-Mail</th>
<th>Cell</th>
<th>Lic Number</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['user_name'] . "</td>";
echo "<td>" . $row['user_surname'] . "</td>";
echo "<td>" . $row['user_role'] . "</td>";
echo "<td>" . $row['e_mail'] . "</td>";
echo "<td>" . $row['cell'] . "</td>";
echo "<td>" . $row['lic_num'] . "</td>";
echo "<td><a href='user_edit.php?user_id=".$row['user_id']."'>Edit</a></td>";
echo "<td><a href='user_delete.php?user_id=".$row['user_id']."'>Delete</a></td>";
echo "</tr>";
}
echo "</table>";
echo "<a href='new_user.php'>Add New User</a>";
}
