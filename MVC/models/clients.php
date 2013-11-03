<?php

class Clients extends Model
{

	public $data;
    protected static $instance;

    public static function getInstance($id=0) {
        if ( is_null(self::$instance) ) {
            self::$instance = new Clients($id);
        }
        return self::$instance;
    }

    private  function __construct($id) {
        if($id==0){
            $this->data = Clients::getClient($_SESSION['ID']);
        } else {
            $this->data = Clients::getClient($id);
        }
    }

   public static function logOut(){
	    unset($_SESSION['ID']);
	}
	
	public static function isAuth(){
	    if(isset($_SESSION['ID'])){
		    return true;
		} else {
		    return false;
		}
	}

    public static function getClient($id){
	    $tsql="SELECT * FROM ".SCHEMA.".[Clients] WHERE [ID]=:ID;";
        $statement = Database::getInstance()->prepare($tsql);
        $params=array( 'ID'=>$id );
        $statement->execute($params);
        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        if(count($row)>0){
            return $row[0];
        } else {
            return FALSE;
        }
	}

}
