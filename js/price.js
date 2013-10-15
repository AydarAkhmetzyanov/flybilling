$(document).ready(function () {
    countrySelected();

});

function countrySelected(){
    $.get("/price/getNumbers/" + $('#countrySelect').val(), function (data) {
        renderNumberTable(jQuery.parseJSON(data));
    });
}

function renderNumberTable(data){
    $("#numbersTBody").html('');
	var appendhtml;
	$.each(data, function (key, value) {
	    if (key == 0) {
	        numberSelected(value.id);
	    }
	    appendhtml = '<tr onclick="numberSelected(' + value.id + ')" class="numberSelect"><td>' + value.number + '</td><td>~ ' + value.price / 100 + ' р.</td><td>'+ value.preprefix+ '</td></tr>';
	    $("#numbersTBody").append(appendhtml);
	});
}

function numberSelected(id){
    $.get("/price/getPrices/" + id, function (data) {
        renderPricesTable(jQuery.parseJSON(data));
    });
}

function renderPricesTable(data){
    $("#pricesTBody").html('');
	var appendhtml;
	$.each(data, function(key, value) {
	    appendhtml='<tr><td>'+value.operator_short_name+'</td><td>'+value.cost /100+' руб.</td><td>'+((value.share/100)*$("#priceRow").attr('pers')).toFixed(2)+' руб.</td></tr>';
		$("#pricesTBody").append(appendhtml);
    });
}