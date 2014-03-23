function addNumber(){
    $.post(
   "/administration/rates/ajax_addnumber",
   $("#addNumberForm").serialize(),
   onAddNumber,
   "text"
   );
}

function onAddNumber(data)
{
    console.log(data);
    var appendhtml = '<tr><td>'+$('#addedNumber').val()+'</td><td>'+$('#addedPrice').val()+'</td><td></td><td></td></tr>';
    $('#addedNumber').val('');
    $('#addedPrice').val('');
    $("#numbersTableBody").prepend(appendhtml);
}

function saveNumber(id,element){
    $.post(
   "/administration/rates/ajax_savenumber",
   $("#number" + id).serialize(),
   function (data) {
       console.log(data);
       $(element).hide("slow");
   },
   "text"
   );
}

function deleteNumber(id){
    var jqxhr = $.get("/administration/rates/ajax_deletenumber/" + id, function (data) {
        console.log(data);
        $('#numberRow' + id).hide("slow");
    });
}
