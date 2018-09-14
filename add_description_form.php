

<html>
<head>
<script>

function updateDiv()
{
    $( ".description" ).load(window.location.href + " .description" );

}


$(function(){
    $('body').on('click', '#createDescriptionButton', function(event){
        event.preventDefault();

      var description = $('#description').val();
      alert(description);


	    $.ajax({
    		type: 'POST',
    		url: 'add_description.php',
    		data: {description: description},
    		success: function(response) {
    		    $('#result').html(response);
            updateDiv();

    		}
    });

    });
});


</script>

</head>

 <body>
   <div class="create-description">
     <form id="create-description-form" action="" method="POST">
           <h2 align="center">Create Description</h2>
     <div id="result"></div>


       <p>
           <label for="description" class="label_width">
               <span>Description: </span>
           </label>
           <input type="text" id="description" name="description">
       </p>

           <p> <button type="button" id="createDescriptionButton">Create</button></p>
     </form>

   </div>

</body>
</html>
