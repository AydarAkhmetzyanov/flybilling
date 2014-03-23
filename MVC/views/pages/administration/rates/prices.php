<?php echo HTML::includeJS('administration/rates/prices');?>

<div class="page-inner page-inner-console">

<div class="g-hidden"></div>

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
                <!--content-->

                <div class="row">
                    <div class="span2">
                            <h3>Rates</h3>
                            <li><a href="/administration/rates/">Numbers</a></li>
				            <li><a href="/administration/rates/prices">Prices</a></li>
                            <li><a href="/administration/rates/providers">Providers</a></li>
                    </div>
                    <div class="span10">
                        <div class="console-block console-block-graph">
                            <h2><?=$title?></h2>
							
                            <h3>Выберите номер</h3>
<form id="selectNumber" method="POST" class="form-inline">
    <select name="number" class="span3">
       <?php foreach ($numbers as $number) {
     $realPrice=$number['price']/100;
     echo '<option ';
     if(@$_POST['number']==$number['ID']){
	 echo 'selected';
	 }
     echo ' value="'.$number['ID'].'">'.$number['country'].' '.$number['number'].' '.$realPrice.'руб.</option>';
 }
     ?>
						</select>
  <button type="submit" class="btn">Выбрать</button>
</form>

                            <?php
if(isset($_POST['number'])){ ?>
                            
                            <h3>Добавить цену</h3>
<form id="addPrice" onsubmit="addPrice();return false;" class="form-inline">
    <td><input required="true" name="operator" type="text" value="" class="input-medium" placeholder="оператор"></td>
<div class="input-append"><input required name="cost" type="text" id="addedCost" class="input-small" placeholder="Цена для абонента"><span class="add-on">руб.</span></div>
    <div class="input-append"><input required name="share" type="text" id="addedShare" class="input-small" placeholder="Доход"><span class="add-on">руб.</span></div>
    <input type="hidden" name="number" value="<?=$_POST['number']?>">
  <button type="submit" class="btn">Добавить</button>
</form>
<h2>Стоимость для разных операторов</h2>
<table class="table table-striped">
						<thead>
							<tr>
								<th>Оператор</th>
								<th>Цена для абонента</th>
								<th>Доход</th>
							</tr>
						</thead>
						<tbody id="pricesTableBody">
							
                            <?php foreach ($prices as $price) {?>
                                <tr id="priceRow<?=$price['ID']?>"><form id="price<?=$price['ID']?>">
								<td><input required="true" name="operator" type="text" value="<?=$price['operator_short_name']?>" class="input-medium" placeholder="оператор"></td>

<td><div class="input-append"><input required name="cost" type="text" id="addedCost" class="input-small" value="<?=$price['cost']/100?>" placeholder="Цена для абонента"><span class="add-on">руб.</span></div></td>
   <td> <div class="input-append"><input required name="share" type="text" id="addedShare" class="input-small" value="<?=$price['share']/100?>" placeholder="Доход"><span class="add-on">руб.</span></div></td>
    <input type="hidden" name="number" value="<?=$_POST['number']?>">
<input type="hidden" name="id" value="<?=$price['ID']?>">
                                <td>
                                <a class="btn btn-link" onclick="savePrice(<?=$price['ID']?>,this);"><i class="icon-ok icon-gray"></i></a>
                                <a class="btn btn-link" onclick="deletePrice(<?=$price['ID']?>);"><i class="icon-remove icon-gray"></i></a>
                                </td>
                                    </form></tr>
                               <?php }
     ?>
						</tbody>
					</table>
                            
                            
                            <?php }    ?>



                        </div>
                    </div>
                </div>

                <!--/content-->
                </div>
            </div>
        </div>
        
</div>