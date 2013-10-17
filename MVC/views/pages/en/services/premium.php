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
                <h2>Payment type description</h2>
                <p>
                   Most popular micropayment type. Subscriber sends sms to short number and pay for your service. Price is fixed by service provider.
                </p>
                <h2>How it works</h2>					

							<p>1. Subscriber send message to short number (example: "RED 123456");</p>

							<p>2. Service provider withdraws money from subscriber according to short number rate;</p>

							<p>3. Subscriber recieve message that your specify, for example access code;</p>

               <h2 id="rates">Rates</h2>
                





                <div class="row" id="priceRow" pers="0.93">
        <div class="span3">
        
        
						<fieldset>
							<label><?=HTML::getString('services_premium_select_a_country');?></label>
							<select onChange="countrySelected()" id="countrySelect">
                                <?php foreach ($countries as $row) {//todo exiting countries
     echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
 }
     ?>
							</select>
                            <label><?=HTML::getString('Select_a_country');?></label>
						</fieldset>
        <table class="table table-hover table-striped">
  <thead><tr><th><?=HTML::getString('Short_number');?></th><th><?=HTML::getString('Price_for_subscriber');?></th><th><?=HTML::getString('Subprefix');?></th></tr></thead>
            <tbody id="numbersTBody"></tbody>
</table>

        </div>
        <div class="span9">
        <h4><?=HTML::getString('Rates_for_common_providers');?></h4>


            <p><?=HTML::getString('For_other_providers_rates_');?></p>

        <table class="table table-striped">
  <thead>
            <tr>
            <th rowspan="2"><?=HTML::getString('Provider');?></th> <th rowspan="2"><?=HTML::getString('Price_for_subscriber');?></th><th><?=HTML::getString('Your_income');?></th>
        </tr>
            </thead>
            <tbody id="pricesTBody">
                
            </tbody>
</table>
        </div>
        </div>

















                 </div>
        </div>