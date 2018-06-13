<?php
require_once'header.php';

$error = "";

$inc_num=$_GET['inc_num'];
$query1=  queryMysql("SELECT * FROM incident_reports WHERE inc_num='$inc_num'");
$query2 = mysqli_fetch_array($query1);
$inc_id = $query2['inc_id'];

//get risk assesment status
$query3=  queryMysql("SELECT * FROM risk_assesment WHERE occurence_num='$inc_num'");
$query4 = mysqli_fetch_array($query3);
$ass_status = $query4['risk_status'];


if(isset($_POST['submit'])) //if the form is submitted, do the following
{
    //call the update query to save changes in form

    //check if risk_assesment were closed, before closing incident

    $inc_num=sanatizeString($_POST['inc_num']);
    $inc_date=date_to_mysql(sanatizeString($_POST['inc_date']));
    $inc_time=sanatizeString($_POST['inc_time']);
    $duty_time=sanatizeString($_POST['duty_time']);
    $flight_time=sanatizeString($_POST['flight_time']);
    $location=sanatizeString($_POST['location']);
    $aircraft_reg=sanatizeString($_POST['aircraft_reg']);
    $aircraft_type=sanatizeString($_POST['aircraft_type']);
    $departure=sanatizeString($_POST['departure']);
    $destination=sanatizeString($_POST['destination']);
    $type_flight=sanatizeString($_POST['type_flight']);
    $phase=sanatizeString($_POST['phase']);
    $airspeed=sanatizeString($_POST['airspeed']);
    $altitude=sanatizeString($_POST['altitude']);
    $heading=sanatizeString($_POST['heading']);
    $flight_rules=sanatizeString($_POST['flight_rules']);
    $flight_conditions=sanatizeString($_POST['flight_conditions']);
    $turbulance=sanatizeString($_POST['turbulance']);
    $winds_gusts=sanatizeString($_POST['winds_gusts']);
    $rain=sanatizeString($_POST['rain']);
    $other_info=sanatizeString($_POST['other_info']);
    $pic=sanatizeString($_POST['pic']);
    $training_captain=sanatizeString($_POST['training_captain']);
    $description_mulf_item=sanatizeString($_POST['description_mulf_item']);
    $details_mulf_item=sanatizeString($_POST['details_mulf_item']);
    $event_description=sanatizeString($_POST['event_description']);
    $name=sanatizeString($_POST['name']);
    $lic_number=sanatizeString($_POST['lic_number']);
    $contact_number=sanatizeString($_POST['contact_number']);
    $e_mail=sanatizeString($_POST['e_mail']);
    $report_date=date_to_mysql(sanatizeString($_POST['report_date']));
    $target_date=date_to_mysql(sanatizeString($_POST['target_date']));
    $closed_date=date_to_mysql(sanatizeString($_POST['closed_date']));
    $closed_responsible=sanatizeString($_POST['closed_responsible']);
    $status = $_POST['status'];
    $feedback = $_POST['feedback'];

    //check if risk assesment was closed, before closing incident
    if($ass_status=='closed' && $feedback=='send' && $status=='closed'){
        $status='closed';
    }

    else {
        $status='open';
    }

    if($feedback=='send'){
        $feedback=  'send';
    }

    else{
        $feedback='pending';
    }


   queryMysql("UPDATE incident_reports SET inc_num='$inc_num',"
        . "inc_date='$inc_date',"
        . "inc_time='$inc_time',"
        . "duty_time='$duty_time',"
        . "flight_time='$flight_time',"
        . "location='$location',"
        . "aircraft_reg='$aircraft_reg',"
        . "aircraft_type='$aircraft_type',"
        . "departure='$departure',"
        . "destination='$destination',"
        . "type_flight='$type_flight',"
        . "phase='$phase',"
        . "airspeed='$airspeed',"
        . "altitude='$altitude',"
        . "heading='$heading',"
        . "flight_rules='$flight_rules',"
        . "flight_conditions='$flight_conditions',"
        . "turbulance='$turbulance',"
        . "winds_gusts='$winds_gusts',"
        . "rain='$rain',"
        . "other_info='$other_info',"
        . "pic='$pic',"
        . "training_captain='$training_captain',"
        . "description_mulf_item='$description_mulf_item',"
        . "details_mulf_item='$details_mulf_item',"
        . "event_description='$event_description',"
        . "name='$name',"
        . "lic_number='$lic_number',"
        . "contact_number='$contact_number',"
        . "e_mail='$e_mail',"
        . "report_date='$report_date',"
      	. "target_Date='$target_date',"
        . "closed_date='$closed_date',"
        . "closed_responsible='$closed_responsible',"
        . "status='$status',"
        . "feedback='$feedback' WHERE inc_id='$inc_id'");


    exit(header("Location:AllOpen.php"));


}


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
    $("#datepicker3").datepicker({dateFormat:"dd/mm/yy"});
    $("#datepicker4").datepicker({dateFormat:"dd/mm/yy"});
});
</script>
    </head>
    <body>
        <div>
            <section>
                <form action="" method="post">
                <h1 align="center">Incident Report</h1>

                <p> <!--Should only show for SO -->
                    <label for="inc_num" style="width:150">
                        <span>Incident Number: </span>
                    </label>
                    <input type="text" id="inc_num" name="inc_num" style="width:200" value="<?php echo $query2['inc_num'];?>">
                </p>

                <p>
                    <label for="inc_date" style="width:150">
                        <span>Incident Date: </span>
                    </label>
                    <input type="text" id="datepicker1" name="inc_date" style="width:200" value="<?php echo $query2['inc_date'];?>">
                </p>

                <p>
                    <label for="inc_time" style="width:150" >
                        <span>Time (UTC) of incident: </span>
                    </label>
                    <input type="text" id="inc_time" name="inc_time" style="width:200" value="<?php echo $query2['inc_time'];?>">
                </p>

                <p>
                    <label for="duty_time" style="width:150" >
                        <span>Total Duty Time for Day: </span>
                    </label>
                    <input type="text" id="duty_time" name="duty_time" style="width:200" value="<?php echo $query2['duty_time'];?>">
                </p>

               <p>
                    <label for="flight_time" style="width:150" >
                        <span>Total Flight Time for Day: </span>
                    </label>
                    <input type="text" id="flight_time" name="flight_time" style="width:200" value="<?php echo $query2['flight_time'];?>">
                </p>

                <p>
                    <label for="location" style="width:150" >
                        <span>Location Where Incident Occurred</span>
                    </label>
                    <input type="text" id="location" name="location" style="width:200" value="<?php echo $query2['location'];?>">
                </p>

               <p>
                    <label for="aircraft_reg" style="width:150" >
                        <span>Aircraft Registration: </span>
                    </label>
                    <input type="text" id="aircraft_reg" name="aircraft_reg" style="width:200" value="<?php echo $query2['aircraft_reg'];?>">
                </p>

                <p>
                    <label for="aircraft_type" style="width:150" >
                        <span>Aircraft Type: </span>
                    </label>
                    <input type="text" id="aircraft_type" name="aircraft_type" style="width:200" value="<?php echo $query2['aircraft_type'];?>">
                </p>

                <p>
                    <label for="departure" style="width:150" >
                        <span>Departure Airport: </span>
                    </label>
                    <input type="text" id="departure" name="departure" style="width:200" value="<?php echo $query2['departure'];?>">
                </p>

                <p>
                    <label for="destination" style="width:150" >
                        <span>Destination Airport: </span>
                    </label>
                    <input type="text" id="destination" name="destination" style="width:200" value="<?php echo $query2['destination'];?>">
                </p>

                <p>
                    <label for="type_flight" style="width:150" >
                        <span>Type of Flight: </span>
                    </label>
                    <input type="text" id="type_flight" name="type_flight" style="width:200" value="<?php echo $query2['type_flight'];?>">
                </p>

                <p>
                    <label for="phase" style="width:150" >
                        <span>Phase of Flight: </span>
                    </label>
                    <input type="text" id="phase" name="phase" style="width:200" value="<?php echo $query2['phase'];?>">
                </p>

                <fieldset>
                    <legend>Flight Parameters</legend>

                    <p>
                            <label for="airspeed" style="width:150">
                                <span>Airspeed: </span>
                            </label>
                            <input type="text" id="airspeed" name="airspeed" style="width:200" value="<?php echo $query2['airspeed'];?>">
                    </p>

                    <p>
                            <label for="altitude" style="width:150">
                                <span>Altitude: </span>
                            </label>
                            <input type="text" id="altitude" name="altitude" style="width:200" value="<?php echo $query2['altitude'];?>">
                    </p>

                   <p>
                            <label for="heading" style="width:150">
                                <span>Heading: </span>
                            </label>
                            <input type="text" id="heading" name="heading" style="width:200" value="<?php echo $query2['heading'];?>">
                    </p>

                    <p>
                            <label for="flight_rules" style="width:150">
                                <span>Flight Rules: </span>
                            </label>
                            <input type="text" id="flight_rules" name="flight_rules" style="width:200" value="<?php echo $query2['flight_rules'];?>">
                    </p>

                    <p>
                            <label for="flight_conditions" style="width:150">
                                <span>Flight Conditions: </span>
                            </label>
                            <input type="text" id="flight_conditions" name="flight_conditions" style="width:200" value="<?php echo $query2['flight_conditions'];?>">
                    </p>

                    <p>
                            <label for="turbulance" style="width:150">
                                <span>Turbulance: </span>
                            </label>
                            <input type="text" id="turbulance" name="turbulance" style="width:200" value="<?php echo $query2['turbulance'];?>">
                    </p>

                    <p>
                            <label for="winds_gusts" style="width:150">
                                <span>Wind Gusts: </span>
                            </label>
                            <input type="text" id="winds_gusts" name="winds_gusts" style="width:200" value="<?php echo $query2['winds_gusts'];?>">
                    </p>

                    <p>
                            <label for="rain" style="width:150">
                                <span>Rain: </span>
                            </label>
                            <input type="text" id="rain" name="rain" style="width:200" value="<?php echo $query2['rain'];?>">
                    </p>

                    <p>
                            <label for="other_info" style="width:150">
                                <span>Other Info: </span>
                            </label>
                            <textarea name="other_info" cols="40" rows="5"><?php echo $query2['other_info'];?></textarea>
                    </p>

                </fieldset>

                <p>
                    <label for="pic" style="width:150">
                        <span>Pilot in Command: </span>
                    </label>
                    <input type="text" id="pic" name="pic" style="width:200" value="<?php echo $query2['pic'];?>">
                </p>

                 <p>
                    <label for="training_captain" style="width:150">
                        <span>Training Captain: </span>
                    </label>
                    <input type="text" id="training_captain" name="training_captain" style="width:200" value="<?php echo $query2['training_captain'];?>">
                </p>

                <p>
                    <label for="description_mulf_item" style="width:150">
                        <span>Mulfunctioned Item: </span>
                    </label>
                    <input type="text" id="description_mulf_item" name="description_mulf_item" style="width:200" value="<?php echo $query2['description_mulf_item'];?>">
                </p>

               <p>
                    <label for="details_mulf_item" style="width:150">
                        <span>Details of the mulfunctioned item: </span>
                    </label>
                    <textarea name="details_mulf_item" cols="40" rows="5"><?php echo $query2['details_mulf_item'];?></textarea>
                </p>

                <p>
                    <label for="event_description" style="width:150">
                        <span>Full event description: </span>
                    </label>
                    <textarea name="event_description" cols="100" rows="10"><?php echo $query2['event_description'];?></textarea>
                </p>

                <fieldset>
                    <legend>Details of reporter</legend>

                        <p>
                            <label for="name" style="width:150">
                                <span>Name of reporter: </span>
                            </label>
                            <input type="text" id="name" name="name" style="width:200" value="<?php echo $query2['name'];?>">
                        </p>


                        <p>
                            <label for="lic_number" style="width:150">
                                <span>License Number: </span>
                            </label>
                            <input type="text" id="lic_number" name="lic_number" style="width:200" value="<?php echo $query2['lic_number'];?>">
                        </p>

                        <p>
                            <label for="contact_number" style="width:150">
                                <span>Contact Number: </span>
                            </label>
                            <input type="text" id="contact_number" name="contact_number" style="width:200" value="<?php echo $query2['contact_number'];?>">
                        </p>

                        <p>
                            <label for="e_mail" style="width:150">
                                <span>E-Mail: </span>
                            </label>
                            <input type="text" id="e_mail" name="e_mail" style="width:200" value="<?php echo $query2['e_mail'];?>">
                        </p>

                        <p>
                            <label for="report_date" style="width:150">
                                <span>Report Date: </span>
                            </label>
                            <input type="text" id="datepicker2" name="report_date" style="width:200" value="<?php echo $query2['report_date'];?>">
                        </p>

                </fieldset>

                <fieldset> <!-- This should only be shown to the SO and not on the form-->
                    <legend>For Office Use</legend>

                         <p>
                            <label for="closed_date" style="width:150">
                                <span>Closed Date: </span>
                            </label>
                            <input type="text" id="datepicker3" name="closed_date" style="width:200" value="<?php echo $query2['closed_date'];?>">
                        </p>

	  		<p>
                            <label for="target_date" style="width:150">
                                <span>Target Date: </span>
                            </label>
                            <input type="text" id="datepicker4" name="target_date" style="width:200" value="<?php echo $query2['target_Date'];?>">
                        </p>

                        <p>
                            <label for="closed_responsible" style="width:150">
                                <span>Closed by: </span>
                            </label>
                            <input type="text" id="closed_responsible" name="closed_responsible" style="width:200" value="<?php echo $query2['closed_responsible'];?>">
                        </p>

                       <p>
                          <label for="status" style="width:150">
                              <span>Status: </span>
                          </label>
                          <input type="checkbox" id="status" value="closed" name="status" <?php if($query2['status']=='closed') echo 'checked="checked"';?>><br>
                      </p>

                      <p>
                          <label for="feedback" style="width:150">
                              <span>Feedback: </span>
                          </label>
                          <input type="checkbox" id="feedback" value="send" name="feedback" <?php if($query2['feedback']=='send') echo 'checked="checked"';?>><br>
                     </p>



                </fieldset>



                <p> <input id ="submit" type ="submit" name="submit" value="Update Report"></p>

            </form>
           </section>
        </div>
    </body>
</html>
