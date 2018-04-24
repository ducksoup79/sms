<?php

require_once 'header.php';

if(isset($_POST['email']))
{
    echo "Sending e-mail";
    header("Location:e_mail_monthly_summary.php?month=".sanatizeString($_POST['month'])."&year=".  sanatizeString($_POST['year']));
    exit;
}
else if (isset($_POST['query'])) {

  $month = sanatizeString($_POST['month']);
  $year = sanatizeString($_POST['year']);
  
  $dateObj   = DateTime::createFromFormat('!m', $month);
  $monthName = $dateObj->format('F'); 

  //run the incident query
  $result=  queryMysql("SELECT incident_reports.inc_num,incident_reports.inc_date,incident_reports.event_description,incident_reports.closed_date,risk_assesment.action_taken,risk_assesment.total_risk
                        FROM incident_reports
                        LEFT JOIN risk_assesment
                        ON incident_reports.inc_num = risk_assesment.occurence_num
                        WHERE MONTH(inc_date)='$month'&& YEAR(inc_date)='$year';");

  $num_rows = mysqli_num_rows($result); //count the number of rows returned


  print "\n<table>\n<tr>\n".
        "\n\t<th><h2>Monthly Summary for '$monthName' '$year'</h2></th>".
        "</tr>";

 echo "<table border='1'>
 <tr>
 <th>Report</th>
 <th>Date </th>
 <th>Summary</th>
 <th>Total Risk</th>
 <th>Action Taken</th>
 <th>Date Closed</th>
 </tr>";

 echo "<h3>There were ".$num_rows." incidents reported</h3>";

   while($row = mysqli_fetch_array($result))
{
    echo "<tr>";
    echo "<td>".$row['inc_num']."</td>";
    echo "<td>".$row['inc_date']."</td>";
    echo "<td>".$row['event_description']."</td>";
    echo "<td>".$row['total_risk']."</td>";
    echo "<td>".$row['action_taken']."</td>";
    echo "<td>".$row['closed_date']."</td>";
    echo "</tr>";

}
echo "</table>";


//run the Hazards query
$result2=  queryMysql("SELECT hazard_reports.hazard_num,hazard_reports.haz_date,hazard_reports.hazard_detail,hazard_reports.date_closed,risk_assesment.action_taken,risk_assesment.total_risk
                      FROM hazard_reports
                      LEFT JOIN risk_assesment
                      ON hazard_reports.hazard_num = risk_assesment.occurence_num
                      WHERE MONTH(haz_date)='$month' && YEAR(haz_date)='$year';");

$num_rows2 = mysqli_num_rows($result2); //count the number of rows returned


print"<table>";

echo "<table border='1'>
<tr>
<th>Report</th>
<th>Date </th>
<th>Summary</th>
<th>Total Risk</th>
<th>Action Taken</th>
<th>Date Closed</th>
</tr>";

echo "<h3>There were ".$num_rows2." hazards reported</h3>";

 while($row = mysqli_fetch_array($result2))
{
  echo "<tr>";
  echo "<td>".$row['hazard_num']."</td>";
  echo "<td>".$row['haz_date']."</td>";
  echo "<td>".$row['hazard_detail']."</td>";
  echo "<td>".$row['total_risk']."</td>";
  echo "<td>".$row['action_taken']."</td>";
  echo "<td>".$row['date_closed']."</td>";
  echo "</tr>";

}
echo "</table>";
}
else
{
    echo "There were no action selected";
}
?>

<html>
  <header></header>
  <body>
    <form method="POST" action="monthly_report.php">
      <p>
      <label><h3>Select a month to generate monthly report</h3></label>
      <select name = "month">
        <option value="01">January
        <option value="02">February
        <option value="03">March
        <option value="04">April
        <option value="05">May
        <option value="06">June
        <option value="07">July
        <option value="08">August
        <option value="09">September
        <option value="10">October
        <option value="11">November
        <option value="12">December
      </select>   
        <select name ="year">
        <option value="2011">2011
        <option value="2012">2012
        <option value="2013">2013    
        <option value="2014">2014    
        <option value="2015">2015    
        <option value="2016">2016
        <option value="2017">2017
        <option value="2018">2018
        <option value="2019">2019 
        <option value="2020">2020    
      </p>
    </select>
    <button type="submit" value="Query Report" name="query">Click to query</button>
    <button type="submit" value="E-Mail Report" name="email">Click to e-mail report to post holders</button>
  </form>
  </body>
</html>
