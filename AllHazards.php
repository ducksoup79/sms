<?php

/*
 * View all Hazards
 */
require_once 'header.php';

$error = "";

if ($_SESSION['auth']==True)
{
    print "\n<table>\n<tr>\n".
          "\n\t<th>All Hazards on record</th>".
          "</tr>";

    $result = queryMysql("SELECT * FROM hazard_reports");

    echo "<html><table border='1'>
<tr>
<th>Hazard Number</th>
<th>Date</th>
<th>Aircraft Reg</th>
<th>Reporter</th>
<th>Status</th>
<th>Target Date</th>
<th>Date Closed</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr bgcolor=".checkStatus([$row['status']]).">";
echo "<td>" . $row['hazard_num'] . "</td>";
echo "<td>" . $row['haz_date'] . "</td>";
echo "<td>" . $row['aircraft_reg'] . "</td>";
echo "<td>" . $row['name'] . "</td>";
//echo "<td>" . $row['hazard_detail'] . "</td>";
echo "<td>" . $row['status'] . "</td>";
echo "<td>" . $row['target_date'] . "</td>";
echo "<td>" . $row['date_closed'] . "</td>";
echo "<td><a href='checkRiskAss.php?inc_num=".$row['hazard_num']."'>Risk Assesment</a></td>";
echo "<td><a href='HazardReportEdit.php?hazard_num=".$row['hazard_num']."'>Edit</a></td>";
echo "<td><a href='report_hazard.php?hazard_num=".$row['hazard_num']."'>Report</a></td>";
echo "<td><a href='delete_hazard.php?hazard_num=".$row['hazard_num']."'>Delete</a></td>";
echo "</tr>";
}
echo "</table></html>";


}
