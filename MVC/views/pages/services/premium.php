<?php echo HTML::includeJS('price');?>
        
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
                <h2>Описание услуги</h2>
                <p>
                    Премиум СМС - самый распространенный и простой вид оплаты с мобильного телефона. 
                    Абоненту нужно отправить смс на номер вида 1111 с сообщением XXXXXX - и с него снимут фиксированную сумму согласно его оператору и короткому номеру.
                </p>
                <h2>Как работает услуга</h2>					

							<p>1. Абонент отправляет ключевое слово на&nbsp;короткий номер (например, «RED 123456» на&nbsp;4449);</p>

							<p>2. С абонента списывается сумма соответствующая стоимости номера</p>

							<p>3. Далее, ответное сообщение доставляется абоненту.</p>

               <h2 id="rates">Тарифы</h2>
                





                <div class="row" id="priceRow" pers="0.93">
        <div class="span3">
        
        
						<fieldset>
							<label>Выберите страну</label>
							<select onChange="countrySelected()" id="countrySelect">
                                <?php foreach ($countries as $row) {//todo exiting countries
     echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
 }
     ?>
							</select>
                            <label>Выберите короткий номер</label>
						</fieldset>
        <table class="table table-hover table-striped">
  <thead><tr><th>Короткий номер</th><th>Цена для абонента</th><th>Предпрефикс</th></tr></thead>
            <tbody id="numbersTBody"></tbody>
</table>

        </div>
        <div class="span9">
        <h4>Расценки для основных операторов</h4>


            <p>Для остальных операторов страны, стоимость и доход примерно равны средней стоимости для номера</p>

<p>* Цены по КН указанны с НДС.</p>

<p>Внимание, информация для абонентов МТС!
Стоимость доступа к услугам контент-провайдера устанавливается Вашим оператором. Подробную информацию можно узнать:
- в разделе «Услуги по коротким номерам» на сайте www.mts.ru
- в контактном центре по телефону 8 800 333 0890 (0890 для абонентов МТС).</p>

        <table class="table table-striped">
  <thead>
            <tr>
            <th rowspan="2">Оператор</th> <th rowspan="2">Цена для абонента</th><th>Ваш доход</th>
        </tr>
            </thead>
            <tbody id="pricesTBody">
                
            </tbody>
</table>
        
        
        
        
        
        
        
        </div>
        </div>

















                 </div>
        </div>