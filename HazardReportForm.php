<?php

require_once "header.php";

$user = $_SESSION['user'];

$query = queryMysql("SELECT * FROM members WHERE user_name = '$user'");
$result = mysqli_fetch_array($query);

echo $_SESSION['user'];
?>


<html>
    <head>
        <title>Hazard Reporting Form</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="styles.css" rel="stylesheet">

        <!-- Datepicker section -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>

    $(function() {
    $("#datepicker1").datepicker({dateFormat:"dd/mm/yy"});
    });
</script>
<script>
function custom_alert( message, title ) {
    if ( !title )
        title = 'Alert';

    if ( !message )
        message = 'No Message to Display.';

    $('<div></div>').html( message ).dialog({
        title: title,
        resizable: false,
        modal: true,
        buttons: {
            'Ok': function()  {
                $( this ).dialog( 'close' );
            }
        }
    });
}
</script>

<script type="text/javascript">


function validate_form()
{
    valid = true;

    if ( document.haz_report_form.haz_date.value == "" )
    {
        custom_alert ( "Please select a date." );
        valid = false;
    }
    
    if ( document.haz_report_form.hazard_detail.value == "" )
    {
        custom_alert ( "Please enter some information in the Hazard Detail Box." );
        valid = false;
    }


    return valid;
    
}

</script>
    </head>
    <body>
        <div>
            <section>
                <form name = "haz_report_form" action="HazardReport.php" method="post" onsubmit="return validate_form();">
                <h1 align="center">Hazard Report</h1>

                <p> <!--Should only show for SO
                    <label for="hazard_num" style="width:150">
                        <span>Hazard Number: </span>
                    </label>
                    <input type="text" id="hazard_num" name="hazard_num" style="width:200">
                </p>-->

                <p>
                    <label for="haz_date" style="width:150">
                        <span>Date: </span>
                    </label>
                    <input type="text" id="datepicker1" name="haz_date" style="width:200" >
                </p>

                <p>
                    <label for="aircraft_reg" style="width:150">
                        <span>Aircraft Registration:</span>
                    </label>
                    <input type="text" id="aircraft_reg" name="aircraft_reg" style="width:200">
                </p>

                <p>
                    <label for="aircraft_type" style="width:150">
                        <span>Aircraft Type:</span>
                    </label>
                    <input type="text" id="aircraft_type" name="aircraft_type" style="width:200">
                </p>

                <p>
                    <label for="departure" style="width:150">
                        <span>Departure:</span>
                    </label>
                    <input type="text" id="departure" name="departure" style="width:200">
                </p>

                <p>
                    <label for="arrival" style="width:150">
                        <span>Arrival:</span>
                    </label>
                    <input type="text" id="arrival" name="arrival" style="width:200">
                </p>

                <p>
                    <label for="hazard_detail" style="width:150">
                        <span>Details of Hazard:</span>
                    </label>
                    <textarea name="hazard_detail" cols="100" rows="10"></textarea>
                </p>

                <p>
                    <label for="name" style="width:150">
                        <span>Name of Reporter:</span>
                    </label>
                    <input type="text" id="name" name="name" style="width:200" value="<?php echo $result['user_name'];?>"readonly="readonly">
                </p>

                <p>
                    <label for="tel_number" style="width:150">
                        <span>Contact Number::</span>
                    </label>
                    <input type="text" id="tel_number" name="tel_number" style="width:200" value="<?php echo $result['cell'];?>"readonly="readonly">
                </p>

                <p>
                    <label for="e_mail" style="width:150">
                        <span>E-mail:</span>
                    </label>
                    <input type="text" id="e_mail" name="e_mail" style="width:200" value="<?php echo $result['e_mail'];?>"readonly="readonly">
                </p>

                <p>
                    <label for="lic_number" style="width:150">
                        <span>License Number:</span>
                    </label>
                    <input type="text" id="lic_number" name="lic_number" style="width:200" value="<?php echo $result['lic_num'];?>"readonly="readonly">
                </p>

                <p> <!--
                    <label for="status" style="width:150">
                        <span>Status:</span>
                    </label>
                    <input type="text" id="status" name="status" style="width:200">
                </p> -->

              <p> <input type="submit" value="Submit Report"></p>

            </form>
           </section>
        </div>
    </body>
</html>
