<?php

include_once ('../eventSys/model/request.php');
include ('../eventSys/db/db_manager.php');

class ResourceController
{

	//defines request types accepted and methods for each of them

 	private $METHODMAP = ['GET' => 'search' , 'POST' => 'create' , 'PUT' => 'update', 'DELETE' => 'remove' ];
	

	//receives a request object and returns a function call based on its method

	public function treat_request($request) {
		return $this->{$this->METHODMAP[$request->getMethod()]}($request);
	
	}


	//creates query for db based on global variable $_SERVER ($request) where REQUEST_URI(path) and QUERY_STRING(parameters) are found

	private function search($request) {
		$query = 'SELECT * FROM '.$request->getResource().' WHERE '.self::queryParams($request->getParameters());
		return self::execute_query($query);
	}
	

	//executes query returning json based on data retrieved from db

	private function execute_query($query) {
		$conn = (new DBConnector())->query($query);

		$results = $conn->fetchAll(PDO::FETCH_ASSOC);
		$json=json_encode($results, JSON_UNESCAPED_UNICODE);

		return $json;
		//return $conn->fetchAll();
	}
		
	private function queryParams($params) {
		$query = "";		
		foreach($params as $key => $value) {
			$query .= $key.' = '."'".$value."'".' AND ';	
		}
		$query = substr($query,0,-5);
		if($query==null) {
			$query.=1;
		}
		return $query;
	}

	
}




