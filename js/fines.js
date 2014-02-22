$(document).ready(function () {
	showFines();
});

function showFines() {
	$.get(
		"/API/Fines", function(result) {
			var finesJSON = jQuery.parseJSON(result);
			var tableDiv = $('#fines-table');
			tableDiv.html('');
			if (finesJSON.data)
			{
				tableDiv.html('<table class="table table-striped">\
				<thead><tr>\
					<th>Дата</th>\
					<th>Размер</th>\
					<th>Описание</th>\
				</tr></thead>\
				<tbody></tbody>\
				</table>');
				var tbody = $('.table-striped tbody');
				finesJSON.data.forEach(function (entry) {
				    var t = (entry.localtimestamp).split(/[- :]/);
				    var d = new Date(t[0], t[1] - 1, t[2], t[3], t[4]);

				    tbody.html(tbody.html() + '<tr>\
                        <td>' + d.format("dd mmmm yyyy, HH:MM") + '</td>\
						<td>' + entry.summ + ' р.</td>\
						<td>' + entry.description + '</td>\
					</tr>');
				});
			}
			else
			{
				tableDiv.html('У вас нет штрафов');
			}
		}
	);
}