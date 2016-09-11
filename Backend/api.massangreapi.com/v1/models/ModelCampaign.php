<?php
class ModelCampaign {
	const TableName = "Campaign";
	const CampaignId = "campaign_id";
	const CreatorAccountId = "creator_account_id";
	const BeneficiaryPersonId = "beneficiary_person_id";
	const HospitalId = "hospital_id";
	const StartDate = "start_date";
	const EndDate = "end_date";
	const Reward = "reward";
	const BeneficiaryIdentifier = "beneficiary_identifier";
	const OpenFlag = "open_flag";
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
	        return self::GetCampaign();
        } else if ($request[0] == 'getByPerson') {
        	return self::GetCampaignByPerson();
        } else if ($request[0] == 'update') {
        	return self::Update();
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
		$result = self::Save($content->campaign);
		
		// Imprimir respuesta
		if ($result > 0) {
			$content->campaign->campaign_id = $result;
			$insertedCampaign = self::Select($content->campaign);
			http_response_code(200);
			return [ "state" => ExceptionApi::OK, "campaign" => $insertedCampaign];
		}
	}
	
	private function GetCampaign() {
		$body = file_get_contents('php://input');
		$content = json_decode($body);
		
		// Get row
		$campaign = self::Select($content->campaign);
	
		http_response_code(200);
		return [ "state" => ExceptionApi::OK, "campaign" => $campaign];
	}
	
	private function GetCampaignByPerson() {
		$body = file_get_contents('php://input');
		$content = json_decode($body);
	
		// Get row
		$campaign = self::SelectByPerson($content->campaign);
	
		http_response_code(200);
		return [ "state" => ExceptionApi::OK, "campaign" => $campaign];
	}
	
	private function Update()
	{
		$body = file_get_contents('php://input');
		$content = json_decode($body);
	
		// Insert row
		$result = self::UpdateDB($content->campaign);
	
		// Imprimir respuesta
		if ($result > 0) {
			http_response_code(200);
			return [ "state" => ExceptionApi::OK, "campaign" => $content->campaign];
		}
	}
	
	//Database methods
	private function Save($campaign) {
		try {
			$pdo = DBConnection::GetInstance()->GetDB();
			
			// Sentencia INSERT
			$command = "INSERT INTO " . self::TableName . " ( " .
					self::CreatorAccountId . "," .
					self::BeneficiaryPersonId . "," .
					self::HospitalId . "," .
					self::StartDate . "," .
					self::EndDate . "," .
					self::Reward . "," .
					self::BeneficiaryIdentifier . "," .
					self::OpenFlag . "," .
					self::Comments . ")" .
					" VALUES(?,?,?,?,?,?,?,?,?)";
			
			$sentence = $pdo->prepare($command);
			
			$sentence->bindParam(1, $campaign->creator_account_id);
			$sentence->bindParam(2, $campaign->beneficiary_person_id);
			$sentence->bindParam(3, $campaign->hospital_id);
			$sentence->bindParam(4, $campaign->start_date);
			$sentence->bindParam(5, $campaign->end_date);
			$sentence->bindValue(6, 0);
			$sentence->bindParam(7, $campaign->beneficiary_identifier);
			$sentence->bindParam(8, $campaign->open_flag);
			$sentence->bindParam(9, $campaign->comments);
			
			//print $command;
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
	
	private function Select($campaign) {
		$command = "SELECT " .
        	self::CampaignId . "," .
        	self::CreatorAccountId . "," .
        	self::BeneficiaryPersonId . "," .
        	self::HospitalId . "," .
        	self::StartDate . "," .
        	self::EndDate . "," .
        	self::BeneficiaryIdentifier . "," .
        	self::OpenFlag . "," .
        	self::Comments . "," .
        	self::CreatedDate . "," .
        	self::ModifiedDate . "," .
        	self::ValidFlag .
        " FROM " . self::TableName .
        " WHERE " . self::ValidFlag . "=? " .
        " AND " . self::CampaignId  . " =? ";
        /*
		($campaign->campaign_id == "")? "" : " AND " . self::CampaignId  . " = " . $campaign->campaign_id .
		($campaign->creator_account_id == "")? "" : " AND " . self::CreatorAccountId  . " = " . $campaign->creator_account_id .
		($campaign->hospital_id == "")? "" : " AND " . self::HospitalId  . " = " . $campaign->hospital_id;
		*/
		try {
		
			$sentence = DBConnection::GetInstance()->GetDB()->prepare($command);
		
			$sentence->bindValue(1, 1);
			$sentence->bindParam(2, $campaign->campaign_id);
			
			$sentence->execute();
			
			$campaignList = array();
			$index = 0;
			if ($sentence) {
				while($result = $sentence->fetch()) {
					$campaignList[$index] = array(
							"campaign_id" => $result["campaign_id"],
							"creator_account_id" => $result["creator_account_id"],
							"beneficiary_person_id" => $result["beneficiary_person_id"],
							"hospital_id" => $result["hospital_id"],
							"start_date" => $result["start_date"],
							"end_date" => $result["end_date"],
							"beneficiary_identifier" => $result["beneficiary_identifier"],
							"open_flag" => $result["open_flag"],
							"comments" => $result["comments"],
							"created_date" => $result["created_date"],
							"modified_date" => $result["modified_date"],
							"valid_flag" => $result["valid_flag"]
					);
					$index++;
				}
			}
			return $campaignList;
			
		} catch (PDOException $e) {
			throw new ExceptionApi(ExceptionApi::ESTADO_ERROR_BD, $e->getMessage());
		}
	}
	
	private function SelectByPerson($campaign) {
		$command = "SELECT " .
				self::CampaignId . "," .
				self::CreatorAccountId . "," .
				self::BeneficiaryPersonId . "," .
				self::HospitalId . "," .
				self::StartDate . "," .
				self::EndDate . "," .
				self::BeneficiaryIdentifier . "," .
				self::OpenFlag . "," .
				self::Comments . "," .
				self::CreatedDate . "," .
				self::ModifiedDate . "," .
				self::ValidFlag .
				" FROM " . self::TableName .
				" WHERE " . self::ValidFlag . "=? " .
				" AND " . self::BeneficiaryPersonId  . " =? " .
				" ORDER BY " . self::CampaignId . " DESC ";
		try {
	
			$sentence = DBConnection::GetInstance()->GetDB()->prepare($command);
	
			$sentence->bindValue(1, 1);
			$sentence->bindParam(2, $campaign->person_id);
				
			$sentence->execute();
				
			$campaignList = array();
			$index = 0;
			if ($sentence) {
				while($result = $sentence->fetch()) {
					$campaignList[$index] = array(
							"campaign_id" => $result["campaign_id"],
							"creator_account_id" => $result["creator_account_id"],
							"beneficiary_person_id" => $result["beneficiary_person_id"],
							"hospital_id" => $result["hospital_id"],
							"start_date" => $result["start_date"],
							"end_date" => $result["end_date"],
							"beneficiary_identifier" => $result["beneficiary_identifier"],
							"open_flag" => $result["open_flag"],
							"comments" => $result["comments"],
							"created_date" => $result["created_date"],
							"modified_date" => $result["modified_date"],
							"valid_flag" => $result["valid_flag"]
					);
					$index++;
				}
			}
			return $campaignList;
				
		} catch (PDOException $e) {
			throw new ExceptionApi(ExceptionApi::ESTADO_ERROR_BD, $e->getMessage());
		}
	}
	
	private function UpdateDB($campaign) {
		try {
			$pdo = DBConnection::GetInstance()->GetDB();
	
			// Sentencia INSERT
			$command = "UPDATE " . self::TableName . " SET " .
					self::CreatorAccountId . " = ?," .
					self::BeneficiaryPersonId . " = ?," .
					self::HospitalId . " = ?," .
					self::StartDate . " = ?," .
					self::EndDate . " = ?," .
					self::BeneficiaryIdentifier . " = ?," .
					self::OpenFlag . " = ?," .
					self::Comments . " = ?," .
					self::ModifiedDate . " = '" . date("Y-m-d H:i:s") . "' ," .
					self::ValidFlag . " = ?" .
					" WHERE " . self::CampaignId . " = ?";
	
			$sentence = $pdo->prepare($command);
	
			$sentence->bindParam(1, $campaign->creator_account_id);
			$sentence->bindParam(2, $campaign->beneficiary_person_id);
			$sentence->bindParam(3, $campaign->hospital_id);
			$sentence->bindParam(4, $campaign->start_date);
			$sentence->bindParam(5, $campaign->end_date);
			$sentence->bindParam(6, $campaign->beneficiary_identifier);
			$sentence->bindParam(7, $campaign->open_flag);
			$sentence->bindParam(8, $campaign->comments);
			$sentence->bindParam(9, $campaign->valid_flag);
			$sentence->bindParam(10, $campaign->campaign_id);
				
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