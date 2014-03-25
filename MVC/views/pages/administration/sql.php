<div class="page-inner page-inner-console">

<div class="g-hidden"></div>

<div class="top-promo">
            <div class="container ">
                <div class="hero-unit">
                    <h1><?=$title?></h1>
                    <div class="promo-3angl-1" data-stellar-ratio="2" data-stellar-vertical-offset="80" data-stellar-horizontal-offset="100"></div>
                    <div class="promo-3angl-2" data-stellar-ratio="1.5"  data-stellar-vertical-offset="80" data-stellar-horizontal-offset="100"></div>
                </div>
            </div>
            <div class="promo-3angl-3" data-stellar-ratio="1.5"  data-stellar-vertical-offset="70"></div>
            <div class="promo-top-bottom"></div>
        </div>

        <div class=" container-fluid content">
            <div class="polygon-2" data-stellar-ratio="0.3"  data-stellar-vertical-offset="250"></div>
            <div class="content-inner">
                <!--content-->

                <div class="row-fluid">
                   <div class="span12">
                    <form method="get">
                        <fieldset>

<textarea class="input-block-level" rows="3" name="query"><?=$query?></textarea>
                   
  <input type="submit" class="btn btn-primary btn-large btn-block" value="Execute">
 </form>
                    </fieldset>
                </div>



                    <?php 
if($result!=false){
?>
                    <div>
                        <h3>Result</h3>
                    <table class="table table-striped table-condensed table-bordered table-hover">
  <thead>
    <tr>
      <th><?php echo implode('</th><th>', array_keys($result[0])); ?></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($result as $row): array_map('htmlentities', $row); ?>
    <tr>
      <td><?php echo implode('</td><td>', $row); ?></td>
    </tr>
<?php endforeach; ?>
  <tbody>
</table>
                    </div>

                    <?php
}
                    ?>



                    <?php 
if($error!=false){
?>
                    <div>
                        <h3>Error</h3>
                   <?=$error?>
                    </div>

                    <?php
}
                    ?>

                    </div>
                <!--/content-->
                </div>
            </div>
        </div>
        
</div>