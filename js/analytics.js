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

    if (serviceId) {
        $.get(
        "/API/" + serviceType + "/" + serviceId,
        function (result) {
            var serviceJSON = jQuery.parseJSON(result);
            $('#service-select').html('<option value="none">' + serviceType.slice(0, -1) + '_' + serviceId + '_' + serviceJSON.data[0].country + '</option>');
        });

        drawChart(dateFrom, dateTo, serviceId, serviceType);
        showSMS(dateFrom, dateTo, serviceId, serviceType);
    }
    else {
        serviceSelect = $('#service-select');

        $.get(
        "/API/SMSServices",
        function (result) {
            var serviceJSON = jQuery.parseJSON(result);
            serviceJSON.data.forEach(function (entry) {
                serviceSelect.html(serviceSelect.html() + '<option value="SMSServices&' + entry.ID + '">SMSService_' + entry.ID + '_' + entry.country + '</option>');
            });
        });

        $.get(
        "/API/SessionServices",
        function (result) {
            var serviceJSON = jQuery.parseJSON(result);
            serviceJSON.data.forEach(function (entry) {
                serviceSelect.html(serviceSelect.html() + '<option value="SessionServices&' + entry.ID + '">SessionService_' + entry.ID + '_' + entry.country + '</option>');
                $('#service-select').removeAttr('disabled');
            });
        });
    }

    $('#reportrange').daterangepicker(
    {
        ranges: {
            'Сегодня': ['today', 'today'],
            'Эта неделя': [Date.today().moveToFirstDayOfWeek(), Date.today().moveToLastDayOfWeek()],
            'Этот месяц': [Date.today().moveToFirstDayOfMonth(), Date.today().moveToLastDayOfMonth()],
            'Этот год': [Date.today().moveToFirstMonth().moveToFirstDayOfMonth(), Date.today().moveToLastMonth().moveToLastDayOfMonth()]
        }
    },
    function (start, end) {
        if ((start.toString() == Date.today()) && (end.toString() == Date.today())) {
            $('#reportrange span').html('Сегодня');
        }
        else if ((start.toString() == Date.today().moveToFirstDayOfWeek()) && (end.toString() == Date.today().moveToLastDayOfWeek())) {
            $('#reportrange span').html('Эта неделя');
        }
        else if ((start.toString() == Date.today().moveToFirstDayOfMonth()) && (end.toString() == Date.today().moveToLastDayOfMonth())) {
            $('#reportrange span').html('Этот месяц');
        }
        else if ((start.toString() == Date.today().moveToFirstMonth().moveToFirstDayOfMonth()) && (end.toString() == Date.today().moveToLastMonth().moveToLastDayOfMonth())) {
            $('#reportrange span').html('Этот год');
        }
        else $('#reportrange span').html(start.toString('d MMM yyyy') + ' - ' + end.toString('d MMM yyyy'));
        dateFrom = start.toString('yyyy-MM-dd') + ' 00:00';
        dateTo = end.toString('yyyy-MM-dd') + ' 23:59';
    }
);


});

function drawChart(from, to, service_ID, service_type) {

    var options = { from: from, timezone: 4, group: 'day', to: to };
    if (service_ID) options.service_ID = service_ID;
    var sType, client_share;

    switch (service_type) {
        case 'SMSServices': sType = 'SMS'; break;
        case 'SessionServices': sType = 'SessionSMS'; break;
    }

    var dataChart = $.get(
		"/API/" + sType, options,
		function (objResult) {
		    var obj = jQuery.parseJSON(objResult);
		    var dict = new Array();

		    if (obj.data) {
		        obj.data.forEach(function (entry) {
		            switch (service_type) {
		                case 'SMSServices': client_share = entry.client_share; break;
		                case 'SessionServices': client_share = entry.client_cost; break;
		            }
		            dict[entry.localtimestamp] = client_share;
		        });
		    }

		    var arr1 = new Array();
		    arr1[0] = new Array("Дата", "Доход");

		    var now = new Date(from);
		    var now2 = new Date(to);
		    var daysCount = (now2 - now) / (1000 * 60 * 60 * 24) + 1;

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
            return now.format("yyyy-mm-dd HH:MM");
        case 'pastWeek':
            now.setDate(now.getDate() - 14);
            return now.format("yyyy-mm-dd HH:MM");
        case 'currentMonth':
            now.setDate(now.getDate() - 30);
            return now.format("yyyy-mm-dd HH:MM");
        case 'pastMonth':
            now.setDate(now.getDate() - 60);
            return now.format("yyyy-mm-dd HH:MM");
    }
}

function showSMS(from, to, service_ID, service_type) {

    var options = { from: from, timezone: 4, to: to };
    var sType, text, phone, country, service_number, summ;
    var groupSelect = $('#group-select');

    if (service_ID) options.service_ID = service_ID;

    switch (service_type) {
        case 'SMSServices': sType = 'SMS'; break;
        case 'SessionServices': sType = 'SessionSMS'; break;
    }

    if (groupSelect.val() == 'none') {
        $.get(
            '/API/' + sType, options, function (result) {
                var finesJSON = jQuery.parseJSON(result);
                var tableDiv = $('#notifsDiv');
                tableDiv.html('');
                if (finesJSON.data) {
                    tableDiv.html('<table class="table table-striped">\
				        <thead><tr>\
                            <th>Дата</th>\
					        <th>Текст</th>\
                            <th>Номер телефона</th>\
                            <th>Страна</th>\
                            <th>Сервисный номер</th>\
                            <th>Сумма</th>\
				        </tr></thead>\
				        <tbody></tbody>\
				        </table>');
                    var tbody = $('.table-striped tbody');
                    finesJSON.data.forEach(function (entry) {
                        var t = (entry.localtimestamp).split(/[- :]/);
                        var d = new Date(t[0], t[1] - 1, t[2], t[3], t[4]);

                        switch (service_type) {
                            case 'SMSServices': {
                                text = entry.response_text;
                                phone = entry.sender_phone;
                                country = entry.sender_country;
                                service_number = entry.sender_service_number;
                                summ = entry.client_share;
                                break;
                            }
                            case 'SessionServices': {
                                text = entry.text;
                                phone = entry.phone;
                                country = entry.country;
                                service_number = entry.service_number;
                                summ = entry.client_cost;
                                break;
                            }
                        }

                        tbody.html(tbody.html() + '<tr>\
						        <td>' + d.format("dd mmmm yyyy, HH:MM") + '</td>\
						        <td>' + text + '</td>\
						        <td>' + phone + '</td>\
						        <td>' + country + '</td>\
						        <td>' + service_number + '</td>\
						        <td>' + summ + '</td>\
					        </tr>');
                    });
                }
                else {
                    tableDiv.html('За указанный промежуток ничего не найдено');
                }
            }
        );
    }
    else {
        options.group = groupSelect.val();
        $.get(
            '/API/' + sType, options, function (result) {
                var finesJSON = jQuery.parseJSON(result);
                var tableDiv = $('#notifsDiv');
                tableDiv.html('');
                if (finesJSON.data) {
                    tableDiv.html('<table class="table table-striped">\
				        <thead><tr>\
                            <th>Дата</th>\
					        <th>Сумма</th>\
                            <th>Количество</th>\
				        </tr></thead>\
				        <tbody></tbody>\
				        </table>');
                    var tbody = $('.table-striped tbody');
                    finesJSON.data.forEach(function (entry) {
                        if (groupSelect.val() == 'year') {
                            var date = entry.localtimestamp;
                        }
                        else {
                            var t = (entry.localtimestamp).split(/[- :]/);
                            var d = new Date();
                            d.setFullYear(t[0]);
                            var date = d.format("yyyy");
                            if (t[1]) {
                                d.setMonth(t[1] - 1);
                                date = d.format("mmm yyyy");
                            }
                            if (t[2]) {
                                d.setDate(t[2]);
                                date = d.format("dd mmmm yyyy");
                            }
                            if (t[3]) {
                                date = d.format("dd mmmm yyyy ") + t[3] + ':00';
                            }
                        }

                        switch (service_type) {
                            case 'SMSServices': {
                                summ = entry.client_share;
                                break;
                            }
                            case 'SessionServices': {
                                summ = entry.client_cost;
                                break;
                            }
                        }

                        tbody.html(tbody.html() + '<tr>\
						        <td>' + date + '</td>\
						        <td>' + summ + '</td>\
						        <td>' + entry.ID + '</td>\
					        </tr>');
                    });
                }
                else {
                    tableDiv.html('За указанный промежуток ничего не найдено');
                }
            }
        );
    }
}

function recount() {
    if (serviceId) {
        $('#chart_div').html('<img style="margin-top:90px;" src="/img/dots64.gif">');
        $('#notifsDiv').html('<img src="/img/dots64.gif">');
        drawChart(dateFrom, dateTo, serviceId, serviceType);
        showSMS(dateFrom, dateTo, serviceId, serviceType);
    }
    else {
        if ($('#service-select option').length == 0) {
            alert('Сервис не выбран');
        }
        else {
            var servicesArray = $('#service-select').val().split(/[&]/);
            $('#chart_div').html('<img style="margin-top:90px;" src="/img/dots64.gif">');
            $('#notifsDiv').html('<img src="/img/dots64.gif">');
            drawChart(dateFrom, dateTo, servicesArray[1], servicesArray[0]);
            showSMS(dateFrom, dateTo, servicesArray[1], servicesArray[0]);
        }
    }
}