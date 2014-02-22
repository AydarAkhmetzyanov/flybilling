$(document).ready(function () {
    showWithdrawals();
});

function showWithdrawals() {
    $.get(
		"/API/Withdrawals", function (result) {
		    var withdrawalsJSON = jQuery.parseJSON(result);
		    var tableDiv = $('#withdrawals-table');
		    tableDiv.html('');
		    if (withdrawalsJSON.data) {
		        tableDiv.html('<table class="table table-striped">\
				<thead><tr>\
					<th>Дата</th>\
					<th>Сумма</th>\
					<th>Статус заявки</th>\
				</tr></thead>\
				<tbody></tbody>\
				</table>');
		        var tbody = $('.table-striped tbody');
		        withdrawalsJSON.data.forEach(function (entry) {
		            var t = (entry.localtimestamp).split(/[- :]/);
		            var d = new Date(t[0], t[1] - 1, t[2], t[3], t[4]);

		            if (entry.status) {
		                tbody.html(tbody.html() + '<tr style="color:#aaaaaa;">\
                            <td>' + d.format("dd mmmm yyyy, HH:MM") + '</td>\
							<td>' + entry.summ + ' р.</td>\
							<td>Заявка выполнена</td>\
						</tr>');
		            }
		            else {
		                tbody.html(tbody.html() + '<tr>\
                            <td>' + d.format("dd mmmm yyyy, HH:MM") + '</td>\
							<td>' + entry.summ + ' р.</td>\
							<td>Заявка в обработке</td>\
						</tr>');
		            }
		        });
		    }
		}
	);
}

function showWithdrawalCreation() {
	$(".g-hidden").html('<div class="box-modal" id="exampleModal1">\
							<div class="box-modal_close arcticmodal-close">закрыть</div>\
							<h2>Вывод средств</h2>\
							<div class="form-horizontal">\
								<div class="control-group">\
									<label class="control-label">Введите нужную сумму</label>\
									<div class="controls"><input id="summ-inp" type="text" value="' + summ + '"></div>\
								</div>\
							<button style="float:right;" onclick="createWithdrawal()" class="btn btn-primary">Подать заявку на вывод</button>\
                            <div class="datacheck" id="error-div"></div>\
							<div class="clear-fix"></div>\
						</div>');
	$('#exampleModal1').arcticmodal();
}

function createWithdrawal() {

    var summInp = $("#summ-inp").val();
    summInp = summInp.replace(' ', '');
    summInp = summInp.replace(',', '.');

    var errorDiv = $('#error-div');
    errorDiv.html('');

    if (!$.isNumeric(summInp)) {
        errorDiv.html('Ошибка ввода');
    }
    else if (summInp > summ) {
        errorDiv.html('Недостаточно средств');
    }
    else {
        $.post(
                "/API/Withdrawals", {
                    summ: summInp
                })
                .done(function (msg) {
                    showWithdrawals();
                    summ = summ - summInp;
                    $('#exampleModal1').arcticmodal('close');
                })
                .fail( function(xhr, textStatus, errorThrown) {
                    var errorJSON = jQuery.parseJSON(xhr.responseText);
                    errorDiv.html(errorJSON.reason);
                });
    }
}