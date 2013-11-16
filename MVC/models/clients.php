<?php

class Clients extends Model
{
	public $data;
	protected static $instance;
	
	public static function getInstance($id = 0)
	{
		if (is_null(self::$instance)) {
			self::$instance = new Clients($id);
		}
		return self::$instance;
	}
	
	private function __construct($id)
	{
		if ($id == 0) {
			$this->data = Clients::getClient($_SESSION['ID']);
		} else {
			$this->data = Clients::getClient($id);
		}
	}
	
	public static function logOut()
	{
		unset($_SESSION['ID']);
	}
	
	public static function isAuth()
	{
		if (isset($_SESSION['ID'])) {
			return true;
		} else {
			return false;
		}
	}
	
	public static function getClient($id)
	{
		$tsql      = "SELECT * FROM " . SCHEMA . ".[Clients] WHERE [ID]=:ID;";
		$statement = Database::getInstance()->prepare($tsql);
		$params    = array(
			'ID' => $id
		);
		$statement->execute($params);
		$row = $statement->fetchAll(PDO::FETCH_ASSOC);
		if (count($row) > 0) {
			return $row[0];
		} else {
			return FALSE;
		}
	}
	
	public static function registration($secret)
	{
		global $db;
		$data = array(
			$_POST['email'], //email
			Pass::generateString(16), //tech_key
			0, //balance
			Pass::password_hash($_POST['password'], PASSWORD_DEFAULT), //password
			$_POST['timezone'], //timezone
			$_POST['language'], //language
			$_SERVER['REMOTE_ADDR'], //ip
			$_POST['language'], //country
			1 //status
		);
		
		$data2 = array(
			$_POST['phone'],
			$_POST['icq'],
			$_POST['serviceName'],
			$_POST['serviceURL'],
			$_POST['accountType'],
			$_POST['firstName'],
			$_POST['secondName'],
			$_POST['WMR'],
			$_POST['PName'],
			$_POST['PFIO'],
			$_POST['PINN'],
			$_POST['POGRN'],
			$_POST['PSGRN'],
			$_POST['PSGRD'],
			$_POST['CName'],
			$_POST['CINN'],
			$_POST['CKPP'],
			$_POST['COGRN'],
			$_POST['CFIO'],
			$_POST['CFIOR'],
			$_POST['CPPos'],
			$_POST['CPDoc'],
			$_POST['UAddr'],
			$_POST['UPostAddr'],
			$_POST['accountNDS'],
			$_POST['bankName'],
			$_POST['bankBIK'],
			$_POST['bankKor'],
			$_POST['bankAcc'],
			$secret,
			0
		);
		
		$tsql="INSERT INTO ".SCHEMA.".[Clients] 
               (email, tech_key, balance, password, timezone, language, ip, country, status) 
               VALUES (?,?,?,?,?,?,?,?,?);";
		$tsql2="INSERT INTO ".SCHEMA.".[ClientsPrivateData] 
               (phone, icq, serviceName, serviceURL, accountType, firstName, secondName, WMR, PName, PFIO, PINN, POGRN, PSGRN, PSGRD, CName, CINN, CKPP, COGRN, CFIO, CFIOR, CPPos, CPDoc, UAddr, UPostAddr, accountNDS, bankName, bankBIK, bankKor, bankAcc, emailActivationCode, emailActivated) 
               VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
        $statement = Database::getInstance()->prepare($tsql);
		$statement2 = Database::getInstance()->prepare($tsql2);
        try{
            $statement->execute($data);
			$statement2->execute($data2);
            return TRUE;
        } catch(PDOException $e) {
            API_helper::failResponse($e->getMessage().' SQL query: '.$tsql,500); exit();
            return FALSE;
        }
	}
	
	public static function regComplete($secret, $email)
	{
		/*global $db;
		$stmt = $db->prepare('
			    UPDATE `users` SET `emailActivated`=1 WHERE `email` = :email and `emailActivationCode` = :emailActivationCode LIMIT 1
		    ');
		$stmt->execute(array(
			'email' => $email,
			'emailActivationCode' => $secret
		));
		$stmt = $db->prepare('
			    SELECT `id`, `email`, `accountType`, `serviceName` FROM `users` WHERE `email` = :email
		    ');
		$stmt->execute(array(
			'email' => $email
		));
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$table                   = $stmt->fetch();
		$_SESSION['id']          = $table['id'];
		$_SESSION['email']       = $table['email'];
		$_SESSION['accountType'] = $table['accountType'];
		$_SESSION['serviceName'] = $table['serviceName']; */
	}
	
}
