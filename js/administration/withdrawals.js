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
                    <th>Клиент</th>\
					<th>Дата</th>\
					<th>Сумма</th>\
					<th>Статус заявки</th>\
                    <th></th>\
				</tr></thead>\
				<tbody></tbody>\
				</table>');
		        var tbody = $('.table-striped tbody');
		        withdrawalsJSON.data.forEach(function (entry) {
		            var t = (entry.localtimestamp).split(/[- :]/);
		            var d = new Date(t[0], t[1] - 1, t[2], t[3], t[4]);

		            if (entry.status) {
		                tbody.html(tbody.html() + '<tr style="color:#aaaaaa;">\
                         <td>' + entry.client_ID + '</td>\
                            <td>' + d.format("dd mmmm yyyy, HH:MM") + '</td>\
							<td>' + entry.summ + ' р.</td>\
							<td>Заявка выполнена</td>\
						</tr>');
		            }
		            else {
		                tbody.html(tbody.html() + '<tr>\
                        <td>' + entry.client_ID + '</td>\
                            <td>' + d.format("dd mmmm yyyy, HH:MM") + '</td>\
							<td>' + entry.summ + ' р.</td>\
							<td>Заявка в обработке</td>\
                            <td><a href="" onclick="confirmWithdrawal(' + entry.ID + ');return false">Подтвердить вывод</a></td>\
						</tr>');
		            }
		        });
		    }
		}
	);
}

function confirmWithdrawal(ID) {
    $.get("/API/Withdrawals/confirm/" + ID)
                .done(function (msg) {
                    alert(msg);
                })
                .fail(function (xhr, textStatus, errorThrown) {
                    alert('fail');
                });

}