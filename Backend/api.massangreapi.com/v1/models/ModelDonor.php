<?php
class ModelDonor {
	const TableName = "Donor";
	const DonorId = "donor_id";
	const PersonId = "person_id";
	const Rank = "rank";
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
		//print $request[0];
		if ($request[0] == 'insert') {
	        return self::Insert();
	    } else if ($request[0] == 'get') {
	        return self::GetDonor();
        } else {
	        throw new ExceptionApi(ExceptionApi::ESTADO_URL_INCORRECTA, ExceptionApi::ESTADO_URL_INCORRECTA_MESSAGE, 400);
	    }
	}	

	//Model methods
	private function Insert()
	{
		$body = file_get_contents('php://input');
		$content = json_decode($body);
		
		// Insert account		
		$result = self::Save($content->donor);
		
		// Imprimir respuesta
		if ($result > 0) {
			$content->donor->donor_id = $result;
			$insertedDonor = self::Select($content->donor);
			http_response_code(200);
			return [ "state" => ExceptionApi::OK, "donor" => $insertedDonor];
		}
	}
	
	private function GetDonor() {
		$body = file_get_contents('php://input');
		$content = json_decode($body);
		
		// Get row
		$donor = self::Select($content->donor);
	
		http_response_code(200);
		return [ "state" => ExceptionApi::OK, "donor" => $donor];
	}
	
	//Database methods
	private function Save($donor) {
		try {
			$pdo = DBConnection::GetInstance()->GetDB();
			
			// Sentencia INSERT
			$command = "INSERT INTO " . self::TableName . " ( " .
					self::PersonId . "," .
					self::Rank . ")" .
					" VALUES(?,?)";
			
			$sentence = $pdo->prepare($command);
			
			$sentence->bindParam(1, $donor->person_id);
			$sentence->bindParam(2, $donor->rank);
			
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
	
	private function Select($donor) {
		$command = "SELECT " .
        	self::DonorId . "," .
        	self::PersonId . "," .
        	self::Rank . "," .
        	self::CreatedDate . "," .
        	self::ModifiedDate . "," .
        	self::ValidFlag .
        " FROM " . self::TableName .
        " WHERE " . self::PersonId . "=? ";
		
		try {
		
			$sentence = DBConnection::GetInstance()->GetDB()->prepare($command);
		
			$sentence->bindParam(1, $donor->person_id);
			
			$sentence->execute();
		
			if ($sentence) {
				$result = $sentence->fetch();
				
				$donor->donor_id = $result["donor_id"];
				$donor->person_id = $result["person_id"];
				$donor->rank = $result["rank"];
				$donor->created_date = $result["created_date"];
				$donor->modified_date = $result["modified_date"];
				$donor->valid_flag = $result["valid_flag"];
				return $donor;
			} else {
				return [ "donor_id" => 0];
			}
		} catch (PDOException $e) {
			throw new ExceptionApi(self::ESTADO_ERROR_BD, $e->getMessage());
		}
	}
}