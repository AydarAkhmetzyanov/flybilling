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
		if ($id === 0) {
			$this->data = Clients::getClient($_SESSION['id']);
		} else {
			$this->data = Clients::getClient($id);
		}
	}
	
	public static function logOut()
	{
		unset($_SESSION['id']);
	}
	
	public static function isAuth()
	{
		if (isset($_SESSION['id'])) {
			return true;
		} else {
			return false;
		}
	}
	
	public static function isAdmin()
	{
		if (isset($_SESSION['isAdmin'])) {
			return true;
		} else {
			return false;
		}
	}

    public static function update($data){
        $params=array();
        $requiredParams=array('ID','api_signature');
        foreach($data as $key=>$value){
            if(!in_array($key, $requiredParams)) {
                unset($data[$key]);
            }
        }
        $fieldexists=true;
        foreach($requiredParams as $key=>$value){
            if(!in_array($value,array_keys($data))) {
                $fieldexists = false;
                $field=$value;
            }
        }
        if($fieldexists==false){ API_helper::failResponse('field required: '.$field,400); exit(); }
        $params=$data;
        $tsql="UPDATE ".SCHEMA.".[Clients] 
        SET [api_signature]=:api_signature
        WHERE [ID]=:ID ;";
        $statement = Database::getInstance()->prepare($tsql);
        try{
            $statement->execute($params);
            return TRUE;
        } catch(PDOException $e) {
            API_helper::failResponse($e->getMessage().' SQL query: '.$tsql,500); exit();
            return FALSE;
        }
        }
	
	public static function updateProfile($data){
		$id = Clients::getInstance()->data['ID'];
        $params1=array();
		$params2=array();
		if ($data['password']) $params1['password'] = Pass::password_hash($data['password'], PASSWORD_DEFAULT);
		$params1['language'] = $data['language'];
		$params1['timezone'] = $data['timezone'];
		unset($data['password']);
		unset($data['oldPassword']);
		unset($data['passwordRepeat']);
		unset($data['language']);
		unset($data['timezone']);
		$params2 = $data;
		
		$tsql = "UPDATE ".SCHEMA.".[Clients] SET ";
		foreach($params1 as $key=>$value){
            $tsql = $tsql."[".$key."] = :".$key.", ";
        }
		$tsql = substr($tsql,0,-2);
		$tsql = $tsql." WHERE [ID]=".$id.";";
		
		$tsql2 = "UPDATE ".SCHEMA.".[ClientsPrivateData] SET ";
		foreach($params2 as $key=>$value){
            $tsql2 = $tsql2."[".$key."] = :".$key.", ";
        }
		$tsql2 = substr($tsql2,0,-2);
		$tsql2 = $tsql2." WHERE [ID]=".$id.";";
		
        $statement = Database::getInstance()->prepare($tsql);
		$statement2 = Database::getInstance()->prepare($tsql2);
        try{
            $statement->execute($params1);
			$statement2->execute($params2);
            return TRUE;
        } catch(PDOException $e) {
            API_helper::failResponse($e->getMessage().' SQL query: '.$tsql,500); exit();
            return FALSE;
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
	
	public static function getClientData($id)
	{
		$tsql      = "SELECT * FROM " . SCHEMA . ".[ClientsPrivateData] WHERE [ID]=:ID;";
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
		$data = array(
			$_POST['email'], //email
			Pass::generateString(16), //tech_key
			0, //balance
			Pass::password_hash($_POST['password'], PASSWORD_DEFAULT), //password
			$_POST['timezone'], //timezone
			$_POST['language'], //language
			$_SERVER['REMOTE_ADDR'], //ip
			$_POST['language'], //country
			1, //status
			$secret,
			0
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
			$_POST['bankAcc']
		);
		
		$tsql       = "INSERT INTO " . SCHEMA . ".[Clients] 
               (email, tech_key, balance, password, timezone, language, ip, country, status, emailActivationCode, emailActivated) 
               VALUES (?,?,?,?,?,?,?,?,?,?,?);";
		$tsql2      = "INSERT INTO " . SCHEMA . ".[ClientsPrivateData] 
               (phone, icq, serviceName, serviceURL, accountType, firstName, secondName, WMR, PName, PFIO, PINN, POGRN, PSGRN, PSGRD, CName, CINN, CKPP, COGRN, CFIO, CFIOR, CPPos, CPDoc, UAddr, UPostAddr, accountNDS, bankName, bankBIK, bankKor, bankAcc) 
               VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
		$statement  = Database::getInstance()->prepare($tsql);
		$statement2 = Database::getInstance()->prepare($tsql2);
		try {
			$statement->execute($data);
			$statement2->execute($data2);
			return TRUE;
		}
		catch (PDOException $e) {
			API_helper::failResponse($e->getMessage() . ' SQL query: ' . $tsql, 500);
			exit();
			return FALSE;
		}
	}
	
	public static function regComplete($secret, $email)
	{
		try {
			$params = array(
				'email' => $email,
				'emailActivationCode' => $secret
			);
			
			$tsql      = "UPDATE " . SCHEMA . ".[Clients] SET [emailActivated] = 1 WHERE [email] = :email AND [emailActivationCode] = :emailActivationCode;";
			$statement = Database::getInstance()->prepare($tsql);
			$statement->execute($params);
			
			$tsql2      = "SELECT [ID] FROM " . SCHEMA . ".[Clients] WHERE [email] = :email;";
			$statement2 = Database::getInstance()->prepare($tsql2);
			$statement2->execute(array(
				'email' => $email
			));
			
			$statement2->setFetchMode(PDO::FETCH_ASSOC);
			$table             = $statement2->fetch();
			$_SESSION['id']    = $table['ID'];
			$_SESSION['email'] = $email;
			
			$tsql3      = "SELECT [accountType], [serviceName] FROM " . SCHEMA . ".[ClientsPrivateData] WHERE [ID] = :ID;";
			$statement3 = Database::getInstance()->prepare($tsql3);
			$statement3->execute(array(
				'ID' => $_SESSION['id']
			));
			
			$statement3->setFetchMode(PDO::FETCH_ASSOC);
			$table3                  = $statement3->fetch();
			$_SESSION['accountType'] = $table3['accountType'];
			$_SESSION['serviceName'] = $table3['serviceName'];
			

            //welcome and actions notification
            $options['text']='Для активации услуг создайте соответствующий сервис в разделе <a href="/console/services">сервисы</a>.';
            $options['title']='Добро пожаловать! Нажмите на это уведомление для просмотра.';
            $options['client_ID']=$table['ID'];
            $resultData=Notifications::insertnew($options);


			return TRUE;
		}
		catch (PDOException $e) {
			API_helper::failResponse($e->getMessage(), 500);
			exit();
			return FALSE;
		}
	}
	
	public static function checkLoginData($email, $password)
	{		
		try {
			$tsql      = "SELECT [ID], [password], [emailActivated] FROM " . SCHEMA . ".[Clients] WHERE [email] = :email;";
			$statement = Database::getInstance()->prepare($tsql);
			$statement->execute(array(
				'email' => $email
			));
		}
		catch (PDOException $e) {
			$arr = array(
				'error' => 1,
				'uid' => 0,
				'password' => 0
			);
			return $arr;
		}
		
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		$table  = $statement->fetch();
		$tempId = $table['ID'];
		
		try {
			$tsql2      = "SELECT [accountType], [serviceName] FROM " . SCHEMA . ".[ClientsPrivateData] WHERE [ID] = :ID;";
			$statement2 = Database::getInstance()->prepare($tsql2);
			$statement2->execute(array(
				'ID' => $tempId
			));
		}
		catch (PDOException $e) {
			$arr = array(
				'error' => 1,
				'uid' => 0,
				'password' => 0
			);
			return $arr;
		}
		
		$statement2->setFetchMode(PDO::FETCH_ASSOC);
		$table2 = $statement2->fetch();
			
			if (Pass::password_verify($password, $table['password'])) {
				if ($table['emailActivated'] == 1) {
					$arr = array(
						'error' => 0,
						'uid' => $table['ID'],
						'password' => $table['password']
					);
					$_SESSION['id']          = $table['ID'];
					$_SESSION['email']       = $email;
					$_SESSION['accountType'] = $table2['accountType'];
					$_SESSION['serviceName'] = $table2['serviceName'];
				} else {
					$arr = array(
						'error' => 3,
						'uid' => 0,
						'password' => 0
					);
				}
			} else {
				$arr = array(
					'error' => 2,
					'uid' => 0,
					'password' => 0
				);
			}
		return $arr;
	}
	
	public static function checkAdminLoginData($login, $password)
	{	
		if ($login == ADMIN_LOGIN && md5($password) == SECRET) {
			$_SESSION['isAdmin']       = 1;
			$arr = array(
					'error' => 0
				);
		}
		else {
			$arr = array(
					'error' => 1
				);
		}
		return $arr;
	}
	
	public static function checkEmail($email){
			$tsql      = "SELECT * FROM " . SCHEMA . ".[Clients] WHERE [email] = :email;";
			$statement = Database::getInstance()->prepare($tsql);
			$statement->execute(array(
				'email' => $email
			));
			$row = $statement->fetchAll(PDO::FETCH_ASSOC);
		if (count($row) > 0) {
			return "on";
		} else {
			return "off";
		}
	}
	
}
