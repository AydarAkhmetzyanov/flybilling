<?php echo HTML::includeJS('price');?>
<div class="top-promo-bgsub"><img src="img/hero-bg.png"></div>        
        <div class="top-promosub">
            <div class="container">
                <div class="hero-unit">
                    <h1><?=$title?></h1>
                  
                </div>
            </div>
           
        </div>

        <div class="container content">
            

            <div class="content-inner">
                <h2>Описание услуги</h2>
                <p>
                   Абонент вводит на сайте свой номер телефона, и ему приходит сообщение от короткого номера, ответив на которое он получает свою услугу. Таким образом псевдо подписка позволяет привязать короткий номер к сайту. 
                </p>
                <h2>Как работает услуга</h2>					

							<p>1. Пользователь вводит номер телефона на вашем сайте.</p>

							<p>2. Вы отправляете нам запрос на исходящее сообщение этому абоненту через API.</p>

							<p>3. Пользователь получает СМС. Чтобы получить доступ, отправьте ответное сообщение с любым текстом.</p>

                <p>4. Как только приходит сообщение, мы передаем вам данные о входещем сообщении и начисляем вам деньги.</p>

               <h2 id="rates">Тарифы</h2>
                
                <p>Стоимость исходящего сообщение составляет 13 копеек. Входящие сообщения тарифицируются как обычные Премиум СМС.</p>




               <div class="row" id="priceRow" pers="<?php if(isset($_GET['offer'])){echo base64_decode($_GET['offer']);} else {echo '0.93';}?>">
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
            <tbody id="numbersTBody"></tbody>
</table>

        </div>
        <div class="span9">
        <h4>Расценки для основных операторов Премиум СМС</h4>


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