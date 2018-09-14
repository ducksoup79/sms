<?php

//This code loads an html form and fills it with existing risk assesment data
//You can then edit the data and update it

require_once'functions.php';

$occurence_num=$_GET['occurence_num'];
//Get the data for the risk assesment to fill in form for editing
$query1=  queryMysql("SELECT * FROM risk_assesment WHERE occurence_num='$occurence_num'");
$query2 = mysqli_fetch_array($query1);
$assm_id = $query2['assm_id'];
$description_query = queryMysql("SELECT * FROM description"); //get all description data to fill selector

//TODO: Fix all of this to only incorparate the risk assesment
// Take out hazards, since this would be listed externally
//Also fix up database to reflect the correct values.

if(isset($_POST['submit'])) //if the form is submitted, do the following
{
    //call the update query to save changes in form

    $occurence_num=  sanatizeString($_GET['occurence_num']);



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


//Load all the forms details into the database
//TODO: This needs to be updated to reflect the new forms

    queryMysql("UPDATE risk_assesment SET root_cause='$root_cause',"

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
          <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
          <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
          <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
          <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
          <script src="edit_hazard.js"></script>
     </head>
    <body>

      <!---Load add_description_form into description edit placeholder -->
      <script>
          $(function(){
            $("#description_edit").load("add_description_form.php");
          });
      </script>

      <!-- Show description edit form when new button is pressed-->
      <script>
      $("#new_description").click(function(){
          $("#description_edit").show();
      });
      </script>

<!-- Spinner for likelihood and severity -->
<script>
$( function() {
    var spinner = $( ".spinner" ).spinner();
    $( "button" ).button();
  } );
</script>

<script>
  <!--sums the severity and liklihood to get a total risk-->
    function sum()
    {
       var fn, ln, result;
       fn = parseInt(document.getElementById("likelihood").value, 10);
       ln = parseInt(document.getElementById("severity").value, 10);
       result =  (fn+ln);
       document.getElementById("risk").innerHTML = result;
    }

    function sum2()
    {
       var fn, ln, result;
       fn = parseInt(document.getElementById("mit-likelihood").value, 10);
       ln = parseInt(document.getElementById("mit-severity").value, 10);
       result =  (fn+ln);
       document.getElementById("mit-risk").innerHTML = result;
    }
</script>



<script>
  $(function(){
      $('body').on('click', '#createHazardButton', function(event){
          event.preventDefault();

        var risk_ass_id = '<?php echo $assm_id ?>';
        var category = $('select#category option:checked').val();
        var description = $('select#main-description option:checked').val();
        var likelihood = $('#likelihood').val();
        var severity = $('#severity').val();
        var risk = $('#risk').html();
        var mitigation = $('#mitigation').val();
        var mit_likelihood = $('#mit-likelihood').val();
        var mit_severity = $('#mit-severity').val();
        var mit_risk = $('#mit-risk').html();
        var monitor = $('input[type=checkbox][name=monitor]:checked').val();
        var active = $('input[type=checkbox][name=active]:checked').val();


  	    $.ajax({
      		type: 'POST',
      		url: 'create_hazard.php',
      		data: { risk_ass_id :risk_ass_id,
                  category: category,
                  description: description,
                  likelihood: likelihood,
                  severity: severity,
                  risk: risk,
                  mitigation: mitigation,
                  mit_likelihood:mit_likelihood,
                  mit_severity: mit_severity,
                  mit_risk: mit_risk,
                  monitor: monitor,
                  active: active},
      		success: function(response) {
      		    $('#result').html(response);
              $(".create-hazard").hide();
              location.reload();


      		}
      });
      });
  });
</script>

        <div>
            <section>
                <form action="" method="POST">
                <h1 align="center">Risk Assesment</h1>
                    <div id="result"></div>


                <p>
                    <label for="occurence_num" style="width:150">
                        <span>Occurence Number: </span>
                    </label>
                    <a href="edit_risk_ass.php"></a>
                    <input type="text" id="occurence_num" name="occurence_num" style="width:200" value="<?php echo $query2['occurence_num'];?>">
                </p>


                  <div class="hazards">
                 <!--Change into tabulator or datatable so that  -->
                 <div id="output">
                   <table>
                     <thead>
                       <th>ID</th>
                       <th>Category</th>
                       <th>Description</th>
                       <th>Likelihood</th>
                       <th>Severity</th>
                       <th>Risk</th>
                       <th>Mitigation</th>
                       <th>Mitigated Risk</th>
                       <th>Monitor</th>
                       <th>Active</th>
                     </thead>
                     <tbody id='tbody'>
                     </tbody>
                   </table>
                 </div>
               </div>


                 <script>

                 function show_open(){
                   var id = '<?php echo $assm_id?>';
                 $.ajax({
                   type:'POST',
                   url:'open_hazards.php',
                   data:{id:id},

                   dataType: 'json',
                   success: function(data){


                     $(data).each(function(){
                       $('#tbody').append('<tr><td>'+this.haz_id+'</td><td>'
                                           +this.category+'</td><td>'
                                           +this.description+'</td><td>'
                                           +this.likelihood+'</td><td>'
                                           +this.severity+'</td><td>'
                                           +this.risk+'</td><td>'
                                           +this.mitigation+'</td><td>'
                                           +this.mitigated_risk+'</td><td>'
                                           +this.monitor+'</td><td>'
                                           +this.active+'</td><td>'
                                           +'<button id="edit-hazard-button" haz-id="'+this.haz_id+'"">Edit</button></td><td>'
                                           +'<button id="delete-hazard-button" haz-id="'+this.haz_id+'"">Delete</button></td></tr>'
                                         )
                                          });
                                        }

                  });
                };



                   $(document).ready(function() {
                     show_open();
                    $("#description_edit").hide();
                     $("#newHazardButton").click(function(){
                         $(".create-hazard").show();
                         //$("#newHazardButton").hide();
                     });


                     $('#new_description').on('click',function() {
                       $("#description_edit").show();

                      });

                      $(".create-hazard").hide();
                   });



                </script>
                </div>

                <script>

                      $("#tbody").on("click","#delete-hazard-button",function(){

                        var haz_id = $(this).attr('haz-id');

                          $.ajax({
                      		type: 'POST',
                      		url: 'delete_hazard.php',
                      		data: {haz_id:haz_id},

                      		success: function(response) {

                           $('#result').html(response);
                          location.reload();

                      		}
                      });
                      });

                </script>

                <div class="edit-hazard"></div>


                <div class="create-hazard">
            			<form id="create-hazard-form" action="" method="POST">
            		        <h2 align="center">Create Hazard</h2>


            				<p>
            				    <label for="category" class="label_width">
            				        <span>Hazard Category: </span>
            				    </label>
            				    <select id="category" name="category">
                          <option value="Man">Man</option>
                          <option value="Machine">Machine</option>
                          <option value="Medium">Medium</option>
                          <option value="Management">Management</option>
                          <option value="Money">Money</option>
                        </select>
            				</p>

                    <div class="description">

                      </script>
                    <p>
                        <label for="description" style="width:150">
                            <span>Description: </span>
                        </label>

                        <?php
                            echo ' <select id="main-description" name="description">';
                            while($row=mysqli_fetch_array($description_query))
                                {
                                 echo '<option value="' . ($row['description']) . '">'
                                                        . ($row['description'])
                                                        . '</option>';
                                }
                        echo '</select>';
                        ?>

                        <button type="button" id="new_description" name="new_description">New</button>

                    </p>

                        <div id="description_edit"></div>

                  </div>

            				<p>
            				    <label for="likelihood" class="label_width">
            				        <span>Likelihood:</span>
            				    </label>
            				    <input type="spinner" id="likelihood" name="likelihood" value = "0" class="spinner" onfocusout="sum()">
            				</p>

                    <p>
            				    <label for="severity" class="label_width">
            				        <span>Severity:</span>
            				    </label>
            				    <input type="spinner" id="severity" name="severity" value = "0" class="spinner" onfocusout="sum()">
            				</p>

                    <p>
            				    <label for="risk" class="label_width">
            				        <span>Risk:</span>
            				    </label>
            				    <div id="risk" name="risk">0</div>
            				</p>

                    <p>
                        <label for="mitigation" style="width:150">
                            <span>Mitigation: </span>
                        </label>
                        <textarea id="mitigation" name="mitigation" cols="100" rows="10"><?php //echo $query2['mitigation'];?></textarea>
                    </p>

                    <p>
            				    <label for="mit-likelihood" class="label_width">
            				        <span>Mitigated Likelihood:</span>
            				    </label>
            				    <input type="spinner" id="mit-likelihood" name="mit-likelihood" value = "0" class="spinner" onfocusout="sum2()">
            				</p>

                    <p>
            				    <label for="mit-severity" class="label_width">
            				        <span>Mitigated Severity:</span>
            				    </label>
            				    <input type="spinner" id="mit-severity" name="mit-severity" value = "0" class="spinner" onfocusout="sum2()">
            				</p>

                    <p>
            				    <label for="mit-risk" class="label_width">
            				        <span>Mitigated Risk:</span>
            				    </label>
            				    <div id="mit-risk">0</div>
            				</p>

                    <p>
            				    <label for="monitor" class="label_width">
            				        <span>Monitor:</span>
            				    </label>
            				    <input type="checkbox" id="monitor" name="monitor">
            				</p>

                    <p>
            				    <label for="active" class="label_width">
            				        <span>Active:</span>
            				    </label>
            				    <input type="checkbox" id="active" name="active">
            				</p>


            		        <p> <button type="button" id="createHazardButton">Create Hazard</button></p>
            			</form>
<!--Create Hazard Form -->

                  <p><!--Show Risk Matrix to help safety manager while creating hazard-->
                    <img src="RiskMatrix.jpg">
                  </p>

            		</div>

                <form id="risk-assesment-form" action="" method="POST">
                <p> <button type="button" id="newHazardButton">New Hazard</button></p>


                <p>
                    <label for="root_cause" style="width:150">
                        <span><b>Root Cause:</b></span>
                    </label>
                    <textarea name="root_cause" cols="100" rows="10" ><?php echo nl2br($query2['root_cause']);?></textarea>
                </p>

                <p>
                    <label for="defence" style="width:150">
                        <span><b>Defense:</b></span>
                    </label>
                    <textarea name="defence" cols="100" rows="10"><?php echo $query2['defence'];?></textarea>
                </p>

                <p>
                    <label for="defence_req" style="width:150">
                        <span><b>Defence Required:</b></span>
                    </label>
                    <textarea name="defence_req" cols="100" rows="10"><?php echo $query2['defence_req'];?></textarea>
                </p>

                <p>
                    <label for="action_taken" style="width:150">
                        <span><b>Action Taken:<b></span>
                    </label>
                    <textarea name="action_taken" cols="100" rows="10"><?php echo $query2['action_taken'];?></textarea>
                </p>

                <p>
                    <label for="status" style="width:150">
                        <span><b>Status:</b></span>
                    </label>
                    <input type="checkbox" name="risk_status" value="closed" <?php echo ($query2['risk_status']=='closed' ? 'checked':'');?>> (Select to close)<br>
               </p>

                 <p> <input id ="submit" type ="submit" name="submit" value="Update Assesment"></p>


              <div class=tickets>


              </div>


            </form>

           </section>

           <script>
           $(function(){
               $('#tbody').on('click', '#edit-hazard-button', function(event){
                   $("#newHazardButton").hide();
                   event.preventDefault();

          // $("#tbody").on("click","#edit-hazard-button",function(){
             var haz_id = $(this).attr('haz-id');
             editHazard(haz_id);
           });

         });
           </script>



      </body>
</html>
