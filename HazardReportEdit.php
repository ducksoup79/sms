<?php

//This code loads an html form and fills it with existing hazard report data
//You can then edit the data and update it

require_once'header.php';

$error = "";

$hazard_num=$_GET['hazard_num'];
$query1=  queryMysql("SELECT * FROM hazard_reports WHERE hazard_num='$hazard_num'");
$query2 = mysqli_fetch_array($query1);
$hazreport_id = $query2['hazreport_id'];

//get risk assesment status
$query3=  queryMysql("SELECT * FROM risk_assesment WHERE occurence_num='$hazard_num'");
$query4 = mysqli_fetch_array($query3);
$ass_status = $query4['risk_status'];


if(isset($_POST['submit'])) //if the form is submitted, do the following
{
$hazard_num = sanatizeString($_POST["hazard_num"]);
$haz_date = date_to_mysql(sanatizeString($_POST["haz_date"]));
$aircraft_reg = sanatizeString($_POST["aircraft_reg"]);
$aircraft_type = sanatizeString($_POST["aircraft_type"]);
$departure = sanatizeString($_POST["departure"]);
$arrival = sanatizeString($_POST["arrival"]);
$hazard_detail = sanatizeString($_POST["hazard_detail"]);
$name = sanatizeString($_POST["name"]);
$tel_number = sanatizeString($_POST["tel_number"]);
$e_mail = sanatizeString($_POST["e_mail"]);
$lic_number = sanatizeString($_POST["lic_number"]);
$feedback=  sanatizeString($_POST['feedback']);

//check if risk assesment was closed, before closing incident
    if($ass_status=='closed' && $feedback=='send'){
        $status=sanatizeString($_POST['status']);
    }

    else {
        $status='open';
    }
    
 //check if feedback has been checked
    if($feedback=='send' && $ass_status=='closed'){
        $feedback=sanatizeString($_POST['feedback']);
        //send email with feedback to reporter
    }
    
    else{
        $feedback='pending';
    }


$target_date= date_to_mysql(sanatizeString($_POST["target_date"]));
$date_closed = date_to_mysql(sanatizeString($_POST["date_closed"]));
$person_responsible = sanatizeString($_POST["person_responsible"]);


queryMysql("UPDATE hazard_reports SET hazard_num='$hazard_num',"
        . "haz_date='$haz_date',"
        . "aircraft_reg='$aircraft_reg',"
        . "aircraft_type='$aircraft_type',"
        . "departure='$departure',"
        . "arrival='$arrival',"
        . "hazard_detail='$hazard_detail',"
        . "name='$name',"
        . "tel_number='$tel_number',"
        . "e_mail='$e_mail',"
        . "lic_number='$lic_number',"
        . "status='$status',"
        . "target_date='$target_date',"
        . "date_closed='$date_closed',"
        . "person_responsible='$person_responsible',"
        . "feedback='$feedback' WHERE hazreport_id='$hazreport_id'");

   header('Location:AllOpen.php');
   exit;
}
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
    $("#datepicker2").datepicker({dateFormat:"dd/mm/yy"});
    $("#datepicker3").datepicker({dateFormat:"dd/mm/yy"});
});
</script>

    </head>
    <body>
        <div>
            <section>
                <form action="" method="post">
                <h1 align="center">Edit Hazard Report</h1>

                <p> <!--Should only show for SO -->
                    <label for="hazard_num" style="width:150">
                        <span>Hazard Number: </span>
                    </label>
                    <input type="text" id="hazard_num" name="hazard_num" style="width:200" value="<?php echo $query2['hazard_num'];?>">
                </p>

                <p>
                    <label for="haz_date" style="width:150">
                        <span>Date: </span>
                    </label>
                    <input type="text" id="datepicker1" name="haz_date" style="width:200" value="<?php echo $query2['haz_date'];?>">
                </p>

                <p>
                    <label for="aircraft_reg" style="width:150">
                        <span>Aircraft Registration:</span>
                    </label>
                    <input type="text" id="aircraft_reg" name="aircraft_reg" style="width:200" value="<?php echo $query2['aircraft_reg'];?>">
                </p>

                <p>
                    <label for="aircraft_type" style="width:150">
                        <span>Aircraft Type:</span>
                    </label>
                    <input type="text" id="aircraft_type" name="aircraft_type" style="width:200" value="<?php echo $query2['aircraft_type'];?>">
                </p>

                <p>
                    <label for="departure" style="width:150">
                        <span>Departure:</span>
                    </label>
                    <input type="text" id="departure" name="departure" style="width:200" value="<?php echo $query2['departure'];?>">
                </p>

                <p>
                    <label for="arrival" style="width:150">
                        <span>Arrival:</span>
                    </label>
                    <input type="text" id="arrival" name="arrival" style="width:200" value="<?php echo $query2['arrival'];?>">
                </p>

                <p>
                    <label for="hazard_detail" style="width:150">
                        <span>Details of Hazard:</span>
                    </label>
                    <textarea name="hazard_detail" cols="100" rows="10"><?php echo $query2['hazard_detail'];?></textarea>
                </p>

                <p>
                    <label for="name" style="width:150">
                        <span>Name of Reporter:</span>
                    </label>
                    <input type="text" id="name" name="name" style="width:200" value="<?php echo $query2['name'];?>">
                </p>

                <p>
                    <label for="tel_number" style="width:150">
                        <span>Contact Number::</span>
                    </label>
                    <input type="text" id="tel_number" name="tel_number" style="width:200" value="<?php echo $query2['tel_number'];?>">
                </p>

                <p>
                    <label for="e_mail" style="width:150">
                        <span>E-mail:</span>
                    </label>
                    <input type="text" id="e_mail" name="e_mail" style="width:200" value="<?php echo $query2['e_mail'];?>" >
                </p>

                <p>
                    <label for="lic_number" style="width:150">
                        <span>License Number:</span>
                    </label>
                    <input type="text" id="lic_number" name="lic_number" style="width:200" value="<?php echo $query2['lic_number'];?>">
                </p>

                <p>
                    <label for="status" style="width:150">
                        <span>Status: </span>
                    </label>
                    <input type="checkbox" name="status" value="closed" <?php echo ($query2['status']=='closed' ? 'checked':'');?>><br>
                </p>
                
                <p>
                    <label for="feedback" style="width:150">
                        <span>Feedback: </span>
                    </label>
                    <input type="checkbox" name="feedback" value="send" <?php echo ($query2['feedback']=='send' ? 'checked':'');?>><br>
                </p>

                <p>
                    <label for="target_date" style="width:150">
                        <span>Target Date: </span>
                    </label>
                    <input type="text" id = "datepicker2" name="target_date" value="<?php echo $query2['target_date'];?>"<br>
                </p>
                                    
                <p>
                    <label for="date_closed" style="width:150">
                        <span>Date Closed:</span>
                    </label>
                    <input type="text" id="datepicker3" name="date_closed" style="width:200" value="<?php echo $query2['date_closed'];?>">
                </p>

                <p>
                    <label for="person_responsible" style="width:150">
                        <span>Person Responsible:</span>
                    </label>
                    <input type="text" id="person_responsible" name="person_responsible" style="width:200" value="<?php echo $query2['person_responsible'];?>">
                </p>

              <p> <input id ="submit" type ="submit" name="submit" value="Update Report"></p>

            </form>
           </section>
        </div>
    </body>
</html>
