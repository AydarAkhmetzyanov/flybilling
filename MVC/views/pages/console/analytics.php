<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
	</script>
<?php echo HTML::includeJS('lib/dateformat');?>
<?php echo HTML::includeJS('lib/date');?>
<?php echo HTML::includeJS('lib/daterangepicker');?>
<?php echo HTML::includeJS('lib/moment.min');?>


<div class="page-inner page-inner-console">

<div class="top-promosub">
            <div class="container">
                <div class="hero-unit">
                    <br><br>
                    <h1 id="pageName">Статистика</h1>
                    
                </div>
            </div>
            
        </div>

        <div class="container content">
            

            <div class="content-inner">
                <div class="row">
                    <div class="span4">
                        <div class="console-block console-block-summary" style="height: 270px;">
                            <h2>Настройки отображения</h2>
                            <div class="analytics-pref">
								<div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; margin-bottom:20px;">
									<i class="icon-calendar icon-large"></i>
									<span>Этот месяц</span> <b class="caret" style="float:right; margin-top: 8px"></b>
								</div>
								<div class="control-group">
                                    <label class="control-label">Сервис</label>
									<div class="controls">
										<select size="1" id="service-select" disabled name="service">
										<option value="all"> Все сервисы </option>
										</select>
									</div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Группировка</label>
									<div class="controls">
										<select size="1" id="group-select" name="group">
											<option value="none"> Нет </option>
											<option value="hour"> По часам </option>
											<option value="day"> По дням </option>
											<option value="month"> По месяцам </option>
											<option value="year"> По годам </option>
										</select>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="span8">
                        <div class="console-block console-block-graph" style="height: 270px;">
                            <h2>График доходов</h2>
							<div id="chart_div" style="width: 750px; height: 200px; margin-top:-25px; margin-left:-20px; text-align:center;"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="span4" style="width:1170px !important;">
                        <div class="console-block console-block-notice">
                            <h2>Список SMS</h2>
                            <div class="notice" id="notifsDiv">
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        
</div>

<?php echo HTML::includeJS('analytics');?>