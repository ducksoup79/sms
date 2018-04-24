<?php

require_once 'functions.php';

$hazard_num = sanatizeString($_GET['hazard_num']);

echo '<div id="printableArea">';
     

$query=  queryMysql("SELECT * FROM hazard_reports WHERE hazard_num='$hazard_num'");
echo '<h2>Hazard Report '.$hazard_num.'</h2>';
echo '<table>';
while($row = mysqli_fetch_assoc($query)) {
    // Loop over all fields per row
    foreach($row as $field => $value) {
        echo '<tr><td>' . htmlentities($field) . '</td><td>' . htmlentities($value) . '</td></tr>';
    }
    // New data row can optionally be seperated with a blank line here
    echo '<tr><td colspan="2">&nbsp;</td></tr>';
}
echo '</table>';

echo '<p style="page-break-after: always;">&nbsp;</p>'; //creates page break for printing


$query2=  queryMysql("SELECT * FROM risk_assesment WHERE occurence_num='$hazard_num'");
echo '<h2>Risk Assesment for '.$hazard_num.'</h2>';
echo '<table>';

while($row2 = mysqli_fetch_assoc($query2)) {
    // Loop over all fields per row
    foreach($row2 as $field2 => $value2) {
        echo '<tr><td>' . htmlentities($field2) . '</td><td>' . htmlentities($value2) . '</td></tr>';
    }
    // New data row can optionally be seperated with a blank line here
    echo '<tr><td colspan="2">&nbsp;</td></tr>';
}
echo '</table>';

?>

</div>
<input type="button" onclick="printDiv('printableArea')" value="Print Report" />
<script>
    
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}

</script>
