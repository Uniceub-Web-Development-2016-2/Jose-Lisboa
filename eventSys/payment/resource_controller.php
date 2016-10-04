<?php

include_once ('request.php');
include ('db_manager.php');

class ResourceController
{	
 	private $METHODMAP = ['GET' => 'search' , 'POST' => 'create' , 'PUT' => 'update', 'DELETE' => 'remove' ];
	
	public function treat_request($request) {
		return $this->{$this->METHODMAP[$request->getMethod()]}($request);
	
	}

	//creates query for db based on global variable $_SERVER ($request) where REQUEST_URI(path) and QUERY_STRING(parameters) are found
	private function search($request) {
		$query = 'SELECT * FROM '.$request->getResource().' WHERE '.self::queryParams($request->getParameters());
		return self::execute_query($query);
	}
	
	function utf8_converter($array)
	{
    		array_walk_recursive($array, function(&$item, $key){
        		if(!mb_detect_encoding($item, 'utf-8', true)){
                	$item = utf8_encode($item);
        	}
    	});

		return $array;
	}

	//returns values when the search is made by name
	private function search_by_name() {
		$query = 'SELECT * FROM '.$request->getResource().' WHERE '.self::queryParams($request->getParameters());
		return self::execute_query($query);
	}

	//executes query returning json based on data retrieved from db
	private function execute_query($query) {
		$conn = (new DBConnector())->query($query);
		$results = $conn->fetchAll(PDO::FETCH_ASSOC);
		$json=json_encode($results);

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




