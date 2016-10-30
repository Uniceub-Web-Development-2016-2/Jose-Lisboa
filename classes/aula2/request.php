<?php
class Request
{
	private $method;
	private $protocol;
	private $ip;
	private $resource;
	private $parameters;
	
	
	public function __construct($method, $protocol, $ip, $resource, $parameters){
		$this->method=$method;
		$this->protocol=$protocol;
		$this->ip=$ip;
		$this->resource=$resource;
		$this->parameters=$parameters;
	}
	public function setMethod($method) {
  		$this->method = $method;
	}
	public function getMethod() {
  		return $this->method;
	}
	public function setProtocol($protocol) {
  		$this->protocol = $protocol;
	}
	public function getProtocol() {
  		return $this->protocol;
	}
	public function setIp($ip) {
  		$this->ip = $ip;
	}
	public function getIp() {
  		return $this->ip;
	}
	public function setResource($resource) {
  		$this->resource = $resource;
	}
	public function getResource() {
  		return $this->resource;
	}
	public function setParameters($parameters) {
  		$this->parameters = $parameters;
	}
	public function getParameters() {
  		return $this->method;
	}
	public function toString() {
		$token="";
		$num=1;
		foreach($this->parameters as $parameter) {
			$token .= "param".$num."=".$parameter."&amp";
			$num++;
		}
		return $this->protocol.'://'.$this->ip.'/'.$this->resource.'?'.$token;
	}

}



$request = new Request("POST", "http", "192.168.25.1", "signup", array("nome", "email", "telefone", "datanasc"));

echo $request->toString();
