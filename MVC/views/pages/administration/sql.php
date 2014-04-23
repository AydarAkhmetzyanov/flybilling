<div class="page-inner page-inner-console">

<div class="g-hidden"></div>

<div class="top-promo-bgsub"><img src="img/hero-bg.png"></div>
        <div class="top-promosub">
            <div class="container">
                <div class="hero-unit">
                    <br><br>
                    <h1><?=$title?></h1>
                    
                </div>
            </div>
           
        </div>

        <div class=" container-fluid content">
            
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