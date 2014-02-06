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
				<th>Статус</th>\
			</tr></thead>\
			<tbody></tbody>\
			</table>');
			var tbody = $('.table-striped tbody');
			if (SMSServicesJSON.data)
			{
				SMSServicesJSON.data.forEach(function (entry) {
					if (entry.status == 1)
					{
						tbody.html(tbody.html() + '<tr>\
							<td>' + entry.prefix + '</td>\
							<td>SMS Service</td>\
							<td>' + entry.country + '</td>\
							<td>Активен</td>\
							<td><span class="dotted-link" onclick="showServicePreferences(\'SMSServices\', ' + entry.ID + ')">Настройки</span></td>\
							<td><a href="/console/analytics/SMSServices/' + entry.ID + '">Статистика</a></td>\
							<td><a href="/docs/Premium_SMS_Protocol.docx">Документация</a></td>\
							<td><button class="btn btn-mini btn-danger" data-id="SMSServices' + entry.ID +  '" onclick="deactivateService(\'SMSServices\', ' + entry.ID + ')">Деактивировать</button></td>\
						</tr>');
					}
					else unactive.push(entry);
				});
			}
			
			if (SessionServicesJSON.data)
			{
				SessionServicesJSON.data.forEach(function (entry) {
					if (entry.status == 1)
					{
						tbody.html(tbody.html() + '<tr>\
							<td>' + entry.default_text + '</td>\
							<td>Session Service</td>\
							<td>' + entry.country + '</td>\
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
					tbody.html(tbody.html() + '<tr style="color:#aaaaaa;">\
						<td>' + entry.prefix + '</td>\
						<td>SMS Service</td>\
						<td>' + entry.country + '</td>\
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
						<td>' + entry.default_text + '</td>\
						<td>Session Service</td>\
						<td>' + entry.country + '</td>\
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

function showServicePreferences(type, id)
{
	$.get(
		"/API/" + type,
		function( result ) {
			var serviceJSON = (jQuery.parseJSON(result)).data;
			var count = serviceJSON.length;
			for (var i = 0; i < count; i++) {
				if (serviceJSON[i].ID == id) {
					$(".g-hidden").html('<div class="box-modal" id="exampleModal1">\
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
									<label class="control-label">response_static</label>\
									<div class="controls"><input id="response-static" type="text" value="' + serviceJSON[i].response_static + '"></div>\
								</div>\
								<div class="control-group">\
									<label class="control-label">is_dynamic</label>\
									<div class="controls" id="dynamic-radio">\
										<label class="radio"><input name="dynamic" onclick="$(\'#dynamic-url\').removeAttr(\'disabled\');" type="radio" value="1">Да</label>\
										<label class="radio"><input name="dynamic" onclick="$(\'#dynamic-url\').attr(\'disabled\', true);" type="radio" value="0">Нет</label>\
									</div>\
								</div>\
								<div class="control-group">\
									<label class="control-label">dynamic_responder_URL</label>\
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
					$('#exampleModal1').arcticmodal();
					i = count;
				}
			}
		}
	);
}

function editServicePreferences(type, id) {
	$.post(
		'/API/' + type + '/' + id, {
			response_static: 'testing',
			is_dynamic: 1,
			dynamic_responder_URL: 'testing'
		})
		
		.done( function(msg) { alert(msg) } )
		.fail( function(xhr, textStatus, errorThrown) {
				var errorJSON = jQuery.parseJSON(xhr.responseText);
				alert(errorJSON.reason);
		});
}

function createService(type) {
	$.post(
		'/API/' + type, {
			response_static: $('#response-static2').val(),
			is_dynamic: $('input:radio[name=dynamic2]:checked').val(),
			dynamic_responder_URL: $('#dynamic-url2').val()
		})
		.done( function(msg) { alert(msg) } )
		.fail( function(xhr, textStatus, errorThrown) {
				var errorJSON = jQuery.parseJSON(xhr.responseText);
				alert(errorJSON.reason);
			});
}

function showServiceCreation()
{
	$('#exampleModal2').arcticmodal();						
}