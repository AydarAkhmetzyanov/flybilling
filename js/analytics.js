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

    var SMSGet = $.get("/API/SMSServices");

    var SessionGet = $.get("/API/SessionServices");

    $.when(SMSGet, SessionGet).done(function (SMSGetResult, SessionGetResult) {
        serviceSelect = $('#service-select');
        var unactive = new Array();
        var unactive2 = new Array();

        var SMSGetJSON = jQuery.parseJSON(SMSGetResult[0]);
        SMSGetJSON.data.forEach(function (entry) {
            if (entry.status) {
                serviceSelect.html(serviceSelect.html() + '<option value="SMSServices&' + entry.ID + '">SMSService_' + entry.ID + '_' + entry.country + '</option>');
            }
            else unactive.push(entry);
        });

        var SessionGetJSON = jQuery.parseJSON(SessionGetResult[0]);
        SessionGetJSON.data.forEach(function (entry) {
            if (entry.status) {
                serviceSelect.html(serviceSelect.html() + '<option value="SessionServices&' + entry.ID + '">SessionService_' + entry.ID + '_' + entry.country + '</option>');
            }
            else unactive2.push(entry);
        });

        unactive.forEach(function (entry) {
            serviceSelect.html(serviceSelect.html() + '<option style="color:#aaaaaa;" value="SMSServices&' + entry.ID + '">SMSService_' + entry.ID + '_' + entry.country + '</option>');
        });

        unactive2.forEach(function (entry) {
            serviceSelect.html(serviceSelect.html() + '<option style="color:#aaaaaa;" value="SessionServices&' + entry.ID + '">SessionService_' + entry.ID + '_' + entry.country + '</option>');
        });

        if (serviceId) {
            $('#service-select option[value="' + serviceType + '&' + serviceId + '"]').attr('selected', true);
        }

        serviceSelect.removeAttr('disabled');
    });

    recount();

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
        recount(1);
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

function drawChartAll(from, to) {

    var options = { from: from, timezone: 4, group: 'day', to: to };
    var sType, client_share;

    var SMSGet = $.get("/API/SMS", options);
    var SessionGet = $.get("/API/SessionSMS", options);

    $.when(SMSGet, SessionGet).done(function (SMSGetResult, SessionGetResult) {
        var SMSGetJSON = jQuery.parseJSON(SMSGetResult[0]);
        var dict = new Array();

        var SessionGetJSON = jQuery.parseJSON(SessionGetResult[0]);
        var dict2 = new Array();

        if (SMSGetJSON.data) {
            SMSGetJSON.data.forEach(function (entry) {
                dict[entry.localtimestamp] = entry.client_share;
            });
        }

        if (SessionGetJSON.data) {
            SessionGetJSON.data.forEach(function (entry) {
                dict2[entry.localtimestamp] = entry.client_cost;
            });
        }

        var arr1 = new Array();
        arr1[0] = new Array("Дата", "SMS Services", "Session Services");

        var now = new Date(from);
        var now2 = new Date(to);
        var daysCount = (now2 - now) / (1000 * 60 * 60 * 24) + 1;

        for (var i = 1; i < daysCount; i++) {
            if (dict[now.format("yyyy-mm-dd")] && !dict2[now.format("yyyy-mm-dd")]) {
                arr1[i] = new Array(now.format("dd-mm-yyyy"), dict[now.format("yyyy-mm-dd")], 0);
            }
            else if (!dict[now.format("yyyy-mm-dd")] && dict2[now.format("yyyy-mm-dd")]) {
                arr1[i] = new Array(now.format("dd-mm-yyyy"), 0, dict2[now.format("yyyy-mm-dd")]);
            }
            else if (dict[now.format("yyyy-mm-dd")] && dict2[now.format("yyyy-mm-dd")]) {
                arr1[i] = new Array(now.format("dd-mm-yyyy"), dict[now.format("yyyy-mm-dd")], dict2[now.format("yyyy-mm-dd")]);
            }
            else {
                arr1[i] = new Array(now.format("dd-mm-yyyy"), 0, 0);
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
    });
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

function showSMSAll(from, to) {

    var options = { from: from, timezone: 4, to: to };
    var groupSelect = $('#group-select');

    if (groupSelect.val() == 'none') {
        var SMSGet = $.get("/API/SMS", options);
        var SessionGet = $.get("/API/SessionSMS", options);

        $.when(SMSGet, SessionGet).done(function (SMSGetResult, SessionGetResult) {
            var SMSGetJSON = jQuery.parseJSON(SMSGetResult[0]);
            var SessionGetJSON = jQuery.parseJSON(SessionGetResult[0]);
            var tableDiv = $('#notifsDiv');
            tableDiv.html('');

            if (SMSGetJSON.data || SessionGetJSON.data) {
                tableDiv.html('<table class="table table-striped">\
				        <thead><tr>\
                            <th>Дата</th>\
                            <th>Сервис</th>\
					        <th>Текст</th>\
                            <th>Номер телефона</th>\
                            <th>Страна</th>\
                            <th>Сервисный номер</th>\
                            <th>Сумма</th>\
				        </tr></thead>\
				        <tbody></tbody>\
				        </table>');
                var tbody = $('.table-striped tbody');

                SMSGetJSON.data.forEach(function (entry) {
                    var t = (entry.localtimestamp).split(/[- :]/);
                    var d = new Date(t[0], t[1] - 1, t[2], t[3], t[4]);

                    tbody.html(tbody.html() + '<tr>\
						        <td>' + d.format("dd mmmm yyyy, HH:MM") + '</td>\
                                <td>SMSService_' + entry.service_ID + '_' + entry.sender_country + '</td>\
						        <td>' + entry.response_text + '</td>\
						        <td>' + entry.sender_phone + '</td>\
						        <td>' + entry.sender_country + '</td>\
						        <td>' + entry.sender_service_number + '</td>\
						        <td>' + entry.client_share + '</td>\
					        </tr>');
                });

                SessionGetJSON.data.forEach(function (entry) {
                    var t = (entry.localtimestamp).split(/[- :]/);
                    var d = new Date(t[0], t[1] - 1, t[2], t[3], t[4]);

                    tbody.html(tbody.html() + '<tr>\
						        <td>' + d.format("dd mmmm yyyy, HH:MM") + '</td>\
                                <td>SessionService_' + entry.service_ID + '_' + entry.country + '</td>\
						        <td>' + entry.text + '</td>\
						        <td>' + entry.phone + '</td>\
						        <td>' + entry.country + '</td>\
						        <td>' + entry.service_number + '</td>\
						        <td>' + entry.client_cost + '</td>\
					        </tr>');
                });
            }
            else {
                tableDiv.html('За указанный промежуток ничего не найдено');
            }
        });
    }
    else {
        options.group = groupSelect.val();

        var SMSGet = $.get("/API/SMS", options);
        var SessionGet = $.get("/API/SessionSMS", options);

        $.when(SMSGet, SessionGet).done(function (SMSGetResult, SessionGetResult) {
            var SMSGetJSON = jQuery.parseJSON(SMSGetResult[0]);
            var SessionGetJSON = jQuery.parseJSON(SessionGetResult[0]);
            var tableDiv = $('#notifsDiv');
            tableDiv.html('');

            if (SMSGetJSON.data || SessionGetJSON.data) {
                tableDiv.html('<table class="table table-striped">\
				        <thead><tr>\
                            <th>Дата</th>\
					        <th>Сумма</th>\
                            <th>Количество</th>\
				        </tr></thead>\
				        <tbody></tbody>\
				        </table>');
                var tbody = $('.table-striped tbody');

                SMSGetJSON.data.forEach(function (entry) {
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

                    tbody.html(tbody.html() + '<tr>\
						        <td>' + date + ' (SMS Services)</td>\
						        <td>' + entry.client_share + '</td>\
						        <td>' + entry.ID + '</td>\
					        </tr>');
                });

                SessionGetJSON.data.forEach(function (entry) {
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

                    tbody.html(tbody.html() + '<tr>\
						        <td>' + date + ' (Session Services)</td>\
						        <td>' + entry.client_cost + '</td>\
						        <td>' + entry.ID + '</td>\
					        </tr>');
                });
            }
            else {
                tableDiv.html('За указанный промежуток ничего не найдено');
            }
        });
    }
}

function recount(test) {
    $('#chart_div').html('<img style="margin-top:90px;" src="/img/dots64.gif">');
    $('#notifsDiv').html('<img src="/img/dots64.gif">');

    if (serviceId && !test) {
        drawChart(dateFrom, dateTo, serviceId, serviceType);
        showSMS(dateFrom, dateTo, serviceId, serviceType);
    }
    else {
        if ($('#service-select').val() == 'all') {
            drawChartAll(dateFrom, dateTo);
            showSMSAll(dateFrom, dateTo);
        }
        else {
            var servicesArray = $('#service-select').val().split(/[&]/);
            drawChart(dateFrom, dateTo, servicesArray[1], servicesArray[0]);
            showSMS(dateFrom, dateTo, servicesArray[1], servicesArray[0]);
        }
    }
}

$('#service-select').change(function () {
    recount(1);
});

$('#group-select').change(function () {
    recount(1);
});