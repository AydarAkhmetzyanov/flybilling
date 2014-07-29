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

<textarea id="ID_AUTHOR" class="input-block-level" rows="3" name="query"><?=$query?></textarea>
                   
  <input type="submit" style="border-radius: 0px; background-color: #ff8e00; border: 1px solid #fff; color: #fff; padding: 20px; font-weight: 900; width: 100%; font-size: 20px ;" value="Execute">
 </form>
                    </fieldset>
                </div>


<script type="text/javascript">
function getText_author(str)
{
  document.getElementById('ID_AUTHOR').value = str.firstChild.data;
}
</script>
 

 
<a href="javascript:void(0)" onclick="getText_author(this)">SELECT [service_ID],sum([client_share]) as [clientshare],sum([external_share]) as [external] FROM [payway].[SMS] group by [service_ID]</a><br><br>
<a href="javascript:void(0)" onclick="getText_author(this)">SELECT * FROM [payway].[Clients],[payway].[ClientsPrivateData] WHERE [payway].[Clients].[ID]=[payway].[ClientsPrivateData].[ID];</a><br><br>
<a href="javascript:void(0)" onclick="getText_author(this)">SELECT -(sum([client_share])-sum([external_share]))  FROM [payway].[SMS]</a><br><br>
<a href="javascript:void(0)" onclick="getText_author(this)">SELECT [external_operator],sum([client_share]) as [clientshare],sum([external_share]) as [external] FROM [payway].[SMS] group by [external_operator]</a><br><br>
<a href="javascript:void(0)" onclick="getText_author(this)">SELECT [sender_country],sum([client_share]) as [clientshare],sum([external_share]) as [external] FROM [payway].[SMS] group by [sender_country]</a><br><br>
<a href="javascript:void(0)" onclick="getText_author(this)">INSERT INTO [dbo].[payway] 
(country, prefix, response_static, is_dynamic, dynamic_responder_URL, share, status, client_ID, provider_ID,is_pseudo) 
VALUES ('ru', N'kmbord566', 'response', 1, 'http://flybill.ru/test.php', 80, 1, клиентайди, провайдерайди, 0);</a><br><br>
<a href="javascript:void(0)" onclick="getText_author(this)">Автор4</a><br><br>
<a href="javascript:void(0)" onclick="getText_author(this)">Автор4</a><br><br>
<a href="javascript:void(0)" onclick="getText_author(this)">Автор4</a><br><br>
<a href="javascript:void(0)" onclick="getText_author(this)">Автор4</a><br><br>
<a href="javascript:void(0)" onclick="getText_author(this)">Автор4</a><br><br>
<a href="javascript:void(0)" onclick="getText_author(this)">Автор4</a><a class ="btn btn-info btn-large" href="http://payway.org" onMouseOver="click('')">текст ссылки</a>

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
