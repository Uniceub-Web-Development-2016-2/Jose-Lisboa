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

	public function getip() {
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

	public function getMethod() {
  		return $this->method;
	}


	public function __toString() {
		$token;
		$num=1;
		foreach($parameters as $parameter) {
			$token = 'param'.$num.'='.$token.'&'
		}

		return $this->protocol.'://'.$this->ip.'/'.$this->resource.'?'.$token;
	}
	
$array=array('nome', 'email', 'telefone', 'datanasc');
$request = new Request('$POST', 'http', '192.168.25.1', 'signup', $array);
echo __toString();

}
