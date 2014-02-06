var serviceType;
var serviceId;
var dateFrom;
var dateTo;

$(document).ready(function () {
	var url = window.location.href;
	var urlValue = url.split("/");
	serviceType = urlValue[5];
	serviceId = urlValue[6];
	dateFrom = getDate('currentMonth');
	dateTo = getDate('today');
	
	if(serviceId && serviceType) $('#pageName').html('Статистика сервиса ' + serviceId + ' (' + serviceType + ')');
	
	drawChart(dateFrom, dateTo, serviceId);
	showSMS(dateFrom, dateTo, serviceId);
	
	$('#reportrange').daterangepicker(
    {
        ranges: {
            'Сегодня': ['today', 'today'],
			'Эта неделя': [Date.today().moveToFirstDayOfWeek(), Date.today().moveToLastDayOfWeek()],
			'Этот месяц': [Date.today().moveToFirstDayOfMonth(), Date.today().moveToLastDayOfMonth()],
            'Этот год': [Date.today().moveToFirstMonth().moveToFirstDayOfMonth(), Date.today().moveToLastMonth().moveToLastDayOfMonth()]
        }
    },
    function(start, end) {
	if ((start.toString() == Date.today()) && (end.toString() == Date.today())){
			$('#reportrange span').html('Сегодня');
		}
	else if ((start.toString() == Date.today().moveToFirstDayOfWeek()) && (end.toString() == Date.today().moveToLastDayOfWeek())){
			$('#reportrange span').html('Эта неделя');
		}
	else if ((start.toString() == Date.today().moveToFirstDayOfMonth()) && (end.toString() == Date.today().moveToLastDayOfMonth())){
			$('#reportrange span').html('Этот месяц');
		}
	else if ((start.toString() == Date.today().moveToFirstMonth().moveToFirstDayOfMonth()) && (end.toString() == Date.today().moveToLastMonth().moveToLastDayOfMonth())){
			$('#reportrange span').html('Этот год');
		}
		else $('#reportrange span').html(start.toString('d MMM yyyy') + ' - ' + end.toString('d MMM yyyy'));
		dateFrom = start.toString('yyyy-MM-dd') + ' 00:00';
		dateTo = end.toString('yyyy-MM-dd') + ' 23:59';
		recount();
    }
);
	
	
});

function drawChart(from, to, service_ID) {

var options = {from: from, timezone: 4, group: 'day', to: to};
if (service_ID) options.service_ID = service_ID;

	var dataChart = $.get(
		"/API/SMS", options,
		function (objResult) {
			var obj = jQuery.parseJSON(objResult);
			var dict = new Array();

			if (obj.data) {
				obj.data.forEach(function (entry) {
					dict[entry.localtimestamp] = entry.client_share;
				});
			}

			var arr1 = new Array();
			arr1[0] = new Array("Дата", "Доход");

			var now = new Date(from);
			var now2 = new Date(to);
			var daysCount = (now2-now)/(1000*60*60*24)+1;

			for (var i = 1; i < daysCount; i++) {
				if (dict[now.format("yyyy-mm-dd")]) {
					arr1[i] = new Array(now.format("dd-mm-yyyy"), dict[now.format("yyyy-mm-dd")]);

				} else {
					arr1[i] = new Array(now.format("dd-mm-yyyy"), 0);
				}
				now.setDate(now.getDate() + 1);
			}

			var data = google.visualization.arrayToDataTable(arr1);

			var options = {
				title: '',
				titlePosition: 'none'
			};

			var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
			chart.draw(data, options);
		}
	);
}

function jsonParse(input, type) {
	var obj = jQuery.parseJSON(input);
	var clientShare = 0;

	if (obj.data) {
		if (type == 'SMS') {
			obj.data.forEach(function (entry) {
				clientShare += entry.client_share;
			});
		} else {
			obj.data.forEach(function (entry) {
				clientShare += entry.client_cost;
			});
		}
	}

	return clientShare;
}

function getDate(date) {
	var now = new Date();

	switch (date) {
	case 'today0':
		return now.format("yyyy-mm-dd") + ' 00:00';
	case 'today':
		return now.format("yyyy-mm-dd") + ' 23:59';
	case 'yesterday0':
		now.setDate(now.getDate() - 1);
		return now.format("yyyy-mm-dd") + ' 00:00';
	case 'yesterday':
		now.setDate(now.getDate() - 1);
		return now.format("yyyy-mm-dd") + ' 23:59';
	case 'currentWeek':
		now.setDate(now.getDate() - 7);
		return now.format("yyyy-mm-dd hh:mm");
	case 'pastWeek':
		now.setDate(now.getDate() - 14);
		return now.format("yyyy-mm-dd hh:mm");
	case 'currentMonth':
		now.setDate(now.getDate() - 30);
		return now.format("yyyy-mm-dd hh:mm");
	case 'pastMonth':
		now.setDate(now.getDate() - 60);
		return now.format("yyyy-mm-dd hh:mm");
	}
}

function showSMS(from, to, service_ID) {

var options = {from: from, timezone: 4, to: to};
if (service_ID) options.service_ID = service_ID;

	$.get(
		"/API/SMS", options, function(result) {
			var finesJSON = jQuery.parseJSON(result);
			var tableDiv = $('#notifsDiv');
			tableDiv.html('');
			if (finesJSON.data)
			{
				tableDiv.html('<table class="table table-striped">\
				<thead><tr>\
					<th>Время</th>\
					<th>response_text (хз, какие поля в этой таблице надо выводить, поэтому пусть будут эти)</th>\
				</tr></thead>\
				<tbody></tbody>\
				</table>');
				var tbody = $('.table-striped tbody');
				finesJSON.data.forEach(function (entry) {
					var t = (entry.timestamp).split(/[- :]/);
					var d = new Date(t[0], t[1] - 1, t[2], t[3], t[4], t[5]);
					tbody.html(tbody.html() + '<tr>\
						<td>' + d.format("dd mmmm yyyy, hh:mm") + '</td>\
						<td>' + entry.response_text + '</td>\
					</tr>');
				});
			}
			else
			{
				tableDiv.html('У вас нет SMS');
			}
		}
	);
}

function recount() {
	$('#chart_div').html('<img style="margin-top:90px;" src="/img/dots64.gif">');
	$('#notifsDiv').html('<img src="/img/dots64.gif">');
	drawChart(dateFrom, dateTo, serviceId);
	showSMS(dateFrom, dateTo, serviceId);
}