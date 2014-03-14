<?php echo HTML::includeJS('jquery.arcticmodal-0.3.min');?>
<?php echo HTML::includeJS('lib/dateformat');?>
<script>var summ = <?php echo number_format(Clients::getInstance()->data['balance'], 2, '.', ''); ?>;</script>
<?php echo HTML::includeJS('withdrawals');?>

<div class="page-inner page-inner-console">

<div class="g-hidden"></div>

<div class="top-promosub">
            <div class="container">
                <div class="hero-unit">
                    <br><br>
                    <h1>Вывод средств</h1>
                    
                </div>
            </div>
            
        </div>

        <div class="container content">
            

            <div class="content-inner">
					<?php if (Clients::getInstance()->data['balance']) : ?>
						<button class="btn btn-primary btn-large btn-block" onclick="showWithdrawalCreation();">Вывести средства</button>
					<?php endif; ?>
					<div id="withdrawals-table" style="margin-top:15px; text-align:center;"><img src="/img/dots64.gif"></div>
            </div>
        </div>
        
</div>