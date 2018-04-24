<?php

require_once 'header.php';

 
  $month = sanatizeString($_GET['month']);
  $year = sanatizeString($_GET['year']);
  
  $dateObj   = DateTime::createFromFormat('!m', $month);
  $monthName = $dateObj->format('F'); 

  //run the incident query
  $result=  queryMysql("SELECT incident_reports.inc_num,incident_reports.inc_date,incident_reports.event_description,incident_reports.closed_date,risk_assesment.action_taken,risk_assesment.total_risk
                        FROM incident_reports
                        LEFT JOIN risk_assesment
                        ON incident_reports.inc_num = risk_assesment.occurence_num
                        WHERE MONTH(inc_date)='$month' && YEAR(inc_date)='$year';");

  $num_rows = mysqli_num_rows($result); //count the number of rows returned

$message = '<html><body><p> Here follows the monthly summary for '.$monthName.' '.$year.'

 <h4>Incidents:</h4>
 <p>There were '.$num_rows.' incidents reported:</p>
 <table border="1" style="font-size:12px" >
 <tr>
 <th>Report</th>
 <th>Date </th>
 <th>Summary</th>
 <th>Total Risk</th>
 <th>Action Taken</th>
 <th>Date Closed</th>
 </tr>";';

 
   while($row = mysqli_fetch_array($result))
{
    $message .="<tr>";
    $message .="<td>".$row['inc_num']."</td>";
    $message .="<td>".$row['inc_date']."</td>";
    $message .="<td>".$row['event_description']."</td>";
    $message .="<td>".$row['total_risk']."</td>";
    $message .="<td>".$row['action_taken']."</td>";
    $message .="<td>".$row['closed_date']."</td>";
    $message .="</tr>";

}
$message .='</table>';

//run the Hazards query
$result2=  queryMysql("SELECT hazard_reports.hazard_num,hazard_reports.haz_date,hazard_reports.hazard_detail,hazard_reports.date_closed,risk_assesment.action_taken,risk_assesment.total_risk
                      FROM hazard_reports
                      LEFT JOIN risk_assesment
                      ON hazard_reports.hazard_num = risk_assesment.occurence_num
                      WHERE MONTH(haz_date)='$month' && YEAR(haz_date)='$year';");

$num_rows2 = mysqli_num_rows($result2); //count the number of rows returned

$message .='

<h4>Hazards:</h4>

<p>There were '.$num_rows2.' hazards reported:</p>
<table border="1" style="font-size:12px">
<tr>
<th>Report</th>
<th>Date </th>
<th>Summary</th>
<th>Total Risk</th>
<th>Action Taken</th>
<th>Date Closed</th>
</tr>"';

 while($row = mysqli_fetch_array($result2))
{
  $message .="<tr>";
  $message .="<td>".$row['hazard_num']."</td>";
  $message .="<td>".$row['haz_date']."</td>";
  $message .="<td>".$row['hazard_detail']."</td>";
  $message .="<td>".$row['total_risk']."</td>";
  $message .="<td>".$row['action_taken']."</td>";
  $message .="<td>".$row['date_closed']."</td>";
  $message .="</tr>";

}

$message .=" 
        </table><br>
        
        Regards<br>
    
        Safety Manager 
        
</font size></p></body></html>";

my_mail("so@safariair.co.bw","Monthly Safety Report", $message);

