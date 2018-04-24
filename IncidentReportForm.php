<?php

require_once "header.php";

if (isset($_SESSION['user']))
{
  $user = $_SESSION['user'];
}
else {
  header('Location:logout.php');
  exit;
}


$query = queryMysql("SELECT * FROM members WHERE user_name = '$user'");
$result = mysqli_fetch_array($query);

?>



<html>
    <head>
        <title>Incident Reporting Form</title>
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
    $("#datepicker2").datepicker({dateFormat:"dd/mm/yy"});
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


function validate_form ( )
{
    valid = true;

    if ( document.incident_form.inc_date.value == "" )
    {
        custom_alert ( "Please select a date." );
        valid = false;
    }
    
    if ( document.incident_form.inc_time.value == "" )
    {
        custom_alert ( "Please enter the UTC time of the incident." );
        valid = false;
    }
    
    if ( document.incident_form.location.value == "" )
    {
        custom_alert ( "Please enter location where the incident occured." );
        valid = false;
    }
    
    if ( document.incident_form.aircraft_reg.value == "" )
    {
        custom_alert ( "Please enter a aircraft registration." );
        valid = false;
    }
    
    if ( document.incident_form.aircraft_type.value == "" )
    {
        custom_alert ( "Please select a aircraft type." );
        valid = false;
    }
    
    

    return valid;
}

</script>
    </head>
    <body>
        <div>
            <section>
                <form name="incident_form" action="IncidentReport.php" method="post" onsubmit="return validate_form();" >
                <h1 align="center">Incident Report</h1>

                <p> <!--Should only show for SO -->
                    <!--
                    <label for="inc_num" style="width:150">
                        <span>Incident Number: </span>
                    </label>
                    <input type="text" id="inc_num" name="inc_num" style="width:200">
                </p>-->

                <p>
                    <label for="inc_date" style="width:150">
                        <span>Incident Date: </span>
                    </label>
                    <input type="text" id="datepicker1" name="inc_date" style="width:200">
                </p>

                <p>
                    <label for="inc_time" style="width:150" >
                        <span>Time (UTC) of incident: </span>
                    </label>
                    <input type="text" id="inc_time" name="inc_time" style="width:200">
                </p>

                <p>
                    <label for="duty_time" style="width:150" >
                        <span>Total Duty Time for Day: </span>
                    </label>
                    <input type="text" id="duty_time" name="duty_time" style="width:200">
                </p>

               <p>
                    <label for="flight_time" style="width:150" >
                        <span>Total Flight Time for Day: </span>
                    </label>
                    <input type="text" id="flight_time" name="flight_time" style="width:200">
                </p>

                <p>
                    <label for="location" style="width:150" >
                        <span>Location Where Incident Occurred</span>
                    </label>
                    <input type="text" id="location" name="location" style="width:200">
                </p>

               <p>
                    <label for="aircraft_reg" style="width:150" >
                        <span>Aircraft Registration: </span>
                    </label>
                    <input type="text" id="aircraft_reg" name="aircraft_reg" style="width:200">
                </p>

                <p>
                    <label for="aircraft_type" style="width:150" >
                        <span>Aircraft Type: </span>
                    </label>
                    <input type="text" id="aircraft_type" name="aircraft_type" style="width:200">
                </p>

                <p>
                    <label for="departure" style="width:150" >
                        <span>Departure Airport: </span>
                    </label>
                    <input type="text" id="departure" name="departure" style="width:200">
                </p>

                <p>
                    <label for="destination" style="width:150" >
                        <span>Destination Airport: </span>
                    </label>
                    <input type="text" id="destination" name="destination" style="width:200">
                </p>

                <p>
                    <label for="type_flight" style="width:150" >
                        <span>Type of Flight: </span>
                    </label>
                    <input type="text" id="type_flight" name="type_flight" style="width:200"> (Non-Scheduled-Pax, Test Flight, Freight,ens)

                </p>

                <p>
                    <label for="phase" style="width:150" >
                        <span>Phase of Flight: </span>
                    </label>
                    <input type="text" id="phase" name="phase" style="width:200"> (Taxi, Take-Off, Climb, Cruise, Descent, Approach, Landing)
                </p>

                <fieldset>
                    <legend>Flight Parameters</legend>

                    <p>
                            <label for="airspeed" style="width:150">
                                <span>Airspeed: </span>
                            </label>
                            <input type="text" id="airspeed" name="airspeed" style="width:200">
                    </p>

                    <p>
                            <label for="altitude" style="width:150">
                                <span>Altitude: </span>
                            </label>
                            <input type="text" id="altitude" name="altitude" style="width:200">
                    </p>

                   <p>
                            <label for="heading" style="width:150">
                                <span>Heading: </span>
                            </label>
                            <input type="text" id="heading" name="heading" style="width:200">
                    </p>

                    <p>
                            <label for="flight_rules" style="width:150">
                                <span>Flight Rules: </span>
                            </label>
                            <input type="text" id="flight_rules" name="flight_rules" style="width:200">
                    </p>

                    <p>
                            <label for="flight_conditions" style="width:150">
                                <span>Flight Conditions: </span>
                            </label>
                            <input type="text" id="flight_conditions" name="flight_conditions" style="width:200">
                    </p>

                    <p>
                            <label for="turbulance" style="width:150">
                                <span>Turbulance: </span>
                            </label>
                            <input type="text" id="turbulance" name="turbulance" style="width:200">
                    </p>

                    <p>
                            <label for="winds_gusts" style="width:150">
                                <span>Wind Gusts: </span>
                            </label>
                            <input type="text" id="winds_gusts" name="winds_gusts" style="width:200">
                    </p>

                    <p>
                            <label for="rain" style="width:150">
                                <span>Rain: </span>
                            </label>
                            <input type="text" id="rain" name="rain" style="width:200">
                    </p>

                    <p>
                            <label for="other_info" style="width:150">
                                <span>Other Info: </span>
                            </label>
                            <textarea name="other_info" cols="40" rows="5"></textarea>
                    </p>

                </fieldset>

                <p>
                    <label for="pic" style="width:150">
                        <span>Pilot in Command: </span>
                    </label>
                    <input type="text" id="pic" name="pic" style="width:200">
                </p>

                 <p>
                    <label for="training_captain" style="width:150">
                        <span>Training Captain: </span>
                    </label>
                    <input type="text" id="training_captain" name="training_captain" style="width:200">
                </p>

                <p>
                    <label for="description_mulf_item" style="width:150">
                        <span>Mulfunctioned Item: </span>
                    </label>
                    <input type="text" id="description_mulf_item" name="description_mulf_item" style="width:200"> (fill only if there was an item that failed)
                </p>

               <p>
                    <label for="details_mulf_item" style="width:150">
                        <span>Details of the mulfunctioned item: </span>
                    </label>
                    <textarea name="details_mulf_item" cols="40" rows="5"></textarea> (fill only if there was a failed item)
                </p>

                <p>
                    <label for="event_description" style="width:150">
                        <span>Full event description: </span>
                    </label>
                    <textarea name="event description" cols="100" rows="10"></textarea>
                </p>

                <fieldset>
                    <legend>Details of reporter</legend>

                        <p>
                            <label for="reporter_name" style="width:150">
                                <span>Name of reporter: </span>
                            </label>
                            <input type="text" id="reporter_name" name="reporter_name" style="width:200" value="<?php echo $result['user_name'];?>"readonly="readonly">
                        </p>


                        <p>
                            <label for="lic_number" style="width:150">
                                <span>License Number: </span>
                            </label>
                            <input type="text" id="lic_number" name="lic_number" style="width:200" value="<?php echo $result['lic_num'];?>"readonly="readonly">
                        </p>

                        <p>
                            <label for="contact_number" style="width:150">
                                <span>Contact Number: </span>
                            </label>
                            <input type="text" id="contact_number" name="contact_number" style="width:200" value="<?php echo $result['cell'];?>"readonly="readonly">
                        </p>

                        <p>
                            <label for="e_mail" style="width:150">
                                <span>E-Mail: </span>
                            </label>
                            <input type="text" id="e_mail" name="e_mail" style="width:200" value="<?php echo $result['e_mail'];?>"readonly="readonly">
                        </p>

                        <p>
                            <label for="report_date" style="width:150">
                                <span>Report Date: </span>
                            </label>
                            <input type="text" id="datepicker2" name="report_date" style="width:200">
                        </p>

                </fieldset>


              <!--
                <fieldset> <!-- This should only be shown to the SO and not on the form-->
                    <!--
                    <legend>For Office Use</legend>

                        <p>
                            <label for="closed_date" style="width:150">
                                <span>Closed Date: </span>
                            </label>
                            <input type="text" id="closed_date" name="closed_date" style="width:200">
                        </p>

                        <p>
                            <label for="closed_responsible" style="width:150">
                                <span>Closed by: </span>
                            </label>
                            <input type="text" id="closed_responsible" name="closed_responsible" style="width:200">
                        </p>

                        <p>
                            <label for="status" style="width:150">
                                <span>Status: </span>
                            </label>
                            <input type="text" id="status" name="status" style="width:200">
                        </p> -->

                </fieldset>




                <p> <input type="submit" value="Submit Report"></p>

            </form>
           </section>
        </div>
    </body>
</html>
