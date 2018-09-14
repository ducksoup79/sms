
<?php

require_once 'header.php';

$description_query = queryMysql("SELECT * FROM description");

$occurence_num = sanatizeString($_GET['occurence_num']);

?>
<html>
    <head>
        <title>Risk Assesment</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="styles.css" rel="stylesheet">
    </head>
    <body>
        <script language="javascript">
window.onload = function() {
  getValues();
};

function getValues(val){

var numVal1=parseInt(document.getElementById("risk1").value);
var numVal2=parseInt(document.getElementById("risk2").value);
var numVal3=parseInt(document.getElementById("risk3").value);
var numVal4=parseInt(document.getElementById("risk4").value);
var numVal5=parseInt(document.getElementById("hazards").value);

var totalValue = ((numVal1 + numVal2 + numVal3 + numVal4)/numVal5);

document.getElementById("total_risk").value = totalValue;
}
</script>
        <div>
            <section>
                <form action="risk_ass.php" method="POST">
                <h1 align="center">Risk Assesment</h1>

                <p>
                    <label for="occurence_num" style="width:150">
                        <span>Occurence Number: </span>
                    </label>
                    <input type="text" id="occurence_num" name="occurence_num" style="width:200" value="<?php echo $occurence_num ?>">
                </p>

              




                <p>
                    <label for="root_cause" style="width:150">
                        <span>Root Cause: </span>
                    </label>
                    <textarea name="root_cause" cols="100" rows="10" ></textarea>
                </p>

                <p>
                    <label for="defence" style="width:150">
                        <span>Defence: </span>
                    </label>
                    <textarea name="defence" cols="100" rows="10"></textarea>
                </p>

                <p>
                    <label for="defence_req" style="width:150">
                        <span>Defence Required: </span>
                    </label>
                    <textarea name="defence_req" cols="100" rows="10"></textarea>
                </p>

                <p>
                    <label for="action_taken" style="width:150">
                        <span>Action Taken: </span>
                    </label>
                    <textarea name="action_taken" cols="100" rows="10"></textarea>
                </p>

                <p>
                    <label for="status" style="width:150">
                        <span>Status: </span>
                    </label>
                    <input type="checkbox" name="status" value="closed"><br>
               </p>

                 <p> <input id ="submit" type ="submit" name="submit" value="Update Assesment"></p>

            </form>
           </section>
        </div>
    </body>
</html>
