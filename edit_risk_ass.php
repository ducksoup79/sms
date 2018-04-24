<?php

//This code loads an html form and fills it with existing risk assesment data
//You can then edit the data and update it

require_once'header.php';

$occurence_num=$_GET['occurence_num']; 
$query1=  queryMysql("SELECT * FROM risk_assesment WHERE occurence_num='$occurence_num'");
$query2 = mysqli_fetch_array($query1);
$assm_id = $query2['assm_id'];
$description_query = queryMysql("SELECT * FROM description");

if(isset($_POST['submit'])) //if the form is submitted, do the following
{
    //call the update query to save changes in form
    $occurence_num=  sanatizeString($_POST['occurence_num']);
    if(!empty(sanatizeString($_POST['description'])))
    {
        $description=  sanatizeString($_POST['description']);
    }
    else
    {
        $description=$query2['description'];
    }
    if(!empty(sanatizeString($_POST['category'])))
    {
        $category=  sanatizeString($_POST['category']);
    }
    else
    {
        $category=$query2['category'];
    }
    
    $hazards=sanatizeString($_POST['hazards']);
    $hazard1=sanatizeString($_POST['hazard1']);
    $risk1=sanatizeString($_POST['risk1']);
    $hazard2=sanatizeString($_POST['hazard2']);
    $risk2=sanatizeString($_POST['risk2']);
    $hazard3=sanatizeString($_POST['hazard3']);
    $risk3=sanatizeString($_POST['risk3']);
    $hazard4=sanatizeString($_POST['hazard4']);
    $risk4=sanatizeString($_POST['risk4']);
    $total_risk=sanatizeString($_POST['total_risk']);
    $root_cause=nl2br(sanatizeString($_POST['root_cause']));
    $defence=nl2br(sanatizeString($_POST['defence']));
    $defence_req=sanatizeString($_POST['defence_req']);
    $action_taken=sanatizeString($_POST['action_taken']);
    
    if (isset($_POST['risk_status'])){
       $risk_status=sanatizeString($_POST['risk_status']); 
    }
    else{
        $risk_status = 'open';
    }
    
    
              
    queryMysql("UPDATE risk_assesment SET hazards='$hazards',"
        . "description='$description',"
        . "category='$category',"
        . "hazard1='$hazard1',"
        . "risk1='$risk1',"
        . "hazard2='$hazard2',"
        . "risk2='$risk2',"
        . "hazard3='$hazard3',"
        . "risk3='$risk3',"
        . "hazard4='$hazard4',"
        . "risk4='$risk4',"
        . "total_risk='$total_risk',"
        . "root_cause='$root_cause',"
        . "defence='$defence',"
        . "defence_req='$defence_req',"
        . "action_taken='$action_taken',"
        . "risk_status='$risk_status' WHERE assm_id='$assm_id'");
    
   header('Location:AllOpen.php');
   exit;
} 
 

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
                <form action="" method="POST">
                <h1 align="center">Risk Assesment</h1>
                
                <p> 
                    <label for="occurence_num" style="width:150">
                        <span>Occurence Number: </span>
                    </label>
                    <a href="edit_risk_ass.php"></a>
                    <input type="text" id="occurence_num" name="occurence_num" style="width:200" value="<?php echo $query2['occurence_num'];?>">
                </p>
                
                <p> 
                    <label for="description" style="width:150">
                        <span>Description: </span>
                    </label>
                    <?php echo '(',$query2['description'],')'; echo' '?>
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
                     <?php echo '(',$query2['category'],')'; echo' '?>
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
                    <input type="text" id="hazards" name="hazards" style="width:200" size="2" onkeyup="getValues(5)" value="<?php echo $query2['hazards'];?>"> The amount of hazards 1-4
                    
    
                <p> 
                    <label for="hazard1" style="width:150">
                        <span>Hazard 1: </span>
                    </label>
                    <input type="text" id="hazard1" name="hazard1" style="width:200" size="80" value="<?php echo $query2['hazard1'];?>">
                    <input type="text" id="risk1" name="risk1" style="width:20" size="2" onkeyup="getValues(1)" value="<?php echo $query2['risk1'];?>"> Risk
                </p>
    
                <p> 
                    <label for="hazard2" style="width:150">
                        <span>Hazard 2: </span>
                    </label>
                    <input type="text" id="hazard2" name="hazard2" style="width:200" size="80" value="<?php echo $query2['hazard2'];?>" >
                    <input type="text" id="risk2" name="risk2" style="width:20" size="2" onkeyup="getValues(2)" value="<?php echo $query2['risk2'];?>"> Risk
                </p>
    
                <p> 
                    <label for="hazard3" style="width:150">
                        <span>Hazard 3: </span>
                    </label>
                    <input type="text" id="hazard3" name="hazard3" style="width:200" size="80" value="<?php echo $query2['hazard3'];?>">
                    <input type="text" id="risk3" name="risk3" style="width:20" size="2" onkeyup="getValues(3)" value="<?php echo $query2['risk3'];?>"> Risk
                </p>
    
                <p> 
                    <label for="hazard4" style="width:150">
                        <span>Hazard 4: </span>
                    </label>
                    <input type="text" id="hazard4" name="hazard4" style="width:200" size="80" value="<?php echo $query2['hazard4'];?>" >
                    <input type="text" id="risk4" name="risk4" style="width:20" size="2" onkeyup="getValues(4)" value="<?php echo $query2['risk4'];?>"> Risk
                </p>
                
                <p> 
                    <label for="total_risk" style="width:150">
                        <span>Total Risk: </span>
                    </label>
                    <input type="text" id="total_risk" name="total_risk" style="width:200" size="2" value="<?php echo $query2['total_risk'];?>" >
                    
                </p>
    
                <p> 
                    <label for="root_cause" style="width:150">
                        <span>Root Cause: </span>
                    </label>
                    <textarea name="root_cause" cols="100" rows="10" ><?php echo nl2br($query2['root_cause']);?></textarea>
                </p>
    
                <p> 
                    <label for="defence" style="width:150">
                        <span>Defence: </span>
                    </label>
                    <textarea name="defence" cols="100" rows="10"><?php echo $query2['defence'];?></textarea>
                </p>
    
                <p> 
                    <label for="defence_req" style="width:150">
                        <span>Defence Required: </span>
                    </label>
                    <textarea name="defence_req" cols="100" rows="10"><?php echo $query2['defence_req'];?></textarea>
                </p>
    
                <p> 
                    <label for="action_taken" style="width:150">
                        <span>Action Taken: </span>
                    </label>
                    <textarea name="action_taken" cols="100" rows="10"><?php echo $query2['action_taken'];?></textarea>
                </p>
                
                <p> 
                    <label for="status" style="width:150">
                        <span>Status: </span>
                    </label>
                    <input type="checkbox" name="risk_status" value="closed" <?php echo ($query2['risk_status']=='closed' ? 'checked':'');?>> (Select to close)<br>
               </p>
                                                              
                 <p> <input id ="submit" type ="submit" name="submit" value="Update Assesment"></p>
           
            </form>
           </section> 
        </div>
    </body>
</html>



 
