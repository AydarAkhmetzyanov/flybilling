$(document).ready(function () {
	showNews();
	drawChart();
	getSMS('today0', 'today', 'yesterday0', 'yesterday', 'todayProfit');
	getSMS('currentWeek', 'today', 'pastWeek', 'currentWeek', 'weekProfit');
	getSMS('currentMonth', 'today', 'pastWeek', 'currentWeek', 'monthProfit');
});

function getSMS(today0Input, todayInput, yesterday0Input, yesterdayInput, idInput) {

	var today1 = $.get(
		"/API/SMS", {
			from: getDate(today0Input),
			timezone: 4,
			to: getDate(todayInput)
		}
	);

	var today2 = $.get(
		"/API/SessionSMS", {
			from: getDate(today0Input),
			timezone: 4,
			to: getDate(todayInput)
		}
	);

	var yesterday1 = $.get(
		"/API/SMS", {
			from: getDate(yesterday0Input),
			timezone: 4,
			to: getDate(yesterdayInput)
		}
	);

	var yesterday2 = $.get(
		"/API/SessionSMS", {
			from: getDate(yesterday0Input),
			timezone: 4,
			to: getDate(yesterdayInput)
		}
	);

	$.when(today1, today2, yesterday1, yesterday2).done(function (today1Result, today2Result, yesterday1Result, yesterday2Result) {

		var today = jsonParse(today1Result[0], 'SMS') - jsonParse(today2Result[0], 'SessionSMS');
		var yesterday = jsonParse(yesterday1Result[0], 'SMS') - jsonParse(yesterday2Result[0], 'SessionSMS');
		$("#" + idInput).html(today.toFixed(2) + " <s>Р</s>");
		if (today < yesterday) $("#" + idInput + "Arrow").addClass("status-down");
		else if (today > yesterday) $("#" + idInput + "Arrow").addClass("status-up");
	});
}

function showNews() {
var notifsDiv = $("#notifsDiv");
	var data = $.get(
		"/API/Notifications", {
			mark_read: true
		},
		function (objResult) {
			var obj = jQuery.parseJSON(objResult);
			notifsDiv.html('');
			if (obj.data) {
				obj.data.forEach(function (entry) {
					var t = (entry.timestamp).split(/[- :]/);
					var d = new Date(t[0], t[1] - 1, t[2], t[3], t[4], t[5]);

					if (entry.status) {
						notifsDiv.html('<div class="item" onclick="notificationClick(' + entry.ID + ')" data-id="' + entry.ID + '"><div class="date">' + d.format("dd mmmm yyyy, hh:mm") + '</div><span class="notif-body">' + entry.title_ru + '</span></div>' + notifsDiv.html());
					} else {
						notifsDiv.html('<div class="item item-new" onclick="notificationClick(' + entry.ID + ')" data-id="' + entry.ID + '"><div class="date">' + d.format("dd mmmm yyyy, hh:mm") + '</div><span class="notif-body">' + entry.title_ru + '</span></div>' + notifsDiv.html());
					}
				});
			}
		}
	);
}

function notificationClick(id) {

	$(".g-hidden").html('<div class="box-modal" id="exampleModal1"><div class="box-modal_close arcticmodal-close">закрыть</div><div style="margin:10px 0;">' + $('div[data-id="' + id + '"] .notif-body').html() + '</div><textarea id="ticket-text" rows="8" placeholder="Текст вопроса" data-default-value=""/><span style="float:right;" onclick="askQuestion(' + id + ')" class="btn btn-primary">Отправить вопрос</span><div class="clear-fix"></div></div>');
	$('#exampleModal1').arcticmodal();
}

function askQuestion(id) {
	var ticketText = $("#ticket-text");
	if (ticketText.val()) {
		$.post(
			"/API/Notifications/" + id, {
				text: ticketText.val()
			});
		$('#exampleModal1').arcticmodal('close');
	} else {
		alert('Введите текст вопроса');
	}
}

function addTicket() {

	$(".g-hidden").html('<div class="box-modal" id="exampleModal1">\
			<div class="box-modal_close arcticmodal-close">закрыть</div>\
			<h2>Введите свой вопрос</h2>\
			<input id="ticket-title" type="text" placeholder="Тема вопроса" data-default-value=""/>\
			<textarea id="ticket-text" rows="8" placeholder="Текст вопроса" data-default-value=""/>\
			<span style="float:right;" onclick="addTicketPost()" class="btn btn-primary">Отправить вопрос</span>\
			<div class="clear-fix"></div>\
		</div>');
	$('#exampleModal1').arcticmodal();
}

function addTicketPost() {
var ticketText = $("#ticket-text");
var ticketTitle = $("#ticket-title");
	if (ticketText.val() && ticketTitle.val()) {
		$.post(
			"/API/Notifications", {
				title: ticketTitle.val(),
				text: ticketText.val()
			});
		$('#exampleModal1').arcticmodal('close');
	} else if (!ticketText.val() && ticketTitle.val()) {
		alert('Введите текст вопроса');
	} else if (ticketText.val() && !ticketTitle.val()) {
		alert('Введите тему вопроса');
	} else {
		alert('Введите тему и текст вопроса');
	}
}

function drawChart() {
	var dataChart = $.get(
		"/API/SMS", {
			from: getDate('currentMonth'),
			timezone: 4,
			to: getDate('today'),
			group: 'day'
		},
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