<?php echo HTML::includeJS('registration');?>

        <div class="top-promo">
            <div class="container">
                <div class="hero-unit">
                    <h1><?=$title?></h1>
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
	<form action="/registration/submit" method="post" class="form-horizontal">		
		<div class="control-group">
			<label class="control-label">Введите ваш Email</label>
			<div class="controls">
				<input required name="email" type="email" placeholder="Email">
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Введите ваш пароль</label>
			<div class="controls">
				<input required pattern=".{6,}" name="password" onkeyup="passwordValidate();" onblur="passwordValidate();" type="password" placeholder="Минимум 6 символов">
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Подтвердите пароль</label>
			<div class="controls">
				<input required pattern=".{6,}" name="passwordRepeat" onkeyup="passwordValidate();" onblur="passwordValidate();" type="password" placeholder="">
				<span id="passwordCheck"></span>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Язык</label>
			<div class="controls">
				<label class="radio">
				<input type="radio" name="language" value="ru" checked>
				Русский </label>
				<label class="radio">
				<input type="radio" name="language" value="en">
				Английский </label>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Часовой пояс</label>
			<div class="controls">
				<select size="1" name="timezone">
					<option value="-12.0"> (GMT -12:00) Эниветок, Кваджалейн </option>
					<option value="-11.0"> (GMT -11:00) Остров Мидуэй, Самоа </option>
					<option value="-10.0"> (GMT -10:00) Гавайи </option>
					<option value="-9.0"> (GMT -9:00) Аляска </option>
					<option value="-8.0"> (GMT -8:00) Тихоокеанское время (США и Канада) </option>
					<option value="-7.0"> (GMT -7:00) Горное время (США и Канада) </option>
					<option value="-6.0"> (GMT -6:00) Центральное время (США и Канада), Мехико</option>
					<option value="-5.0"> (GMT -5:00) Восточное время (США и Канада), Богота, Лима </option>
					<option value="-4.0"> (GMT -4:00) Атлантическое время (Канада), Каракас, Ла-Пас </option>
					<option value="-3.5"> (GMT -3:30) Ньюфаундленд </option>
					<option value="-3.0"> (GMT -3:00) Бразилия, Буэнос-Айрес, Джорджтаун </option>
					<option value="-2.0"> (GMT -2:00) Срединно-Атлантического </option>
					<option value="-1.0"> (GMT -1:00 час) Азорские острова, острова Зеленого Мыса </option>
					<option value="0.0"> (GMT) Время Западной Европы, Лондон, Лиссабон, Касабланка </option>
					<option value="1.0"> (GMT +1:00 час) Брюссель, Копенгаген, Мадрид, Париж </option>
					<option value="2.0"> (GMT +2:00) Киев, Калининград, Южная Африка </option>
					<option value="3.0"> (GMT +3:00) Багдад, Эр-Рияд</option>
					<option value="3.5"> (GMT +3:30) Тегеран </option>
					<option value="4.0" selected> (GMT +4:00) Москва, Санкт-Петербург, Баку, Тбилиси</option>
					<option value="4.5"> (GMT +4:30) Кабул </option>
					<option value="5.0"> (GMT +5:00) Екатеринбург, Исламабад, Карачи, Ташкент</option>
					<option value="5.5"> (GMT +5:30) Бомбей, Калькутта, Мадрас, Нью-Дели</option>
					<option value="5.75"> (GMT +5:45) Катманду</option>
					<option value="6.0"> (GMT +6:00) Алматы, Дакке, Коломбо </option>
					<option value="7.0"> (GMT +7:00) Бангкок, Ханой, Джакарта</option>
					<option value="8.0"> (GMT +8:00) Пекин, Перт, Сингапур, Гонконг</option>
					<option value="9.0"> (GMT +9:00) Токио, Сеул, Осака, Саппоро, Якутск</option>
					<option value="9.5"> (GMT +9:30) Аделаида, Дарвин </option>
					<option value="10.0"> (GMT +10:00) Восточная Австралия, Гуам, Владивосток </option>
					<option value="11.0"> (GMT +11:00) Магадан, Соломоновы острова, Новая Каледония</option>
					<option value="12.0"> (GMT +12:00) Окленд, Веллингтон, Фиджи, Камчатка</option>
				</select>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Контактный телефон</label>
			<div class="controls">
				<input required name="phone" type="tel" placeholder="+7 900 909-51-33">
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">ICQ</label>
			<div class="controls">
				<input required name="icq" type="text" placeholder="">
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Название проекта</label>
			<div class="controls">
				<input required name="serviceName" type="text" placeholder="Интернет-магазин">
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Адрес сайта</label>
			<div class="controls">
				<input required type="url" name="serviceURL" placeholder="http://example.ru">
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Зарегистрироваться как</label>
			<div class="controls">
				<label class="radio">
				<input onclick="openCompany();" type="radio" name="accountType" id="optionsAccountCompany" value="1">
				юридическое лицо и выводить средства на расчетный счет в банке </label>
				<label class="radio">
				<input onclick="openPP();" type="radio" name="accountType" id="optionsAccountPP" value="2">
				индивидуальный предприниматель и выводить средства на расчетный счет в банке </label>
				<label class="radio">
				<input onclick="openPerson();" type="radio" name="accountType" id="optionsAccountPerson" value="3">
				физическое лицо и получать средства на электронный кошелек по требованию </label>
			</div>
		</div>
		
		<div id="personData">
			<legend>Платёжные данные физического лица</legend>
			
			<div class="control-group">
				<label class="control-label">Имя</label>
				<div class="controls">
					<input required name="firstName" type="text" placeholder="Имя">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Фамилия</label>
				<div class="controls">
					<input required name="secondName" type="text" placeholder="Фамилия">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Номер кошелька WMR начинается с заглавной R</label>
				<div class="controls">
					<input name="WMR" pattern="[R]{1}[0-9]{12}" maxlength="13" type="text" placeholder="R123456789123">
				</div>
			</div>
		</div>
		<div id="ppData">
			<legend>Реквизиты индивидуального предпринимателя</legend>
			
			<div class="control-group">
				<label class="control-label">Полное наименование индивидуального предпринимателя согласно свидетельству о регистрации</label>
				<div class="controls">
					<input required name="PName" type="text" placeholder="ИП 'Иванов Иван Иванович'">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Индивидуальный предприниматель, ФИО</label>
				<div class="controls">
					<input required name="PFIO" type="text" placeholder="Иванов Иван Иванович">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">ИНН Вашей организации</label>
				<div class="controls">
					<input required pattern="[0-9]{12}" maxlength="12" name="PINN" type="text" placeholder="12 знаков">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">ОГРНИП Вашей организации</label>
				<div class="controls">
					<input required pattern="[0-9]{15}" maxlength="15" name="POGRN" type="text" placeholder="15 знаков">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Свидетельство о государственной регистрации физического лица в качестве индивидуального предпринимателя (серия - номер)</label>
				<div class="controls">
					<input required pattern="[0-9]{2}[-][0-9]{9}" maxlength="12" name="PSGRN" type="text" placeholder="12-123456789">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Свидетельство о государственной регистрации физического лица в качестве индивидуального предпринимателя (дата выдачи)</label>
				<div class="controls">
					<input required pattern="[0-9]{2}[-][0-9]{2}[-][0-9]{4}" maxlength="10" name="PSGRD" type="text" placeholder="дд-мм-гггг">
				</div>
			</div>
			
		</div>
		<div id="companyData">
			<legend>Реквизиты юридического лица</legend>
			
			<div class="control-group">
				<label class="control-label">Юридическое имя организации согласно уставу или свидетельству о регистрации</label>
				<div class="controls">
					<input required name="CName" type="text" placeholder="Полное наименование">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">ИНН Вашей организации</label>
				<div class="controls">
					<input required pattern="[0-9]{10}" maxlength="10" name="CINN" type="text" placeholder="10 знаков">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">КПП Вашей организации</label>
				<div class="controls">
					<input required pattern="[0-9]{9}" maxlength="9" name="CKPP" type="text" placeholder="9 знаков">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">ОГРН Вашей организации</label>
				<div class="controls">
					<input required pattern="[0-9]{13}" maxlength="13" name="COGRN" type="text" placeholder="13 знаков">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">ФИО подписанта</label>
				<div class="controls">
					<input required name="CFIO" type="text" placeholder="Иванов Иван Иванович">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">ФИО подписанта в родительском падаже</label>
				<div class="controls">
					<input required name="CFIOR" type="text" placeholder="Иванова Ивана Ивановича">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Должность подписанта</label>
				<div class="controls">
					<input required name="CPPos" type="text" placeholder="Генеральный директор/Главный бухгалтер">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Документ, подтверждающий полномочия Подписанта в родительском падеже</label>
				<div class="controls">
					<input required name="CPDoc" type="text" placeholder="Устава/доверенности №_от_">
				</div>
			</div>
		</div>
		<div id="companyUData">
		
			<div class="control-group">
				<label class="control-label">Юридический адрес</label>
				<div class="controls">
					<input required name="UAddr" type="text" placeholder="Адрес, номер офиса, индекс">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Почтовый адрес</label>
				<div class="controls">
					<input required name="UPostAddr" type="text" placeholder="Адрес, номер офиса, индекс">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Ставка НДС</label>
				<div class="controls">
					<label class="radio">
					<input type="radio" name="accountNDS" value="18">
					Организация является плательщиком НДС по ставке 18% </label>
					<label class="radio">
					<input type="radio" name="accountNDS" value="10">
					Организация является плательщиком НДС по ставке 10% </label>
					<label class="radio">
					<input type="radio" name="accountNDS" value="0" checked>
					Организация не является плательщиком НДС, в связи с применением упрощенной системы налогообложения </label>
				</div>
			</div>
			
		</div>
		<div id="bankData">
			<legend>Платежные данные</legend>
			
			<div class="control-group">
				<label class="control-label">Наименование банка</label>
				<div class="controls">
					<input required name="bankName" type="text" placeholder="Полное наименование банка">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">БИК</label>
				<div class="controls">
					<input required name="bankBIK" pattern="[0-9]{9}" maxlength="9" type="text" placeholder="9 знаков">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Корреспондентский счет</label>
				<div class="controls">
					<input required name="bankKor" pattern="[0-9]{20}" type="text" placeholder="20 знаков">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Расчетный счет</label>
				<div class="controls">
					<input required name="bankAcc" pattern="[0-9]{20}" type="text" placeholder="20 знаков">
				</div>
			</div>
		</div>
		<div id="regFinish" class="control-group">
			<div class="controls">
				<label class="checkbox">
				<input onclick="showSubmit();" id="submitCheck" type="checkbox">Я согласен/согласна на обработку и хранение персональных данных для подключения услуг.</input>
				</label>
				<button type="submit" id="completeReg" style="display: none;" class="btn">Завершить регистрацию</button>
			</div>
		</div>
	</form>
</div>
</div>