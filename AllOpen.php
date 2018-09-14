<?php
/*
 * This lists all open reports
 */

require_once 'header.php';

$error = "";

if ($_SESSION['role']=='admin')
{
    print "\n<table>\n<tr>\n".
          "\n\t<th><h2>Open Hazards</h2></th>".
          "</tr>";

    $result = queryMysql("SELECT hazard_reports.*, risk_assesment.risk_status"
            . " FROM hazard_reports"
            . " LEFT JOIN risk_assesment ON hazard_reports.hazard_num = risk_assesment.occurence_num WHERE status = 'open'");

    echo "<table border='1'>
<tr>
<th>Hazard Number</th>
<th>Date</th>
<th>Target Date</th>
<th>Aircraft Reg</th>
<th>Reporter</th>
<th>Status</th>
<th>Risk Ass (Status)</th>
<th>Feedback</th>
</tr>";

while($row = mysqli_fetch_array($result))
{

echo "<tr>";
echo "<td>" . $row['hazard_num'] . "</td>";
echo "<td>" . $row['haz_date'] . "</td>";
echo "<td>" . $row['target_date'] . "</td>";
echo "<td>" . $row['aircraft_reg'] . "</td>";
echo "<td>" . $row['name'] . "</td>";
//echo "<td>" . $row['hazard_detail'] . "</td>";
echo "<td bgcolor=".checkStatus([$row['status']]).">" . $row['status'] . "</td>";
echo "<td bgcolor=".checkStatus([$row['risk_status']]).">".$row['risk_status'] . "</td>";
echo "<td bgcolor=".checkStatus([$row['feedback']]).">".$row['feedback'] . "</td>";
echo "<td><a href='checkRiskAss.php?inc_num=".$row['hazard_num']."'>Risk Assesment</a></td>";
echo "<td><a href='HazardReportEdit.php?hazard_num=".$row['hazard_num']."'>Edit</a></td>";
echo "<td><a href='delete_hazard_report.php?haz_num=".$row['hazard_num']."' onclick='return  confirm(\"Are you sure you want to delete this record?\")'>Delete</a></td>";
echo "</tr>";
}
echo "</table>";


}

/*
 * This lists all open occurences
 */

require_once 'header.php';

if ($_SESSION['role']=='admin')
{
    echo "<br><br>";
    print "\n<table>\n<tr>\n".
          "\n\t<th><h2>Open Incidents</h2></th>".
          "</tr><br>";


    $result = queryMysql("SELECT incident_reports.*, risk_assesment.risk_status"
            . " FROM incident_reports"
            . " LEFT JOIN risk_assesment ON incident_reports.inc_num = risk_assesment.occurence_num WHERE status='open'");

    echo "<table border='1'>
<tr>
<th>Incident Number</th>
<th>Date</th>
<th>Target Date</th>
<th>Aircraft Reg</th>
<th>PIC</th>
<th>Status</th>
<th>Risk Ass (Status)</th>
<th>Feedback</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['inc_num'] . "</td>";
echo "<td>" . $row['inc_date'] . "</td>";
echo "<td>" . $row['target_Date']. "</td>";
echo "<td>" . $row['aircraft_reg'] . "</td>";
echo "<td>" . $row['pic'] . "</td>";
//echo "<td>" . $row['event_description'] . "</td>";
echo "<td bgcolor=".checkStatus([$row['status']]).">" . $row['status'] . "</td>";
echo "<td bgcolor=".checkStatus([$row['risk_status']]).">".$row['risk_status'] . "</td>";
echo "<td bgcolor=".checkStatus([$row['feedback']]).">".$row['feedback'] . "</td>";
echo "<td><a href='checkRiskAss.php?inc_num=".$row['inc_num']."'>Risk Assesment</a></td>";
echo "<td><a href='IncidentReportEdit.php?inc_num=".$row['inc_num']."'>Edit</a></td>";
echo "</tr>";
}
echo "</table>";


}
