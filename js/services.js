$(document).ready(function () {
	showServices();
});

function showServices() {
	var SMSServices = $.get(
		"/API/SMSServices"
	);

	var SessionServices = $.get(
		"/API/SessionServices"
	);
	
	$.when(SMSServices, SessionServices).done(function (SMSServicesResult, SessionServicesResult) {	
		var SMSServicesJSON = jQuery.parseJSON(SMSServicesResult[0]);
		var SessionServicesJSON = jQuery.parseJSON(SessionServicesResult[0]);
		var tableDiv = $('#services-table');
		tableDiv.html('');
		if (SMSServicesJSON.data || SessionServicesJSON.data)
		{
			var unactive = new Array();
			var unactive2 = new Array();
			tableDiv.html('<table class="table table-striped">\
			<thead><tr>\
				<th>Название сервиса</th>\
				<th>Тип</th>\
				<th>Страна</th>\
                <th>Информация</th>\
				<th>Статус</th>\
			</tr></thead>\
			<tbody></tbody>\
			</table>');
			var tbody = $('.table-striped tbody');
			if (SMSServicesJSON.data) {
			    SMSServicesJSON.data.forEach(function (entry) {
			        if (entry.status) {
			            var prefix = '';
			            if (entry.prefix) prefix = 'Prefix: ' + entry.prefix;

			            tbody.html(tbody.html() + '<tr>\
							<td>SMSService_' + entry.ID + '_' + entry.country + '</td>\
							<td>SMS Service</td>\
							<td>' + entry.country + '</td>\
							<td>' + prefix + '</td>\
							<td>Активен</td>\
							<td><span class="dotted-link" onclick="showServicePreferences(\'SMSServices\', ' + entry.ID + ')">Настройки</span></td>\
							<td><a href="/console/analytics/SMSServices/' + entry.ID + '">Статистика</a></td>\
							<td><a href="/docs/Premium_SMS_Protocol.docx">Документация</a></td>\
							<td><button class="btn btn-mini btn-danger" data-id="SMSServices' + entry.ID + '" onclick="deactivateService(\'SMSServices\', ' + entry.ID + ')">Деактивировать</button></td>\
						</tr>');
			        }
			        else unactive.push(entry);
			    });
			}
			
			if (SessionServicesJSON.data)
			{
				SessionServicesJSON.data.forEach(function (entry) {
					if (entry.status)
					{
						tbody.html(tbody.html() + '<tr>\
							<td>SessionService_' + entry.ID + '_' + entry.country + '</td>\
							<td>Session Service</td>\
							<td>' + entry.country + '</td>\
							<td>Client Service ID: ' + entry.client_service_ID + '</td>\
							<td>Активен</td>\
							<td><span class="dotted-link" onclick="showServicePreferences(\'SessionServices\', ' + entry.ID + ')">Настройки</span></td>\
							<td><a href="/console/analytics/SessionServices/' + entry.ID + '">Статистика</a></td>\
							<td><a href="/docs/Pseudo_Session_SMS_Protocol.docx">Документация</a></td>\
							<td><button class="btn btn-mini btn-danger" data-id="SessionServices' + entry.ID +  '" onclick="deactivateService(\'SessionServices\', ' + entry.ID + ')">Деактивировать</button></td>\
						</tr>');
					}
					else unactive2.push(entry);
				});
			}
			
			if (unactive.length)
			{
			    unactive.forEach(function (entry) {
			        var prefix = '';
			        if (entry.prefix) prefix = 'Prefix: ' + entry.prefix;


					tbody.html(tbody.html() + '<tr style="color:#aaaaaa;">\
						<td>SMSService_' + entry.ID + '_' + entry.country + '</td>\
						<td>SMS Service</td>\
						<td>' + entry.country + '</td>\
						<td>' + prefix + '</td>\
						<td>Неактивен</td>\
						<td></td>\
						<td><a href="/console/analytics/SMSServices/' + entry.ID + '">Статистика</a></td>\
						<td></td>\
						<td></td>\
					</tr>');
				});
			}
			
			if (unactive2.length)
			{
				unactive2.forEach(function (entry) {
					tbody.html(tbody.html() + '<tr style="color:#aaaaaa;">\
						<td>SessionService_' + entry.ID + '_' + entry.country + '</td>\
						<td>Session Service</td>\
						<td>' + entry.country + '</td>\
						<td>Client Service ID: ' + entry.client_service_ID + '</td>\
						<td>Неактивен</td>\
						<td></td>\
						<td><a href="/console/analytics/SessionServices/' + entry.ID + '">Статистика</a></td>\
						<td></td>\
						<td></td>\
					</tr>');
				});
			}
		}
	});
}

function deactivateService(type, id)
{
	if (confirm("Вы действительно хотите деактивировать данный сервис?")) {
		$.ajax({
		url: '/API/' + type + '/' + id,
		type: 'DELETE'
		});
		$('button[data-id="' + type + id + '"]').replaceWith("Сервис деактивирован");
	}
}

function showServicePreferences(type, id) {
    var prefs_div = $(".g-hidden");
    prefs_div.html('');
	$.get(
		"/API/" + type,
		function( result ) {
			var serviceJSON = (jQuery.parseJSON(result)).data;
			var count = serviceJSON.length;
			for (var i = 0; i < count; i++) {
			    if (serviceJSON[i].ID == id) {
			        switch (type) {
			            case 'SMSServices': {
			                prefs_div.html('<div class="box-modal" id="exampleModal1">\
							    <div class="box-modal_close arcticmodal-close">закрыть</div>\
							    <h2>Настройки сервиса</h2>\
							    <div class="form-horizontal">\
								    <div class="control-group">\
									    <label class="control-label">ID сервиса</label>\
									    <div class="controls"><input type="text" disabled value="' + id + '"></div>\
								    </div>\
								    <div class="control-group">\
									    <label class="control-label">Тип сервиса</label>\
									    <div class="controls"><input type="text" disabled value="' + type + '"></div>\
								    </div>\
								    <div class="control-group">\
									    <label class="control-label">Статический ответ</label>\
									    <div class="controls"><input id="response-static" type="text" value="' + serviceJSON[i].response_static + '"></div>\
								    </div>\
								    <div class="control-group">\
									    <label class="control-label">Динамический обработчик</label>\
									    <div class="controls" id="dynamic-radio">\
										    <label class="radio"><input name="dynamic" onclick="$(\'#dynamic-url\').removeAttr(\'disabled\');" type="radio" value="1">Да</label>\
										    <label class="radio"><input name="dynamic" onclick="$(\'#dynamic-url\').attr(\'disabled\', true);" type="radio" value="0">Нет</label>\
									    </div>\
								    </div>\
								    <div class="control-group">\
									    <label class="control-label">URL динамического обработчика</label>\
									    <div class="controls"><input id="dynamic-url" type="text" value="' + serviceJSON[i].dynamic_responder_URL + '"></div>\
								    </div>\
							    </div>\
							    <button style="float:right;" onclick="editServicePreferences(\'' + type + '\', ' + id + ')" class="btn btn-primary">Изменить настройки</button>\
							    <div class="clear-fix"></div>\
						    </div>');
			                if (!serviceJSON[i].is_dynamic) {
			                    $('#dynamic-radio label:nth-child(2) input').attr('checked', true);
			                    $('#dynamic-url').attr('disabled', true);
			                }
			                else {
			                    $('#dynamic-radio label:nth-child(1) input').attr('checked', true);
			                }


			                break;
			            }

			            case 'SessionServices': {
			                prefs_div.html('<div class="box-modal" id="exampleModal1">\
							    <div class="box-modal_close arcticmodal-close">закрыть</div>\
							    <h2>Настройки сервиса</h2>\
							    <div class="form-horizontal">\
								    <div class="control-group">\
									    <label class="control-label">ID сервиса</label>\
									    <div class="controls"><input type="text" disabled value="' + id + '"></div>\
								    </div>\
								    <div class="control-group">\
									    <label class="control-label">Тип сервиса</label>\
									    <div class="controls"><input type="text" disabled value="' + type + '"></div>\
								    </div>\
								    <div class="control-group">\
									    <label class="control-label">Тест по умолчанию</label>\
									    <div class="controls"><input id="default-text" type="text" value="' + serviceJSON[i].default_text + '"></div>\
								    </div>\
							    </div>\
							    <button style="float:right;" onclick="editServicePreferences(\'' + type + '\', ' + id + ')" class="btn btn-primary">Изменить настройки</button>\
							    <div class="clear-fix"></div>\
						    </div>');

			                break;
			            }
			        }
			        $('#exampleModal1').arcticmodal();
			        i = count;
			    }
			}
		}
	);
}

function editServicePreferences(type, id) {
    var url;
    switch (type) {
        case 'SMSServices': {
            var radio = $('input:radio[name=dynamic]:checked');
            var responseStatic = $('#response-static');
            var dynamicUrl = $('#dynamic-url');


            if (!responseStatic.val() || (radio.val() == 1 && !dynamicUrl.val())) {
                alert('Введите данные');
                return false;
            }

            url = '?response_static=' + responseStatic.val() + '&is_dynamic=' + radio.val();
            if (radio.val() == 1) {
                url = url + '&dynamic_responder_URL=' + dynamicUrl.val();
            }
            break;
        }
        case 'SessionServices': {
            var defaultText = $('#default-text');
            if (!defaultText.val()) {
                alert('Введите данные');
                return false;
            }
            url = '?default_text=' + defaultText.val();
            break;
        }
    }

    $('#exampleModal1 button').replaceWith('<span style="float:right; padding:5px 60px 5px 0;"><img src="/img/dots32.gif"></span>');

    $.post('/API/' + type + '/' + id + url)
		.done(function (msg) {
		    $('#exampleModal1').arcticmodal('close');
		})
		.fail(function (xhr, textStatus, errorThrown) {
		    var errorJSON = jQuery.parseJSON(xhr.responseText);
		    alert(errorJSON.reason);
		});
}

function showServiceCreation() {
    var prefs_div = $(".g-hidden");
    prefs_div.html('');
    prefs_div.html('<div class="box-modal" id="exampleModal1">\
							    <div class="box-modal_close arcticmodal-close">закрыть</div>\
							    <h2>Создание сервиса</h2>\
                                <div class="form-horizontal">\
                                    <div class="control-group">\
				                        <label class="control-label">Тип сервиса</label>\
				                        <div class="controls" id="dynamic-radio">\
					                        <label class="radio"><input name="service-type" type="radio" onclick="showCreationDiv(\'SessionServices\')" value="SessionServices">SessionServices</label>\
					                        <label class="radio"><input name="service-type" type="radio" onclick="showCreationDiv(\'SMSServices\')" value="SMSServices">SMSServices</label>\
				                        </div>\
			                        </div>\
                                </div>\
                                <div id="cr-div"></div>\
					</div>');
    $('#exampleModal1').arcticmodal();
}

function showCreationDiv(type) {
    var crDiv = $('#cr-div');
    crDiv.html('');
    $.get('/API/Countries', function (result) {
        

        var resultJSON = jQuery.parseJSON(result);
        var countrySelect = '<select size="1" id="country-select" onchange="getProviders();" name="country">';
        resultJSON.data.forEach(function (entry) {
            countrySelect = countrySelect + '<option value="' + entry.code + '">' + entry.name + '</option>';
        });
        countrySelect = countrySelect + '</select>';


        switch (type) {
            case 'SMSServices': {
                crDiv.html('<div class="form-horizontal">\
                                    <div class="control-group">\
									    <label class="control-label">Страна</label>\
									    <div class="controls">' + countrySelect + '</div>\
								    </div>\
                                    <div class="control-group">\
									    <label class="control-label">Провайдер</label>\
									    <div class="controls"><select size="1" id="provider-select" name="provider"></select></div>\
								    </div>\
								    <div class="control-group">\
									    <label class="control-label">Статический ответ</label>\
									    <div class="controls"><input id="response-static" type="text"></div>\
								    </div>\
								    <div class="control-group">\
									    <label class="control-label">Динамический обработчик</label>\
									    <div class="controls" id="dynamic-radio">\
										    <label class="radio"><input name="dynamic" onclick="$(\'#dynamic-url\').removeAttr(\'disabled\');" type="radio" checked value="1">Да</label>\
										    <label class="radio"><input name="dynamic" onclick="$(\'#dynamic-url\').attr(\'disabled\', true);" type="radio" value="0">Нет</label>\
									    </div>\
								    </div>\
								    <div class="control-group">\
									    <label class="control-label">URL динамического обработчика</label>\
									    <div class="controls"><input id="dynamic-url" type="text"></div>\
								    </div>\
							    </div>\
							    <button style="float:right;" onclick="createService(\'' + type + '\')" class="btn btn-primary">Создать сервис</button>\
							    <div class="clear-fix"></div>');
                break;
            }
            case 'SessionServices': {
                crDiv.html('<div class="form-horizontal">\
                                    <div class="control-group">\
									    <label class="control-label">Страна</label>\
									    <div class="controls">' + countrySelect + '</div>\
								    </div>\
                                    <div class="control-group">\
									    <label class="control-label">Провайдер</label>\
									    <div class="controls"><select size="1" id="provider-select" name="provider"></select></div>\
								    </div>\
                                    <div class="control-group">\
									    <label class="control-label">Статический ответ</label>\
									    <div class="controls"><input id="response-static" type="text"></div>\
								    </div>\
								    <div class="control-group">\
									    <label class="control-label">Динамический обработчик</label>\
									    <div class="controls" id="dynamic-radio">\
										    <label class="radio"><input name="dynamic" onclick="$(\'#dynamic-url\').removeAttr(\'disabled\');" type="radio" checked value="1">Да</label>\
										    <label class="radio"><input name="dynamic" onclick="$(\'#dynamic-url\').attr(\'disabled\', true);" type="radio" value="0">Нет</label>\
									    </div>\
								    </div>\
								    <div class="control-group">\
									    <label class="control-label">URL динамического обработчика</label>\
									    <div class="controls"><input id="dynamic-url" type="text"></div>\
								    </div>\
								    <div class="control-group">\
									    <label class="control-label">Текст по умолчанию</label>\
									    <div class="controls"><input id="default-text" type="text"></div>\
								    </div>\
							    </div>\
							    <button style="float:right;" onclick="createService(\'' + type + '\')" class="btn btn-primary">Создать сервис</button>\
							    <div class="clear-fix"></div>');
                break;
            }
        }
        getProviders();
    });
}



function createService(type) {
    var url;

    if (!$('#provider-select').val()) {
        alert('Выберите провайдера');
        return false;
    }

    switch (type) {
        case 'SMSServices': {
            var radio = $('input:radio[name=dynamic]:checked');
            var responseStatic = $('#response-static');
            var dynamicUrl = $('#dynamic-url');


            if (!responseStatic.val() || (radio.val() == 1 && !dynamicUrl.val())) {
                alert('Введите данные');
                return false;
            }

            url = '?response_static=' + responseStatic.val() + '&is_dynamic=' + radio.val() + '&country=' + $('#country-select').val() + '&provider_ID=' + $('#provider-select').val();
            if (radio.val() == 1) {
                url = url + '&dynamic_responder_URL=' + dynamicUrl.val();
            }
            break;
        }
        case 'SessionServices': {
            var defaultText = $('#default-text');
            var radio = $('input:radio[name=dynamic]:checked');
            var responseStatic = $('#response-static');
            var dynamicUrl = $('#dynamic-url');


            if (!defaultText.val() || !responseStatic.val() || (radio.val() == 1 && !dynamicUrl.val())) {
                alert('Введите данные');
                return false;
            }

            url = '?response_static=' + responseStatic.val() + '&is_dynamic=' + radio.val() + '&default_text=' + defaultText.val() + '&country=' + $('#country-select').val() + '&provider_ID=' + $('#provider-select').val();
            if (radio.val() == 1) {
                url = url + '&dynamic_responder_URL=' + dynamicUrl.val();
            }
            break;
        }
    }

    $('#exampleModal1 button').replaceWith('<span style="float:right; padding:5px 60px 5px 0;"><img src="/img/dots32.gif"></span>');

    $.post('/API/' + type + url)
		.done(function (msg) {
		    $('#exampleModal1').arcticmodal('close');
		    showServices();
		})
		.fail(function (xhr, textStatus, errorThrown) {
		    var errorJSON = jQuery.parseJSON(xhr.responseText);
		    alert(errorJSON.reason);
		});
}

function getProviders() {
    var provSelect = $('#provider-select');
    var countrySelect = $('#country-select');
    provSelect.html('');

    $.get('/API/SMSProviders', function (result) {
        var resultJSON = jQuery.parseJSON(result);

        resultJSON.data.forEach(function (entry) {
            if (entry.code == countrySelect.val()) {
                provSelect.html(provSelect.html() + '<option value="' + entry.ID + '">' + entry.name + '</option>');
            }
        });
    });
}