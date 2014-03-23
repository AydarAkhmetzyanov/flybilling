function addPrice(){
    $.post(
   "/administration/rates/prices/ajax_addprice",
   $("#addPrice").serialize(),
   onAddPrice,
   "text"
   );
}

function onAddPrice(data)
{
    console.log(data);
    var appendhtml = '<tr><td>'+$("#addedOperator option:selected").text()+'</td><td>'+$('#addedCost').val()+'</td><td>'+$('#addedShare').val()+'</td><td></td></tr>';
    $('#addedCost').val('');
    $('#addedShare').val('');
    $("#pricesTableBody").prepend(appendhtml);
}

function savePrice(id,element){
    $.post(
   "/administration/rates/prices/ajax_saveprice",
   $("#price" + id).serialize(),
   function (data) {
       console.log(data);
       $(element).hide("slow");
   },
   "text"
   );
}

function deletePrice(id){
    var jqxhr = $.get("/administration/rates/prices/ajax_deleteprice/" + id, function (data) {
        console.log(data);
        $('#priceRow' + id).remove();
    });
}