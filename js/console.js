$(document).ready(function () {
	drawChart();
	showNews();
	
	var today = getSMS(getDate('today0'), getDate('today'), 'SMS') - getSMS(getDate('today0'), getDate('today'), 'SessionSMS');
	var yesterday = getSMS(getDate('yesterday0'), getDate('yesterday'), 'SMS') - getSMS(getDate('yesterday0'), getDate('yesterday'), 'SessionSMS');
	$("#todayProfit").html(today.toFixed(2) + " <s>Р</s>");
	if (today < yesterday) $("#todayProfitArrow").addClass("status-down");
	else if (today > yesterday) $("#todayProfitArrow").addClass("status-up");

	today = getSMS(getDate('currentWeek'), getDate('today'), 'SMS') - getSMS(getDate('currentWeek'), getDate('today'), 'SessionSMS');
	yesterday = getSMS(getDate('pastWeek'), getDate('currentWeek'), 'SMS') - getSMS(getDate('pastWeek'), getDate('currentWeek'), 'SessionSMS');
	$("#weekProfit").html(today.toFixed(2) + " <s>Р</s>");
	if (today < yesterday) $("#weekProfitArrow").addClass("status-down");
	else if (today > yesterday) $("#weekProfitArrow").addClass("status-up");

	today = getSMS(getDate('currentMonth'), getDate('today'), 'SMS') - getSMS(getDate('currentMonth'), getDate('today'), 'SessionSMS');
	yesterday = getSMS(getDate('pastMonth'), getDate('currentMonth'), 'SMS') - getSMS(getDate('pastMonth'), getDate('currentMonth'), 'SessionSMS');
	$("#monthProfit").html(today.toFixed(2) + " <s>Р</s>");
	if (today < yesterday) $("#monthProfitArrow").addClass("status-down");
	else if (today > yesterday) $("#monthProfitArrow").addClass("status-up");

});

function showNews() {
var res;

	$.ajax({
		type: "GET",
		async: false,
		url: "/API/Notifications",
		data: {
		},
		success: function (result) {
			res = result;
		}
	});

	var obj = jQuery.parseJSON(res);

	if (obj.data) {
		obj.data.forEach(function (entry) {
		var t = (entry.timestamp).split(/[- :]/);
		var d = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
		
		if (entry.status)
		{
		$("#notifsDiv").html('<div class="item"><div class="date">' + d.format("dd mmmm yyyy, hh:mm") + '</div>' + entry.title_ru + '</div>' + $("#notifsDiv").html());
		}
		else
		{
		$("#notifsDiv").html('<div class="item item-new"><div class="date">' + d.format("dd mmmm yyyy, hh:mm") + '</div>' + entry.title_ru + '</div>' + $("#notifsDiv").html());
		}
		});
	}
}

function drawChart() {
	var res;

	$.ajax({
		type: "GET",
		async: false,
		url: "/API/SMS",
		data: {
			from: getDate('currentMonth'),
			timezone: 4,
			to: getDate('today'),
			group: 'day'
		},
		success: function (result) {
			res = result;
		}
	});

	var obj = jQuery.parseJSON(res);
	var dict = new Array();

	if (obj.data) {
		obj.data.forEach(function (entry) {
			dict[entry.localtimestamp] = entry.client_share;
		});
	}

	var arr1 = new Array();
	arr1[0] = new Array("Дата", "Доход");

	var now = new Date();
	now.setDate(now.getDate() - 29);

	for (var i = 1; i < 31; i++) {
		if (dict[now.format("yyyy-mm-dd")]) {
			arr1[i] = new Array(now.format("dd-mm"), dict[now.format("yyyy-mm-dd")]);

		} else {
			arr1[i] = new Array(now.format("dd-mm"), 0);
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

function getSMS(from, to, url) {
	var res;

	$.ajax({
		type: "GET",
		async: false,
		url: "/API/" + url,
		data: {
			from: from,
			timezone: 4,
			to: to
		},
		success: function (result) {
			res = result;
		}
	});

	return jsonParse(res, url);
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