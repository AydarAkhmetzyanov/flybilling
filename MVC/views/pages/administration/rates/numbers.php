<?php echo HTML::includeJS('administration/rates/numbers');?>

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
							






                            <h3>Добавить номер</h3>
<form id="addNumberForm" onsubmit="addNumber();return false;" class="form-inline">
  <input id="addedNumber" name="number" required type="text" class="input-small" placeholder="номер">
  <div class="input-append"><input required name="price" type="text" id="addedPrice" class="input-small" placeholder="средняя цена"><span class="add-on">руб.</span></div>
    <input name="preprefix" type="text" id="addedPrice" class="input-small" placeholder="predprefix">
    <select name="country" class="span2">
       <?php foreach ($countries as $row) {
     echo '<option value="'.$row['ID'].'">'.$row['name'].'</option>';
 }
     ?>
						</select>
    <select name="agregator" class="span2">
        <?php foreach ($agregators as $row) {
     echo '<option value="'.$row['ID'].'">'.$row['name'].'</option>';
 }
     ?>
						</select>
  <button type="submit" class="btn">Добавить</button>
</form>


                            <h3>Изменить номер</h3>
<table class="table table-striped">
						<thead>
							<tr>
								<th>Номер</th>
								<th>Средняя стоимость</th><th>Предпрефикс</th>
								<th>Страна</th>
								<th>Агрегатор</th>
							</tr>
						</thead>
						<tbody id="numbersTableBody">
							
                                <?php foreach ($numbers as $number) {?>
                                <tr id="numberRow<?=$number['ID']?>"><form id="number<?=$number['ID']?>">
								<td>
                                    <input required name="number" type="text" value="<?=$number['number']?>" class="input-small" placeholder="номер">
                                 </td>
								<td>
                                  <div class="input-append"><input required value="<?=$number['price']/100?>" name="price" type="text" class="input-small" placeholder="средняя цена"><span class="add-on">руб.</span></div>
                                </td>
                                    <td>
                                 <input value="<?=$number['preprefix']?>" name="preprefix" type="text" class="input-small" placeholder="preprefix">
                                </td>
								<td>
                                <select name="country" class="span2">
      <?php foreach ($countries as $row) {
     echo '<option ' ;
     if($row['ID']==$number['country_id']) echo 'selected' ;
     echo ' value="'.$row['ID'].'">'.$row['name'].'</option>';
 }
     ?>
						</select>
                                </td>
								<td><select name="agregator" class="span2">
       <?php foreach ($agregators as $row) {
     echo '<option ';
     if($row['ID']==$number['agregator_id']) echo 'selected' ;
     echo ' value="'.$row['ID'].'">'.$row['name'].'</option>';
 }
     ?>
						</select></td>
                                <td>
                                <a class="btn btn-link" onclick="saveNumber(<?=$number['ID']?>,this);" ><i class="icon-ok icon-gray"></i></a>
                                <a class="btn btn-link" onclick="deleteNumber(<?=$number['ID']?>);" ><i class="icon-remove icon-gray"></i></a>
                                </td>
                                    </form></tr>
                               <?php }
     ?>

						</tbody>
					</table>



                        </div>
                    </div>
                </div>

                <!--/content-->
                </div>
            </div>
        </div>
        
</div>