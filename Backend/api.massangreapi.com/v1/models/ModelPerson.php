<?php
class ModelPerson {
	const TableName = "Person";
	const PersonId = "person_id";
	const FirstName = "first_name";
	const FathersName = "fathers_name";
	const MothersName = "mothers_name";
	const Genre = "genre";
	const BloodTypeId = "blood_type_id";
	const BirthDate = "birth_date";
	const Email = "email";
	const Telephone = "telephone";
	const Weight = "weight";
	const Image = "image";
	const CreatedDate = "created_date";
	const ModifiedDate = "modified_date";
	const ValidFlag = "valid_flag";
	
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
		if ($request[0] == 'insert') {
	        return self::Insert();
	    } else if ($request[0] == 'get') {
	        return self::GetPerson();
        } else if ($request[0] == 'getlist') {
        	return self::GetList();
        } else if ($request[0] == 'info') {
			return self::Info();
		} else if ($request[0] == 'update') {
				return self::Update();
	    } else {
	        throw new ExceptionApi(ExceptionApi::ESTADO_URL_INCORRECTA, ExceptionApi::ESTADO_URL_INCORRECTA_MESSAGE, 400);
	    }
	}	

	//Model methods
	private function Info() {		
		$content = [
				"person_id" => "Out,[In]",
				"first_name" => "Out,In",
				"fathers_name" => "Out,In",
				"mothers_name" => "Out,[In]",
				"genre" => "Out,[In]",
				"blood_type_id" => "Out,In",
				"birth_date" => "Out,[In]",
				"email" => "Out,[In]",
				"telephone" => "Out,[In]",
				"weight" => "Out,[In]",
				"image" => "Out,[In]",
				"created_date" => "Out",
				"modified_date" => "Out",
				"valid_flag" => "Out"
		];
		$method = [
				"insert" => "Insert or update person",
				"get" => "Get person by person id",
				"getlist" => "Get list of persons",
				"update" => "Update person"
		];
		http_response_code(200);
		return [ "state" => ExceptionApi::OK, "person" => [$content], "methods" => $method];
	}
	
	private function Insert()
	{
		$body = file_get_contents('php://input');
		$content = json_decode($body);
		
		// Insert row		
		$result = self::Save($content->person);
		
		// Imprimir respuesta
		if ($result > 0) {
			$content->person->person_id = $result;
			$insertedPerson = self::Select($content->person);
			
			http_response_code(200);
			return [ "state" => ExceptionApi::OK, "person" => $insertedPerson];
		}
	}
	
	private function GetList() {
		// Get rows
		$persons = self::SelectPersons();
		
		http_response_code(200);
		return [ "state" => ExceptionApi::OK, "person" => [$persons] ];
	}
	
	private function GetPerson() {
		$body = file_get_contents('php://input');
		//return $body;
		$content = json_decode($body);
	
		// Get row
		$person = self::Select($content->person);
	
		http_response_code(200);
		return [ "state" => ExceptionApi::OK, "person" => $person];
	}
	
	private function Update()
	{
		$body = file_get_contents('php://input');
		$content = json_decode($body);
	
		// Insert row
		$result = self::UpdateDB($content->person);
	
		// Imprimir respuesta
		if ($result > 0) {
			http_response_code(200);
			return [ "state" => ExceptionApi::OK, "person" => $content->person];
		}
	}
	
	//Database methods
	private function Save($person) {
		try {
			$pdo = DBConnection::GetInstance()->GetDB();
			
			// Sentencia INSERT
			$command = "INSERT INTO " . self::TableName . " ( " .
					self::FirstName . "," .
					self::FathersName . "," .
					self::MothersName . "," .
					self::Genre . "," .
					self::BloodTypeId . "," .
					self::BirthDate . "," .
					self::Email . "," .
					self::Telephone . "," .
					self::Weight . "," .
					self::Image . ")" .
					" VALUES(?,?,?,?,?,?,?,?,?,?)";
			
			$sentence = $pdo->prepare($command);
			
			$sentence->bindParam(1, $person->first_name);
			$sentence->bindParam(2, $person->fathers_name);
			$sentence->bindParam(3, $person->mothers_name);
			$sentence->bindParam(4, $person->genre);
			$sentence->bindParam(5, $person->blood_type_id);
			$sentence->bindParam(6, $person->birth_date);
			$sentence->bindParam(7, $person->email);
			$sentence->bindParam(8, $person->telephone);
			$sentence->bindParam(9, $person->weight);
			$sentence->bindParam(10, $person->image);
			
			$result = $sentence->execute();
			
			if ($result) {
				return $pdo->lastInsertId();
			} else {
				throw new ExceptionApi(ExceptionApi::ESTADO_ERROR_BD, ExceptionApi::ESTADO_ERROR_BD_MESSAGE);
			}
		} catch (PDOException $e) {
        	throw new ExceptionApi(ExceptionApi::ESTADO_ERROR_BD, $e->getMessage());
    	}
	}
	
	private function Select($person) {
		$command = "SELECT " .
        	self::PersonId . "," .
        	self::FirstName . "," .
        	self::FathersName . "," .
        	self::MothersName . "," .
        	self::Genre . "," .
        	self::BloodTypeId . "," .
        	self::BirthDate . "," .
        	self::Email . "," .
        	self::Telephone . "," .
        	self::Weight . "," .
        	self::Image . "," .
        	self::CreatedDate . "," .
        	self::ModifiedDate . "," .
        	self::ValidFlag .
        " FROM " . self::TableName .
        " WHERE " . self::PersonId . "=? ";
		
		try {
		
			$sentence = DBConnection::GetInstance()->GetDB()->prepare($command);
		
			$sentence->bindParam(1, $person->person_id);
		
			$sentence->execute();
		
			if ($sentence) {
				$result = $sentence->fetch();
				
				$person->person_id = $result["person_id"];
				$person->first_name = $result["first_name"];
				$person->fathers_name = $result["fathers_name"];
				$person->mothers_name = $result["mothers_name"];
				$person->blood_type_id = $result["blood_type_id"];
				$person->birth_date = $result["birth_date"];
				$person->email = $result["email"];
				$person->telephone = $result["telephone"];
				$person->weight = $result["weight"];
				$person->image = $result["image"];
				$person->created_date = $result["created_date"];
				$person->modified_date = $result["modified_date"];
				$person->valid_flag = $result["valid_flag"];
				
				return $person;
			} else {
				$person->person_id = 0;
				return $person;
			}
		} catch (PDOException $e) {
			throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());
		}
	}
	
	private function SelectPersons() {
		$command = "SELECT " .
				self::PersonId . "," .
				self::FirstName . "," .
				self::FathersName . "," .
				self::MothersName . "," .
				self::Genre . "," .
				self::BloodTypeId . "," .
				self::BirthDate . "," .
				self::Email . "," .
				self::Telephone . "," .
				self::Weight . "," .
				self::Image . "," .
				self::CreatedDate . "," .
				self::ModifiedDate . "," .
				self::ValidFlag .
				" FROM " . self::TableName .
				" WHERE " . self::ValidFlag . "=? ";
	
		try {
	
			$sentence = DBConnection::GetInstance()->GetDB()->prepare($command);
	
			$sentence->bindValue(1, '1');
	
			$sentence->execute();
			
			$personList = array();
			$index = 0;
			if ($sentence) {
				while($result = $sentence->fetch()) {
					$personList[$index] = array(
							"person_id" => $result["person_id"],
							"first_name" => $result["first_name"],
							"fathers_name" => $result["fathers_name"],
							"mothers_name" => $result["mothers_name"],
							"blood_type_id" => $result["blood_type_id"],
							"birth_date" => $result["birth_date"],
							"email" => $result["email"],
							"telephone" => $result["telephone"],
							"weight" => $result["weight"],
							"image" => $result["image"],
							"created_date" => $result["created_date"],
							"modified_date" => $result["modified_date"],
							"valid_flag" => $result["valid_flag"]
					);
					$index++;
				}
	
				return $personList;
			} else {
				return $personList;
			}
		} catch (PDOException $e) {
			throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());
		}
	}
	
	private function UpdateDB($person) {
		try {
			$pdo = DBConnection::GetInstance()->GetDB();
				
			// Sentencia INSERT
			$command = "UPDATE " . self::TableName . " SET " .
					self::FirstName . " = ?," .
					self::FathersName . " = ?," .
					self::MothersName . " = ?," .
					self::Genre . " = ?," .
					self::BloodTypeId . " = ?," .
					self::BirthDate . " = ?," .
					self::Email . " = ?," .
					self::Telephone . " = ?," .
					self::Weight . " = ?," .
					self::Image . " = ?," .
					self::ModifiedDate . " = '" . date("Y-m-d H:i:s") . "' ," .
					self::ValidFlag . " = ?" .
					" WHERE " . self::PersonId . " = ?";
				
			$sentence = $pdo->prepare($command);
				
			$sentence->bindParam(1, $person->first_name);
			$sentence->bindParam(2, $person->fathers_name);
			$sentence->bindParam(3, $person->mothers_name);
			$sentence->bindParam(4, $person->genre);
			$sentence->bindParam(5, $person->blood_type_id);
			$sentence->bindParam(6, $person->birth_date);
			$sentence->bindParam(7, $person->email);
			$sentence->bindParam(8, $person->telephone);
			$sentence->bindParam(9, $person->weight);
			$sentence->bindParam(10, $person->image);
			$sentence->bindParam(11, $person->valid_flag);
			$sentence->bindParam(12, $person->person_id);
			
			//print $command;
				
			$result = $sentence->execute();
				
			if ($result) {
				return $result;
			} else {
				throw new ExceptionApi(ExceptionApi::ESTADO_ERROR_BD, ExceptionApi::ESTADO_ERROR_BD_MESSAGE);
			}
		} catch (PDOException $e) {
			throw new ExceptionApi(ExceptionApi::ESTADO_ERROR_BD, $e->getMessage());
		}
	}
}