<?php

/*
 * View all Occurences
 */

require_once 'header.php';

if ($_SESSION['role']=='admin')
{
    print "\n<table>\n<tr>\n".
          "\n\t<th>Incidents on Record</th>".
          "</tr>";

    $result = queryMysql("SELECT * FROM incident_reports");

    echo "<table border='1'>
<tr>
<th>Incident Number</th>
<th>Date</th>
<th>Aircraft Reg</th>
<th>PIC</th>
<th>Status</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr bgcolor=".checkStatus([$row['status']]).">";
echo "<td>" . $row['inc_num'] . "</td>";
echo "<td>" . $row['inc_date'] . "</td>";
echo "<td>" . $row['aircraft_reg'] . "</td>";
echo "<td>" . $row['pic'] . "</td>";
//echo "<td>" . $row['event_description'] . "</td>";
echo "<td>" . $row['status'] . "</td>";
echo "<td><a href='checkRiskAss.php?inc_num=".$row['inc_num']."'>Risk Assesment</a></td>";
echo "<td><a href='IncidentReportEdit.php?inc_num=".$row['inc_num']."'>Edit</a></td>";
echo "<td><a href='report_incident.php?inc_num=".$row['inc_num']."'>Report</a></td>";
echo "<td><a href='delete_incident.php?inc_num=".$row['inc_num']."'>Delete</a></td>";

echo "</tr>";
}
echo "</table>";


}
