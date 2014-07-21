<?php

class IndexController extends Controller {
    
	public function index($change=0){
		if(Clients::isAdmin()){
	        $data = array();
            $data['title'] = 'Numbers';
		
            $data['newGuest']=false;
        
		    renderView('header', $data);
            echo '<body class="page-main"><div id="wrap">';
            renderView('adminMenu', $data);

            $data['agregators'] = Agregators::getAgregators()->fetchAll();

                $data['countries'] = Countries::getCountries();
            
        
            $data['numbers'] = Numbers::getNumbers();
            if($data['numbers']!=false){
                $data['numbers'] = $data['numbers']->fetchAll();
            }

		    renderView('pages/administration/rates/numbers', $data);
		    renderView('consoleFooter', $data);
		} else {
            redirect('administration');
        }
	}

    public function ajax_addnumber(){
        Numbers::addNumber();
    }

    public function ajax_savenumber(){
        Numbers::saveNumber();
    }

    public function ajax_deletenumber($id){
        Numbers::deleteNumber($id);
    }

}