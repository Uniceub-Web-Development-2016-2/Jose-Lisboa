<?php

include ('resource_controller.php');
include_once('../eventSys/model/request.php');

class RequestController
{
	
	//constant that contains all allowed methods and all valid protocols
	
	const VALID_METHODS = array('GET', 'POST', 'PUT', 'DELETE');
	const VALID_PROTOCOLS = array('HTTP/1.1', 'HTTPS/1.1');
	

	//creates request and returns it if it has been properly validated
	
	private function create_request($request_info)
	{
		if(!self::is_valid_method($request_info['REQUEST_METHOD']))
		{
			return array("code" => "405", "message" => "method not allowed");
			
		}
		
		if(!self::is_valid_protocol($request_info['SERVER_PROTOCOL']))
		{
			return array("code" => "406", "message" => "not acceptable");
			
		}

		if(!self::is_valid_server_address($request_info['SERVER_ADDR']))
		{
			return array("code" => "401", "message" => "unauthorized");
			
		}

		if(!self::is_valid_client_address($request_info['REMOTE_ADDR']))
		{
			return array("code" => "401", "message" => "unauthorized");
			
		}
		
		return new Request($request_info['REQUEST_METHOD'],$request_info['SERVER_PROTOCOL'],$request_info['SERVER_ADDR'],$request_info['REMOTE_ADDR'],$request_info['REQUEST_URI'],$request_info['QUERY_STRING'],file_get_contents('php://input'));		
	}
	
	
	
	/*
	** --- VALIDATION METHODS ---
	*/
	
	public function is_valid_method($method)
	{
		if(is_null($method) || !in_array($method, self::VALID_METHODS))
			return false;
		
		return true;
	}
	
	
	public function is_valid_resource($resource)
	{
		if(!in_array($resource, self::VALID_RESOURCES))
			return false;
		
		return true;
	}


	public function is_valid_protocol($protocol)
	{
		if(is_null($protocol) || !in_array($protocol, self::VALID_PROTOCOLS))
			return false;
		
		return true;
	}


	public function is_valid_server_address($serverAddress)
	{
		if (filter_var($serverAddress, FILTER_VALIDATE_IP) === false)
			return false;
		
		return true;
	}


	public function is_valid_client_address($clientAddress)
	{
		if (filter_var($clientAddress, FILTER_VALIDATE_IP) === false)
			return false;
		
		return true;
	}	

	
	//execution method which creates request, instantiates resource_controller object and returns request treatment method

	public function execute() {
		$request = self::create_request($_SERVER);
		$resource_controller = new ResourceController();
	        
		return $resource_controller->treat_request($request);
	}












}
