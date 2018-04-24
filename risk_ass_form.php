
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
                    <label for="description" style="width:150">
                        <span>Description: </span>
                    </label>
                    <?php
                        echo ' <select name="description">';
                        while($row=mysqli_fetch_array($description_query))
                            {
                             echo '<option value="' . ($row['description']) . '">'
                                                    . ($row['description'])
                                                    . '</option>';
                            }
                    echo '</select>';
                    ?>

                </p>

                <p>
                    <label for="category" style="width:150">
                        <span>Category: </span>
                    </label>
                        <select name="category">
                        <option value=""></option>
                        <option value="MAN">Man</option>
                        <option value="MACHINE">Machine</option>
                        <option value="MEDIUM">Medium</option>
                        <option value="MANAGMENT">Management</option>
                        <option value="MONEY">Money</option>
                     </select>

                </p>

                <p>
                    <label for="hazards" style="width:150">
                        <span>Hazards: </span>
                    </label>
                    <input type="text" id="hazards" name="hazards" style="width:200" size="2" onkeyup="getValues(5)"> The amount of hazards 1-4


                <p>
                    <label for="hazard1" style="width:150">
                        <span>Hazard 1: </span>
                    </label>
                    <input type="text" id="hazard1" name="hazard1" style="width:200" size="80" >
                    <input type="text" id="risk1" name="risk1" style="width:20" value="0" size="2" onkeyup="getValues(1)"> Risk
                </p>

                <p>
                    <label for="hazard2" style="width:150">
                        <span>Hazard 2: </span>
                    </label>
                    <input type="text" id="hazard2" name="hazard2" style="width:200" size="80">
                    <input type="text" id="risk2" name="risk2" style="width:20" value="0" size="2" onkeyup="getValues(2)"> Risk
                </p>

                <p>
                    <label for="hazard3" style="width:150">
                        <span>Hazard 3: </span>
                    </label>
                    <input type="text" id="hazard3" name="hazard3" style="width:200" size="80">
                    <input type="text" id="risk3" name="risk3" style="width:20" value="0" size="2" onkeyup="getValues(3)"> Risk
                </p>

                <p>
                    <label for="hazard4" style="width:150">
                        <span>Hazard 4: </span>
                    </label>
                    <input type="text" id="hazard4" name="hazard4" style="width:200" size="80">
                    <input type="text" id="risk4" name="risk4" style="width:20" value="0" size="2" onkeyup="getValues(4)"> Risk
                </p>

                <p>
                    <label for="total_risk" style="width:150">
                        <span>Total Risk: </span>
                    </label>
                    <input type="text" id="total_risk" name="total_risk" style="width:200" size="2">

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
