<?php


class RequestController
{
	const VALID_METHODS = array('GET', 'POST', 'PUT', 'DELETE');
	const VALID_PROTOCOLS = array('HTTP/1.0', 'HTTPS/1.0', 'HTTP/1.1', 'HTTPS/1.1');

	public function create_request($request_info)
	{
		if(!self::is_valid_method($request_info['REQUEST_METHOD']))
		{
			return array("code" => "405", "message" => "Method not allowed");
			
		}
		if(!self::is_valid_protocol($request_info['SERVER_PROTOCOL'], 0, -4))
		{
			return array("code" => "none", "message" => "Invalid protocol");
		}
		if(self::is_valid_ip($request_info['REMOTE_ADDR']))
		{
			return array("code" => "OK", "message" => "IP valido");
		}
			
		return true;


	//	$request_info['REMOTE_ADDR'];
	//	$request_info['SERVER_ADDR'];
	//	$request_info['SERVER_PROTOCOL'];
	//	$request_info['REQUEST_URI'];
	//	$request_info['QUERY_STRING'];
	//	file_get_contents('php://input');
		
	//	return new Request();
		
	}
	
	public function is_valid_method($method)
	{
		if( is_null($method) || !in_array($method, self::VALID_METHODS))
			return false;
		
		return true;
	}


	public function is_valid_protocol($protocol)
	{
		if(is_null($protocol) || !in_array($protocol, self::VALID_PROTOCOLS))
			return false;

		return true;
	}
	
	public function is_valid_ip($ip)
	{
		if (filter_var($ip, FILTER_VALIDATE_IP))
			return true;

		return false;
	}
















}
