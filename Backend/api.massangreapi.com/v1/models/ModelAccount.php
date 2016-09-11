<?php
class ModelAccount {
	const TableName = "Account";
	const AccountId = "account_id";
	const PersonId = "person_id";
	const Email = "email";
	const Password = "password";
	const CreatedDate = "created_date";
	const ModifiedDate = "modified_date";
	const ValidFlag = "valid_flag";
	//const ApiKey = "apikey";
	
	public static function get($request) {
		throw new ExceptionApi(ExceptionApi::ESTADO_METODO_NO_EXISTE, ExceptionApi::ESTADO_METODO_NO_EXISTE_MESSAGE, 400);
	}
	public static function put($request) {
		throw new ExceptionApi(ExceptionApi::ESTADO_METODO_NO_EXISTE, ExceptionApi::ESTADO_METODO_NO_EXISTE_MESSAGE, 400);
	}
	public static function delete($request) {
		throw new ExceptionApi(ExceptionApi::ESTADO_METODO_NO_EXISTE, ExceptionApi::ESTADO_METODO_NO_EXISTE_MESSAGE, 400);
	}
	
	public static function post($request) {
		//print $request[0];
		if ($request[0] == 'signup') {
	        return self::SignUp();
	    } else if ($request[0] == 'login') {
	        return self::Login();
        } else if ($request[0] == 'info') {
			return self::Info();
	    } else {
	        throw new ExceptionApi(ExceptionApi::ESTADO_URL_INCORRECTA, ExceptionApi::ESTADO_URL_INCORRECTA_MESSAGE, 400);
	    }
	}	

	//Model methods
	private function Info() {
		$account = [
				"account_id" => "Out",
				"person_id" => "Out",
				"first_name" => "In",
				"fathers_name" => "In",
				"email" => "Out,In",
				"password" => "In",
				"created_date" => "Out",
				"modified_date" => "Out",
				"valid_flag" => "Out"
		];
		$method = [
				"signup" => "Sign Up a new account",
				"login" => "Login an account"
		];
		http_response_code(200);
		return [ "state" => ExceptionApi::OK, "account" => $account, "methods" => $method];
	}
	
	private function SignUp()
	{
		$body = file_get_contents('php://input');
		$content = json_decode($body);
		
		//print $content->account->password;
	
		// Validar campos
		//$content->account->password = self::Encrypt($content->account->password);
		
		// Insert account		
		$result = self::Save($content->account);
		
		// Imprimir respuesta
		if ($result > 0) {
			$content->account->account_id = $result;
			$insertedAccount = self::Select($content->account);
			http_response_code(200);
			return [ "state" => ExceptionApi::OK, "account" => $insertedAccount];
		}
	}
	
	private function Login() {
		$body = file_get_contents('php://input');
		$content = json_decode($body);
		
		//$content->account->password = self::Encrypt($content->account->password);
		
		// Get row
		$account = self::Select($content->account);
	
		http_response_code(200);
		return [ "state" => ExceptionApi::OK, "account" => $account];
	}
	
	//Database methods
	private function Save($account) {
		try {
			$pdo = DBConnection::GetInstance()->GetDB();
			
			// Sentencia INSERT
			$command = "INSERT INTO " . self::TableName . " ( " .
					self::PersonId . "," .
					self::Email . "," .
					self::Password . ")" .
					" VALUES(?,?,?)";
			
			$sentence = $pdo->prepare($command);
			
			$sentence->bindParam(1, $account->person_id);
			$sentence->bindParam(2, $account->email);
			$sentence->bindParam(3, $account->password);
			
			$result = $sentence->execute();
			
			if ($result) {
				return $pdo->lastInsertId();
			} else {
				throw new ExceptionApi(ExceptionApi::ESTADO_ERROR_BD, ExceptionApi::ESTADO_ERROR_BD_MESSAGE);
			}
		} catch (PDOException $e) {
        	throw new ExceptionApi(ExceptionApi::ESTADO_ERROR_BD, ExceptionApi::ESTADO_ERROR_BD_MESSAGE);
    	}
	}
	
	private function Select($account) {
		$command = "SELECT " .
        	self::AccountId . "," .
        	self::PersonId . "," .
        	self::Email . "," .
        	self::Password . "," .
        	self::CreatedDate . "," .
        	self::ModifiedDate . "," .
        	self::ValidFlag .
        " FROM " . self::TableName .
        " WHERE " . self::Email . "=? " .
        " AND " . self::Password . "=? ";
		
		try {
		
			$sentence = DBConnection::GetInstance()->GetDB()->prepare($command);
		
			$sentence->bindParam(1, $account->email);
			$sentence->bindParam(2, $account->password);
			
			$sentence->execute();
		
			if ($sentence) {
				$result = $sentence->fetch();
				
				$account->account_id = $result["account_id"];
				$account->person_id = $result["person_id"];
				$account->email = $result["email"];
				$account->password = $result["password"];
				$account->created_date = $result["created_date"];
				$account->modified_date = $result["modified_date"];
				$account->valid_flag = $result["valid_flag"];
				return $account;
			} else {
				return [ "account_id" => 0];
			}
		} catch (PDOException $e) {
			throw new ExceptionApi(self::ESTADO_ERROR_BD, $e->getMessage());
		}
	}
	
	//Utilities
	private function Encrypt($password) {
		if ($password)
			return password_hash($password, PASSWORD_DEFAULT);
		else return null;
	}
}