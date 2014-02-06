<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
	</script>
<?php echo HTML::includeJS('lib/dateformat');?>
<?php echo HTML::includeJS('lib/date');?>
<?php echo HTML::includeJS('lib/daterangepicker');?>
<?php echo HTML::includeJS('analytics');?>


<div class="page-inner page-inner-console">

<div class="top-promo">
            <div class="container">
                <div class="hero-unit">
                    <h1 id="pageName">Статистика</h1>
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
                            <h2>Настройки отображения</h2>
                            <div class="analytics-pref">
								<div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; margin-bottom:10px;">
									<i class="icon-calendar icon-large"></i>
									<span>Выберите период</span> <b class="caret" style="float:right; margin-top: 8px"></b>
								</div>
                                <div class="control-group">
                                    <label class="control-label">Группировка</label>
									<div class="controls">
										<select size="1" name="group">
											<option value="day"> По дням </option>
											<option value="month"> По месяцам </option>
											<option value="year"> По годам </option>
										</select>
									</div>
                                </div>
                                <button class="btn btn-primary" onclick="recount()">Пересчитать</button>
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
                            <h2>Список SMS</h2>
                            <div class="notice" id="notifsDiv">
								<img src="/img/dots64.gif">
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        
</div>