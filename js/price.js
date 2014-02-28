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
	
	var providerarray=new Array();
	$.each(data, function (key, value) {
		if($.inArray(value.provider,providerarray)==-1){
		    providerarray.push(value.provider);
		}
	});
	
	$.each(providerarray, function (pron, providerk) {
	    var appendhtml='';
	    appendhtml = appendhtml+'<table class="table table-hover table-striped"><thead><tr><th>Короткий номер</th><th>Цена для абонента</th></tr></thead>';
		
		appendhtml = appendhtml+'<h3>'+providerk+'</h3><tbody>';
	    $.each(data, function (key, value) {
			    if(providerk==value.provider){
	                if (key == 0) {
	                    numberSelected(value.id);
	                }
	                appendhtml = appendhtml+'<tr onclick="numberSelected(' + value.id + ')" class="numberSelect"><td>' + value.number + '</td><td>~ ' + value.price / 100 + ' р.</td></tr>';
	            }
		});
		
		
		appendhtml =appendhtml+'</tbody></table>';
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