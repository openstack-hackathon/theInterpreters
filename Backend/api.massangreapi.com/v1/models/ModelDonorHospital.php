<?php
class ModelDonorHospital {
	const TableName = "Donor_Hospital";
	const DonorHospitalId = "donor_hospital_id";
	const DonorId = "donor_id";
	const HospitalId = "hospital_id";
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
	        return self::GetDonorHospital();
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
		$result = self::Save($content->donor_hospital);
		
		// Imprimir respuesta
		if ($result > 0) {
			$content->donor_hospital->donor_hospital_id = $result;
			$insertedDonorHospital = self::Select($content->donor_hospital);
			http_response_code(200);
			return [ "state" => ExceptionApi::OK, "donor_hospital" => $insertedDonorHospital];
		}
	}
	
	private function GetDonorHospital() {
		$body = file_get_contents('php://input');
		$content = json_decode($body);
		
		// Get row
		$donor_hospital = self::Select($content->donor_hospital);
	
		http_response_code(200);
		return [ "state" => ExceptionApi::OK, "donor_hospital" => $donor_hospital];
	}
	
	//Database methods
	private function Save($donor_hospital) {
		try {
			$pdo = DBConnection::GetInstance()->GetDB();
			
			// Sentencia INSERT
			$command = "INSERT INTO " . self::TableName . " ( " .
					self::DonorId . "," .
					self::HospitalId . ")" .
					" VALUES(?,?)";
			
			$sentence = $pdo->prepare($command);
			
			$sentence->bindParam(1, $donor_hospital->donor_id);
			$sentence->bindParam(2, $donor_hospital->hospital_id);
			
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
	
	private function Select($donor_hospital) {
		$command = "SELECT " .
        	self::DonorHospitalId . "," .
        	self::DonorId . "," .
        	self::HospitalId . "," .
        	self::CreatedDate . "," .
        	self::ModifiedDate . "," .
        	self::ValidFlag .
        " FROM " . self::TableName .
        " WHERE " . self::DonorId . "=? ";
		
		try {
		
			$sentence = DBConnection::GetInstance()->GetDB()->prepare($command);
		
			$sentence->bindParam(1, $donor_hospital->donor_id);
			
			$sentence->execute();
		
			if ($sentence) {
				$result = $sentence->fetch();
				
				$donor_hospital->donor_hospital_id = $result["donor_hospital_id"];
				$donor_hospital->donor_id = $result["donor_id"];
				$donor_hospital->hospital_id = $result["hospital_id"];
				$donor_hospital->created_date = $result["created_date"];
				$donor_hospital->modified_date = $result["modified_date"];
				$donor_hospital->valid_flag = $result["valid_flag"];
				return $donor_hospital;
			} else {
				return [ "donor_hospital_id" => 0];
			}
		} catch (PDOException $e) {
			throw new ExceptionApi(self::ESTADO_ERROR_BD, $e->getMessage());
		}
	}
}