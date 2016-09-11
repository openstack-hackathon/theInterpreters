<?php
class ModelAppointment {
	const TableName = "Appointment";
	const AppointmentId = "appointment_id";
	const CampaignId = "campaign_id";
	const DonorId = "donor_id";
	const HospitalId = "hospital_id";
	const DateTime = "date_time";
	const ReminderActivated = "reminder_activated";
	const CompleteFlag = "complete_flag";
	const Comments = "comments";
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
	        return self::GetAppointment();
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
		$result = self::Save($content->appointment);
		
		// Imprimir respuesta
		if ($result > 0) {
			$content->appointment->appointment_id = $result;
			$insertedAppointment = self::Select($content->appointment);
			http_response_code(200);
			return [ "state" => ExceptionApi::OK, "appointment" => $insertedAppointment];
		}
	}
	
	private function GetAppointment() {
		$body = file_get_contents('php://input');
		$content = json_decode($body);
		
		// Get row
		$appointment = self::Select($content->appointment);
	
		http_response_code(200);
		return [ "state" => ExceptionApi::OK, "appointment" => $appointment];
	}
	
	//Database methods
	private function Save($appointment) {
		try {
			$pdo = DBConnection::GetInstance()->GetDB();
			
			// Sentencia INSERT
			$command = "INSERT INTO " . self::TableName . " ( " .
					self::CampaignId . "," .
					self::DonorId . "," .
					self::HospitalId . "," .
					self::DateTime . "," .
					self::ReminderActivated . "," .
					self::CompleteFlag . "," .
					self::Comments . ")" .
					" VALUES(?,?,?,?,?,?,?)";
			
			$sentence = $pdo->prepare($command);
			
			$sentence->bindParam(1, $appointment->campaign_id);
			$sentence->bindParam(1, $appointment->donor_id);
			$sentence->bindParam(1, $appointment->hospital_id);
			$sentence->bindParam(1, $appointment->date_time);
			$sentence->bindParam(1, $appointment->reminder_activated);
			$sentence->bindParam(1, $appointment->complete_flag);
			$sentence->bindParam(1, $appointment->comments);
			
			print $command;
			
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
	
	private function Select($appointment) {
		$command = "SELECT " .
        	self::AppointmentId . "," .
        	self::CampaignId . "," .
        	self::DonorId . "," .
        	self::HospitalId . "," .
        	self::DateTime . "," .
        	self::ReminderActivated . "," .
        	self::CompleteFlag . "," .
        	self::Comments . "," .
        	self::CreatedDate . "," .
        	self::ModifiedDate . "," .
        	self::ValidFlag .
        " FROM " . self::TableName .
        " WHERE " . self::AppointmentId . "=? ";
		
		try {
		
			$sentence = DBConnection::GetInstance()->GetDB()->prepare($command);
		
			$sentence->bindParam(1, $appointment->appointment_id);
			
			$sentence->execute();
		
			if ($sentence) {
				$result = $sentence->fetch();
				
				$appointment->appointment_id = $result["appointment_id"];
				$appointment->campaign_id = $result["campaign_id"];
				$appointment->donor_id = $result["donor_id"];
				$appointment->hospital_id = $result["hospital_id"];
				$appointment->date_time = $result["date_time"];
				$appointment->reminder_activated = $result["reminder_activated"];
				$appointment->complete_flag = $result["complete_flag"];
				$appointment->comments = $result["comments"];
				$appointment->created_date = $result["created_date"];
				$appointment->modified_date = $result["modified_date"];
				$appointment->valid_flag = $result["valid_flag"];
				return $appointment;
			} else {
				return [ "appointment_id" => 0];
			}
		} catch (PDOException $e) {
			throw new ExceptionApi(self::ESTADO_ERROR_BD, $e->getMessage());
		}
	}
}