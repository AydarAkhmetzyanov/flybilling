<?php echo HTML::includeJS('jquery.arcticmodal-0.3.min');?>
<?php echo HTML::includeJS('services');?>

<div class="page-inner page-inner-console">

<div class="g-hidden"></div>

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