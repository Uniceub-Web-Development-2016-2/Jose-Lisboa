<?php

include_once ('../eventSys/model/request.php');
include ('../eventSys/db/db_manager.php');

class ResourceController
{

	//defines request types accepted and methods for each of them

 	private $METHODMAP = ['GET' => 'search' , 'POST' => 'create' , 'PUT' => 'update', 'DELETE' => 'remove'];
	

	//receives a request object and returns a function call based on its method

	public function treat_request($request) {
		return $this->{$this->METHODMAP[$request->getMethod()]}($request);
	
	}



	//validation for post and delete methods

	/* private function validate($request) {
		$body = $request->getBody();
		$query = 'SELECT * FROM '.$request->getResource().self::getId($body);

		$results = self::selection_query($query);
		var_dump($results);
		if(count($results) == 0) {
			self::create($request);
		}else{
			self::remove($request);
		}
	}
	*/
	


	//creates query for db based on global variable $_SERVER ($request) where REQUEST_URI(path) and QUERY_STRING(parameters) are found
		
	private function search($request) {
		$query = 'SELECT * FROM '.$request->getResource().' WHERE '.self::queryParams($request->getParameters()). ' AND status=1';
		return self::selection_query($query);
	}
	
	
	
	//creation function

	private function create($request) {
		$body = $request->getBody();	
		$resource = $request->getResource();
		$query = 'INSERT INTO '.$resource.' ('.$this->getColumns($body).') VALUES ('.$this->getValues($body).')';
		
		return self::execution_query($query);
	}

	
	//update function
	
	private function update($request) {
        	$body = $request->getBody();
        	$resource = $request->getResource();
        	$query = 'UPDATE '.$resource.' SET '. $this->getUpdateCriteria($body);
        
		return self::execution_query($query);
		
	}
	
	
	//remove function (logical deletion)
		
	private function remove($request) {
		$body = $request->getBody();
        	$resource = $request->getResource();
        	$query = 'UPDATE '.$resource.' SET status=0'.self::getId($body);
        	
		return self::execution_query($query);
	}
	

	//executes select query returning data from db

	private function selection_query($query) {
		$conn = (new DBConnector())->query($query);
		$results = $conn->fetchAll(PDO::FETCH_ASSOC);

		return $results;
	}


	//executes insert, update and logical delete queries
	
	private function execution_query($query) {
		$conn = (new DBConnector());

		if ($conn->query($query) != TRUE) {
    			echo "Error on: " . $query;
		}
    		//$conn = close();	
		
	}
	
	
	//defines select query parameters
		
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


	//takes primary key from json for updating values purposes
	
	private function getUpdateCriteria($json)
	{
		$criteria = "";
		$where = " WHERE ";
		$array = json_decode($json, true);
		foreach($array as $key => $value) {
			if($key != 'id')
				$criteria .= $key." = '".$value."',";
			
		}
		return substr($criteria, 0, -1).$where." id = '".$array['id']."'";
	}
	
	
	private function getId($json)
	{
		$test = "";
		$where = " WHERE id";
		$array = json_decode($json, true);
		foreach($array as $key => $value) {
			if($key == 'id')
			$test = " = '".$value."'";
			
		}
		return $where.$test;
	}
	
	
	//turns json into array and selects/returns only columns
	
	private function getColumns($json) 
	{
		$array = json_decode($json, true);
		$keys = array_keys($array);
		return implode(",", $keys);
	
	}

	
	//turns json into array and selects/returns only values

	private function getValues($json)
        {
                $array = json_decode($json, true);
                $values = array_values($array);
                $string = implode("','", $values);
		return "'".$string."'";
        
        }
	
}
