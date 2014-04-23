<?php
$id = Clients::getInstance()->data['ID'];
$client = Clients::getClient($id);
$data = Clients::getClientData($id);
?>
<?php echo HTML::includeJS('profile');?>
<div class="page-inner page-inner-console">

<div class="top-promo-bgsub"><img src="img/hero-bg.png"></div>
        <div class="top-promosub">
            <div class="container">
                <div class="hero-unit">
                    <br><br>
                    
                    <h1>Редактирование профиля</h1>
                    
                </div>
            </div>
            
        </div>

        <div class="container content">
          

        <div class="content-inner">
		<form action="/profile/submit" id="profile-form" name="reg" method="post" class="form-horizontal">	
		
		<div class="control-group">
			<label class="control-label">Введите старый пароль</label>
			<div class="controls">
				<input pattern=".{6,}" name="oldPassword" type="password">
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Введите новый пароль</label>
			<div class="controls">
				<input pattern=".{6,}" name="password" onkeyup="passwordValidate();" onblur="passwordValidate();" type="password" placeholder="Минимум 6 символов">
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Подтвердите новый пароль</label>
			<div class="controls">
				<input pattern=".{6,}" name="passwordRepeat" onkeyup="passwordValidate();" onblur="passwordValidate();" type="password" placeholder="">
				<span id="passwordCheck" class="datacheck"></span>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Язык</label>
			<div class="controls">
				<label class="radio">
				<input type="radio" name="language" value="ru" <?php if ($client['language'] == 'ru') echo 'checked';?>>
				Русский </label>
				<label class="radio">
				<input type="radio" name="language" value="en" <?php if ($client['language'] == 'en') echo 'checked';?>>
				Английский </label>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Часовой пояс</label>
			<div class="controls">
				<select size="1" name="timezone">
					<option value="-12.0" <?php if ($client['timezone'] == -12.0) echo 'selected';?>> (GMT -12:00) Эниветок, Кваджалейн </option>
					<option value="-11.0" <?php if ($client['timezone'] == -11.0) echo 'selected';?>> (GMT -11:00) Остров Мидуэй, Самоа </option>
					<option value="-10.0" <?php if ($client['timezone'] == -10.0) echo 'selected';?>> (GMT -10:00) Гавайи </option>
					<option value="-9.0" <?php if ($client['timezone'] == -9.0) echo 'selected';?>> (GMT -9:00) Аляска </option>
					<option value="-8.0" <?php if ($client['timezone'] == -8.0) echo 'selected';?>> (GMT -8:00) Тихоокеанское время (США и Канада) </option>
					<option value="-7.0" <?php if ($client['timezone'] == -7.0) echo 'selected';?>> (GMT -7:00) Горное время (США и Канада) </option>
					<option value="-6.0" <?php if ($client['timezone'] == -6.0) echo 'selected';?>> (GMT -6:00) Центральное время (США и Канада), Мехико</option>
					<option value="-5.0" <?php if ($client['timezone'] == -5.0) echo 'selected';?>> (GMT -5:00) Восточное время (США и Канада), Богота, Лима </option>
					<option value="-4.0" <?php if ($client['timezone'] == -4.0) echo 'selected';?>> (GMT -4:00) Атлантическое время (Канада), Каракас, Ла-Пас </option>
					<option value="-3.5" <?php if ($client['timezone'] == -3.5) echo 'selected';?>> (GMT -3:30) Ньюфаундленд </option>
					<option value="-3.0" <?php if ($client['timezone'] == -3.0) echo 'selected';?>> (GMT -3:00) Бразилия, Буэнос-Айрес, Джорджтаун </option>
					<option value="-2.0" <?php if ($client['timezone'] == -2.0) echo 'selected';?>> (GMT -2:00) Срединно-Атлантического </option>
					<option value="-1.0" <?php if ($client['timezone'] == -1.0) echo 'selected';?>> (GMT -1:00 час) Азорские острова, острова Зеленого Мыса </option>
					<option value="0.0" <?php if ($client['timezone'] == 0.0) echo 'selected';?>> (GMT) Время Западной Европы, Лондон, Лиссабон, Касабланка </option>
					<option value="1.0" <?php if ($client['timezone'] == 1.0) echo 'selected';?>> (GMT +1:00 час) Брюссель, Копенгаген, Мадрид, Париж </option>
					<option value="2.0" <?php if ($client['timezone'] == 2.0) echo 'selected';?>> (GMT +2:00) Киев, Калининград, Южная Африка </option>
					<option value="3.0" <?php if ($client['timezone'] == 3.0) echo 'selected';?>> (GMT +3:00) Багдад, Эр-Рияд</option>
					<option value="3.5" <?php if ($client['timezone'] == 3.5) echo 'selected';?>> (GMT +3:30) Тегеран </option>
					<option value="4.0" <?php if ($client['timezone'] == 4.0) echo 'selected';?>>(GMT +4:00) Москва, Санкт-Петербург, Баку, Тбилиси</option>
					<option value="4.5" <?php if ($client['timezone'] == 4.5) echo 'selected';?>> (GMT +4:30) Кабул </option>
					<option value="5.0" <?php if ($client['timezone'] == 5.0) echo 'selected';?>> (GMT +5:00) Екатеринбург, Исламабад, Карачи, Ташкент</option>
					<option value="5.5" <?php if ($client['timezone'] == 5.5) echo 'selected';?>> (GMT +5:30) Бомбей, Калькутта, Мадрас, Нью-Дели</option>
					<option value="5.75" <?php if ($client['timezone'] == 5.75) echo 'selected';?>> (GMT +5:45) Катманду</option>
					<option value="6.0" <?php if ($client['timezone'] == 6.0) echo 'selected';?>> (GMT +6:00) Алматы, Дакке, Коломбо </option>
					<option value="7.0" <?php if ($client['timezone'] == 7.0) echo 'selected';?>> (GMT +7:00) Бангкок, Ханой, Джакарта</option>
					<option value="8.0" <?php if ($client['timezone'] == 8.0) echo 'selected';?>> (GMT +8:00) Пекин, Перт, Сингапур, Гонконг</option>
					<option value="9.0" <?php if ($client['timezone'] == 9.0) echo 'selected';?>> (GMT +9:00) Токио, Сеул, Осака, Саппоро, Якутск</option>
					<option value="9.5" <?php if ($client['timezone'] == 9.5) echo 'selected';?>> (GMT +9:30) Аделаида, Дарвин </option>
					<option value="10.0" <?php if ($client['timezone'] == 10.0) echo 'selected';?>> (GMT +10:00) Восточная Австралия, Гуам, Владивосток </option>
					<option value="11.0" <?php if ($client['timezone'] == 11.0) echo 'selected';?>> (GMT +11:00) Магадан, Соломоновы острова, Новая Каледония</option>
					<option value="12.0" <?php if ($client['timezone'] == 12.0) echo 'selected';?>> (GMT +12:00) Окленд, Веллингтон, Фиджи, Камчатка</option>
				</select>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Контактный телефон<span class="red">*</span></label>
			<div class="controls">
				<input required name="phone" type="tel" placeholder="+7 900 909-51-33" value="<?php echo $data['phone']; ?>">
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">ICQ</label>
			<div class="controls">
				<input name="icq" pattern="[0-9]{5,9}" maxlength="9" type="text" placeholder="" value="<?php echo $data['icq']; ?>">
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Название проекта<span class="red">*</span></label>
			<div class="controls">
				<input required name="serviceName" type="text" placeholder="Интернет-магазин" value="<?php echo $data['serviceName']; ?>">
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Адрес сайта<span class="red">*</span></label>
			<div class="controls">
				<input required type="url" name="serviceURL" placeholder="http://example.ru" value="<?php echo $data['serviceURL']; ?>">
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Зарегистрироваться как<span class="red">*</span></label>
			<div class="controls">
				<label class="radio">
				<input onclick="openCompany();" type="radio" name="accountType" id="optionsAccountCompany" value="1" <?php if ($data['accountType'] == 1) echo 'checked'; ?>>
				юридическое лицо и выводить средства на расчетный счет в банке </label>
				<label class="radio">
				<input onclick="openPP();" type="radio" name="accountType" id="optionsAccountPP" value="2" <?php if ($data['accountType'] == 2) echo 'checked'; ?>>
				индивидуальный предприниматель и выводить средства на расчетный счет в банке </label>
				<label class="radio">
				<input onclick="openPerson();" type="radio" name="accountType" id="optionsAccountPerson" value="3" <?php if ($data['accountType'] == 3) echo 'checked'; ?>>
				физическое лицо и получать средства на электронный кошелек по требованию </label>
			</div>
		</div>
		
		<div id="personData">
			<legend>Платёжные данные физического лица</legend>
			
			<div class="control-group">
				<label class="control-label">Имя<span class="red">*</span></label>
				<div class="controls">
					<input required name="firstName" type="text" placeholder="Имя" value="<?php echo $data['firstName']; ?>">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Фамилия<span class="red">*</span></label>
				<div class="controls">
					<input required name="secondName" type="text" placeholder="Фамилия" value="<?php echo $data['secondName']; ?>">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Номер кошелька WMR (начинается с заглавной R)<span class="red">*</span></label>
				<div class="controls">
					<input name="WMR" pattern="[R]{1}[0-9]{12}" maxlength="13" type="text" placeholder="R123456789123" value="<?php echo $data['WMR']; ?>">
				</div>
			</div>
		</div>
		<div id="ppData">
			<legend>Реквизиты индивидуального предпринимателя</legend>
			
			<div class="control-group">
				<label class="control-label">Полное наименование индивидуального предпринимателя согласно свидетельству о регистрации<span class="red">*</span></label>
				<div class="controls">
					<input required name="PName" type="text" placeholder="ИП 'Иванов Иван Иванович'" value="<?php echo $data['PName']; ?>">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Индивидуальный предприниматель, ФИО<span class="red">*</span></label>
				<div class="controls">
					<input required name="PFIO" type="text" placeholder="Иванов Иван Иванович" value="<?php echo $data['PFIO']; ?>">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">ИНН Вашей организации<span class="red">*</span></label>
				<div class="controls">
					<input required pattern="[0-9]{12}" maxlength="12" name="PINN" type="text" placeholder="12 знаков" value="<?php echo $data['PINN']; ?>">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">ОГРНИП Вашей организации<span class="red">*</span></label>
				<div class="controls">
					<input required pattern="[0-9]{15}" maxlength="15" name="POGRN" type="text" placeholder="15 знаков" value="<?php echo $data['POGRN']; ?>">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Свидетельство о государственной регистрации физического лица в качестве индивидуального предпринимателя (серия - номер)<span class="red">*</span></label>
				<div class="controls">
					<input required pattern="[0-9]{2}[-][0-9]{9}" maxlength="12" name="PSGRN" type="text" placeholder="12-123456789" value="<?php echo $data['PSGRN']; ?>">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Свидетельство о государственной регистрации физического лица в качестве индивидуального предпринимателя (дата выдачи)<span class="red">*</span></label>
				<div class="controls">
					<input required pattern="[0-9]{2}[-][0-9]{2}[-][0-9]{4}" maxlength="10" name="PSGRD" type="text" placeholder="дд-мм-гггг" value="<?php echo $data['PSGRD']; ?>">
				</div>
			</div>
			
		</div>
		<div id="companyData">
			<legend>Реквизиты юридического лица</legend>
			
			<div class="control-group">
				<label class="control-label">Юридическое имя организации согласно уставу или свидетельству о регистрации<span class="red">*</span></label>
				<div class="controls">
					<input required name="CName" type="text" placeholder="Полное наименование" value="<?php echo $data['CName']; ?>">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">ИНН Вашей организации<span class="red">*</span></label>
				<div class="controls">
					<input required pattern="[0-9]{10}" maxlength="10" name="CINN" type="text" placeholder="10 знаков" value="<?php echo $data['CINN']; ?>">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">КПП Вашей организации<span class="red">*</span></label>
				<div class="controls">
					<input required pattern="[0-9]{9}" maxlength="9" name="CKPP" type="text" placeholder="9 знаков" value="<?php echo $data['CKPP']; ?>">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">ОГРН Вашей организации<span class="red">*</span></label>
				<div class="controls">
					<input required pattern="[0-9]{13}" maxlength="13" name="COGRN" type="text" placeholder="13 знаков" value="<?php echo $data['COGRN']; ?>">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">ФИО подписанта<span class="red">*</span></label>
				<div class="controls">
					<input required name="CFIO" type="text" placeholder="Иванов Иван Иванович" value="<?php echo $data['CFIO']; ?>">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">ФИО подписанта в родительском падаже<span class="red">*</span></label>
				<div class="controls">
					<input required name="CFIOR" type="text" placeholder="Иванова Ивана Ивановича" value="<?php echo $data['CFIOR']; ?>">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Должность подписанта<span class="red">*</span></label>
				<div class="controls">
					<input required name="CPPos" type="text" placeholder="Генеральный директор/Главный бухгалтер" value="<?php echo $data['CPPos']; ?>">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Документ, подтверждающий полномочия Подписанта в родительском падеже<span class="red">*</span></label>
				<div class="controls">
					<input required name="CPDoc" type="text" placeholder="Устава/доверенности №_от_" value="<?php echo $data['CPDoc']; ?>">
				</div>
			</div>
		</div>
		<div id="companyUData">
		
			<div class="control-group">
				<label class="control-label">Юридический адрес<span class="red">*</span></label>
				<div class="controls">
					<input required name="UAddr" type="text" placeholder="Адрес, номер офиса, индекс" value="<?php echo $data['UAddr']; ?>">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Почтовый адрес<span class="red">*</span></label>
				<div class="controls">
					<input required name="UPostAddr" type="text" placeholder="Адрес, номер офиса, индекс" value="<?php echo $data['UPostAddr']; ?>">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Ставка НДС<span class="red">*</span></label>
				<div class="controls">
					<label class="radio">
					<input type="radio" name="accountNDS" value="18" <?php if ($data['accountNDS'] == 18) echo 'checked'; ?>>
					Организация является плательщиком НДС по ставке 18% </label>
					<label class="radio">
					<input type="radio" name="accountNDS" value="10" <?php if ($data['accountNDS'] == 10) echo 'checked'; ?>>
					Организация является плательщиком НДС по ставке 10% </label>
					<label class="radio">
					<input type="radio" name="accountNDS" value="0" <?php if ($data['accountNDS'] == 0) echo 'checked'; ?>>
					Организация не является плательщиком НДС, в связи с применением упрощенной системы налогообложения </label>
				</div>
			</div>
			
		</div>
		<div id="bankData">
			<legend>Платежные данные</legend>
			
			<div class="control-group">
				<label class="control-label">Наименование банка<span class="red">*</span></label>
				<div class="controls">
					<input required name="bankName" type="text" placeholder="Полное наименование банка" value="<?php echo $data['bankName']; ?>">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">БИК<span class="red">*</span></label>
				<div class="controls">
					<input required name="bankBIK" pattern="[0-9]{9}" maxlength="9" type="text" placeholder="9 знаков" value="<?php echo $data['bankBIK']; ?>">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Корреспондентский счет<span class="red">*</span></label>
				<div class="controls">
					<input required name="bankKor" pattern="[0-9]{20}" type="text" placeholder="20 знаков" value="<?php echo $data['bankKor']; ?>">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Расчетный счет<span class="red">*</span></label>
				<div class="controls">
					<input required name="bankAcc" pattern="[0-9]{20}" type="text" placeholder="20 знаков" value="<?php echo $data['bankAcc']; ?>">
				</div>
			</div>
		</div>
		
		<div id="regFinish" class="control-group">
			<div class="controls">
				<button type="submit" id="completeReg" class="btn">Изменить профиль</button>
			</div>
		</div>
	</form>
            </div>
        </div>
        
</div>

<script>
$("#profile-form").on('submit', function(e){
	if (($( "input[name='password']" ).val() || $( "input[name='passwordRepeat']" ).val()) && !$( "input[name='oldPassword']" ).val()) {
		e.preventDefault();
		alert('Чтобы сменить пароль, необходимо указать старый пароль');
	}
	
	if ($( "input[name='password']" ).val() && $( "input[name='passwordRepeat']" ).val() && $( "input[name='oldPassword']" ).val()) {
		e.preventDefault();
		$.post(
			"/profile/checkPassword", {
				password: $( "input[name='oldPassword']" ).val()
			})
			.done( function(msg) {
				if (msg == 'uncorrect') {
					alert('Вы ввели неверный старый пароль');
				}
				else {
					$("#profile-form").off('submit').submit();
				}
			} );
	}
});
</script>