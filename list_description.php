<?php
/*This script edits the descriptions that are drawn from risk assesment and used for statistics
 *
 */
require_once 'header.php';

if ($_SESSION['role']=='admin')
{
    print "\n<table>\n<tr>\n".
          "\n\t<th>Descriptions</th>".
          "</tr>";

    $result = queryMysql("SELECT * FROM description");

    echo "<table border='1'>
<tr>
<th>Description</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['description'] . "</td>";
echo "<td><a href='edit_description.php?desc_id=".$row['desc_id']."'>Edit</a></td>";
echo "<td><a href='delete_description.php?desc_id=".$row['desc_id']."'>Delete</a></td>";
echo "</tr>";
}
echo "</table>";
echo "<a href='add_description_form.php'>Add Description</a>";


}




?>
