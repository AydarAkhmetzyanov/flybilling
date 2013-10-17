<?php

class PriceController extends Controller {
	
    public function getNumbers($country){
        echo Numbers::getNumbersByCountryJSON($country);
    }

    public function getPrices($number){
        echo Prices::getPricesJSON($number);
    }

}