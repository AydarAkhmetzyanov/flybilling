<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
	</script>
<?php echo HTML::includeJS('lib/dateformat');?>
<?php echo HTML::includeJS('jquery.arcticmodal-0.3.min');?>
<?php echo HTML::includeJS('console');?>

<div class="page-inner page-inner-console">

<div class="g-hidden"></div>

<div class="top-promo">
            <div class="container">
                <div class="hero-unit">
                    <h1>Кабинет пользователя</h1>
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
                <div class="row">
                    <div class="span4">
                        <div class="console-block console-block-summary">
                            <h2>Сводка</h2>
                            <div class="console-summary">
                                <div class="field">
                                    <div class="title">Доход за сегодня:</div>
                                    <div class="status" id="todayProfitArrow"></div>
                                    <div class="count" id="todayProfit"><img src="/img/arrows16.gif"></div>
                                </div>
                                <div class="field">
                                    <div class="title">Доход за 7 дней:</div>
                                    <div class="status" id="weekProfitArrow"></div>
                                    <div class="count" id="weekProfit"><img src="/img/arrows16.gif"></div>
                                </div>
                                <div class="field">
                                    <div class="title">Доход за 30 дней:</div>
                                    <div class="status" id="monthProfitArrow"></div>
                                    <div class="count" id="monthProfit"><img src="/img/arrows16.gif"></div>
                                </div>
                                <div class="field field-balance">
                                    <div class="title">Баланс:</div>
                                    <div class="status"></div>
                                    <div class="count"><?php echo number_format(Clients::getInstance()->data['balance'], 2, ',', ' '); ?> <s>Р</s></div>
                                    <br>
                                    <a href="#" class="btn btn-primary">Вывод средств</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="span8">
                        <div class="console-block console-block-graph">
                            <h2>График доходов</h2>
							<div id="chart_div" style="width: 728px; height: 200px; margin-top:-25px; text-align:center;"><img style="margin-top:90px;" src="/img/dots64.gif"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="span4" style="width:1170px !important;">
                        <div class="console-block console-block-notice">
							<span class="btn btn-primary" style="float:right; margin:26px 0;" onclick="addTicket()">Задать вопрос специалисту</span>
                            <h2>Уведомления и новости</h2>
                            <div class="notice" id="notifsDiv">
								<img src="/img/dots64.gif">
                            </div>
                            <!-- <a href="#" class="btn btn-default">Читать далее</a> -->
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        
</div>