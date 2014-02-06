<?php echo HTML::includeJS('jquery.arcticmodal-0.3.min');?>
<?php echo HTML::includeJS('services');?>

<div class="page-inner page-inner-console">

<div class="g-hidden"></div>

<div class="g-hidden2">
	<div class="box-modal" id="exampleModal2">
		<div class="box-modal_close arcticmodal-close">закрыть</div>
		<h2>Создание сервиса</h2>
		<div class="form-horizontal">
		
			<div class="control-group">
				<label class="control-label">Тип сервиса</label>
				<div class="controls" id="dynamic-radio">
					<label class="radio"><input name="service-type" type="radio" onclick="$('#session-services-div').show(); $('#sms-services-div').hide();" value="SessionServices">SessionServices</label>
					<label class="radio"><input name="service-type" type="radio" onclick="$('#session-services-div').hide(); $('#sms-services-div').show();" value="SMSServices">SMSServices</label>
				</div>
			</div>
			
			<div id="session-services-div" style="display:none;">
				<div class="control-group">
					<label class="control-label">response_static (session)</label>
					<div class="controls"><input id="response-static2" type="text"></div>
				</div>
				<div class="control-group">
					<label class="control-label">is_dynamic</label>
					<div class="controls" id="dynamic-radio2">
						<label class="radio"><input name="dynamic2" checked onclick="$('#dynamic-url2').removeAttr('disabled');" type="radio" value="1">Да</label>
						<label class="radio"><input name="dynamic2" onclick="$('#dynamic-url2').attr('disabled', true);" type="radio" value="0">Нет</label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">dynamic_responder_URL</label>
					<div class="controls"><input id="dynamic-url2" type="text"></div>
				</div>
				<button style="float:right;" onclick="createService('SessionServices')" class="btn btn-primary">Создать сервис (Session)</button>
			</div>
			
			<div id="sms-services-div" style="display:none;">
				<div class="control-group">
					<label class="control-label">response_static (sms)</label>
					<div class="controls"><input id="response-static3" type="text"></div>
				</div>
				<div class="control-group">
					<label class="control-label">is_dynamic</label>
					<div class="controls" id="dynamic-radio3">
						<label class="radio"><input name="dynamic3" checked onclick="$('#dynamic-url3').removeAttr('disabled');" type="radio" value="1">Да</label>
						<label class="radio"><input name="dynamic3" onclick="$('#dynamic-url3').attr('disabled', true);" type="radio" value="0">Нет</label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">dynamic_responder_URL</label>
					<div class="controls"><input id="dynamic-url3" type="text"></div>
				</div>
				<button style="float:right;" onclick="createService('SMSServices')" class="btn btn-primary">Создать сервис (SMS)</button>
			</div>
			
		</div>
		<div class="clear-fix"></div>
	</div>
</div>

<div class="top-promo">
            <div class="container">
                <div class="hero-unit">
                    <h1>Сервисы</h1>
                    <div class="promo-3angl-1" data-stellar-ratio="2" data-stellar-vertical-offset="80" data-stellar-horizontal-offset="100"></div>
                    <div class="promo-3angl-2" data-stellar-ratio="1.5"  data-stellar-vertical-offset="80" data-stellar-horizontal-offset="100"></div>
                </div>
            </div>
            <div class="promo-3angl-3" data-stellar-ratio="1.5"  data-stellar-vertical-offset="70"></div>
            <div class="promo-top-bottom"></div>
        </div>

        <div class="container content">
            <div class="polygon-2" data-stellar-ratio="0.3"  data-stellar-vertical-offset="250"></div>

            <div class="content-inner">
					<button class="btn btn-primary btn-large btn-block" onclick="showServiceCreation();">Создать сервис</button>
					<div id="services-table" style="margin-top:15px; text-align:center;"><img src="/img/dots64.gif"></div>
            </div>
        </div>
        
</div>