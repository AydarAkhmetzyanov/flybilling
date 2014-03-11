<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" itemscope itemtype="http://schema.org/Organization"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?=$title?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta itemprop="name" content="<?=BRNAD?>">
        <meta itemprop="description" content="<?=SHORT_BRAND?> — лучший СМС биллинг">

		<?php echo HTML::includeCSS('bootstrap.min');?>
		<?php echo HTML::includeCSS('bootstrap-responsive.min');?>
		<?php echo HTML::includeCSS('main');?>
		
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        
        <link rel="icon" type="image/x-icon" href="favicon.ico" />
        <?php echo HTML::includeJS('lib/modernizr-2.6.2-respond-1.1.0.min');?>
    </head>