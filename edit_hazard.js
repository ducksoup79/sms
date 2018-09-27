var haz_id = "";
var risk_ass_id = "";



function editHazard(haz_id){

  $(function(){
    $(".edit-hazard").load("edit_hazard.html");
  });
//  var id = $(this).attr('haz-id');

  //  $("#createHazardButton").hide();
  //get all descriptions from the description table and feed to edit_hazard.html
  function getDescription(obj)
     {
  $('#ed_description_edit').empty()
  $.ajax({
          type: "POST",
          url: "get_description.php",
          data: { },
          success: function(data){
              // Parse the returned json data
              var opts = $.parseJSON(data);
              console.log(opts);
              // Use jQuery's each to iterate over the opts value
              $.each(opts, function(i, d) {
                  // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                  $('#ed_description_edit').append('<option value="' + d.description + '">' + d.description + '</option>');
              });
          }
      });
}


getDescription();

  $.ajax({
type: 'POST',
url: 'edit_hazard.php',
data: { id: haz_id},
dataType:'json',
success: function(data) {

     console.log('got hazard id as'+haz_id)
     haz_id = data[0];
     risk_ass_id = data[1];
     category = data[2];
     description = data[3];
     likelihood =data[4];
     severity = data[5];
     risk = data[6];
     mitigation = data[7];
     mitigated_likelihood = data[8];
     mitigated_severity = data[9];
     mitigated_risk = data[10];
     monitor = data[11];
     active = data[12];

    $("#haz-id").val(haz_id);
    $("#risk-ass").val(risk_ass_id);
    $("#ed_category").val(category);
    $("#ed_description_edit").val(description);
    $("input[name=likelihood]").val(likelihood);
    $("input[name=severity]").val(severity);
    $("#ed_risk").html(risk);
    $("textarea[name=mitigation]").val(mitigation);
    $("input[name=mit-likelihood]").val(mitigated_likelihood);
    $("input[name=mit-severity]").val(mitigated_severity);
    $("#ed_mit-risk").html(mitigated_risk);

    if(monitor == "Yes"){
      $("#ed_monitor").prop('checked',true);
    }else{
      $("#ed_monitor").prop('checked',false);
    }

    if(active == "Yes"){
      $("#ed_active").prop('checked',true);
    }else{
      $("#ed_active").prop('checked',false);
    }


    $("#newHazardButton").show();

  }

});

};

$(function(){
    $('body').on('click', '#editHazardButton', function(event){
        event.preventDefault();

      console.log("hazard id is "+haz_id);
      //var haz_id = haz_id;
      var risk_ass_id = $('#risk-ass').val();
      var haz_id = $('#haz-id').val();
      var category = $('select#ed_category option:checked').val();
      var description = $('select#ed_description_edit option:checked').val();
      var likelihood = $('#ed_likelihood').val();
      var severity = $('#ed_severity').val();
      var risk = $('#ed_risk').html();
      var mitigation = $('#ed_mitigation').val();
      var mit_likelihood = $('#ed_mit-likelihood').val();
      var mit_severity = $('#ed_mit-severity').val();
      var mit_risk = $('#ed_mit-risk').html();
      var monitor = $('input[type=checkbox][name=monitor]:checked').val();
      var active = $('input[type=checkbox][name=active]:checked').val();


      $.ajax({
        type: 'POST',
        url: 'edit_hazard_submit.php',
        data: { risk_ass_id :risk_ass_id,
                haz_id: haz_id,
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
            $(".edit-hazard").hide();
            location.reload();

        }
    });
    });
});
