<?php

class SqlController extends Controller {
    
	public function index(){
		if(Clients::isAdmin()){
	        $data = array();
            $data['title'] = 'Database SQL query';
		
            $data['newGuest']=false;
        
		    renderView('header', $data);
            echo '<body class="page-main"><div id="wrap">';
            renderView('adminMenu', $data);


            
            $data['error']=false;
            if(isset($_GET['query']) and !empty($_GET['query'])){
                $data['query']=$_GET['query'];
                $tsql      = $_GET['query'];
		        $statement = Database::getInstance()->prepare($tsql);
                try{
                    $statement->execute();
		            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
		            if (count($rows) > 0) {
		            	$data['result']=$rows;
		            } else {
		            	$data['result']=false;
		            }
                } catch(PDOException $e) {
                    $data['result']=false;
                    $data['error']=$e->getMessage();
                }
		        
            } else {
                $data['result']=false;
                $data['query']='SELECT * FROM '.SCHEMA.'.[Clients];';
            }

		    renderView('pages/administration/sql', $data);
		    renderView('consoleFooter', $data);
		} else {
            redirect('administration');
        }
	}


}