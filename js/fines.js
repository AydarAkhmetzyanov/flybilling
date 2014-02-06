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
					<th>Размер</th>\
					<th>Описание</th>\
				</tr></thead>\
				<tbody></tbody>\
				</table>');
				var tbody = $('.table-striped tbody');
				finesJSON.data.forEach(function (entry) {
					tbody.html(tbody.html() + '<tr>\
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