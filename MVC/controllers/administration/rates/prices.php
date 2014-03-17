<?php

class PricesController extends Controller {
    
	public function index($change=0){
		if(Clients::isAdmin()){
	        $data = array();
            $data['title'] = 'Prices';
		
            $data['newGuest']=false;
        
		    renderView('header', $data);
            echo '<body class="page-main"><div id="wrap">';
            renderView('adminMenu', $data);

            $data['numbers'] = Numbers::getNumbers()->fetchAll();

        if(isset($_POST['number'])){
            $data['prices'] = Prices::getPrices($_POST['number']);
            if($data['prices']!=false){
                $data['prices'] = $data['prices']->fetchAll();
            }
        }

        renderView('pages/administration/rates/prices', $data);

		    renderView('consoleFooter', $data);
		} else {
            redirect('administration');
        }
	}

    public function ajax_addprice(){
        Prices::addPrice();
    }

    public function ajax_saveprice(){
        Prices::savePrice();
    }

    public function ajax_deleteprice($id){
        Prices::deletePrice($id);
    }

}