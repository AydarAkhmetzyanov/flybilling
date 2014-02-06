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
					<th>Сумма</th>\
					<th>Статус заявки</th>\
				</tr></thead>\
				<tbody></tbody>\
				</table>');
		        var tbody = $('.table-striped tbody');
		        withdrawalsJSON.data.forEach(function (entry) {
		            if (entry.status) {
		                tbody.html(tbody.html() + '<tr style="color:#aaaaaa;">\
							<td>' + entry.summ + ' р.</td>\
							<td>Заявка выполнена</td>\
						</tr>');
		            }
		            else {
		                tbody.html(tbody.html() + '<tr>\
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
									<div class="controls"><input id="summ-inp" type="text"></div>\
								</div>\
							<button style="float:right;" onclick="createWithdrawal()" class="btn btn-primary">Подать заявку на вывод</button>\
							<div class="clear-fix"></div>\
						</div>');
	$('#exampleModal1').arcticmodal();
}

function createWithdrawal() {
    $.post(
			"/API/Withdrawals", {
				summ: $("#summ-inp").val()
			})
			.done( function(msg) { alert(msg) } )
			.fail( function(xhr, textStatus, errorThrown) {
				var errorJSON = jQuery.parseJSON(xhr.responseText);
				alert(errorJSON.reason);
			});
}