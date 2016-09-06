<?php

class Request
{
	private $method;
	private $protocol;
	private $server_ip;
	private $remote_ip;
	private $resource;
	private $parameters;
	
	
	public function __construct($method, $protocol, $server_ip, $remote_ip, $resource, $parameters){
		$this->method=$method;
		$this->protocol=$protocol;
		$this->server_ip=$server_ip;
		$this->remote_ip=$remote_ip;
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
	public function setServerIp($ip) {
  		$this->server_ip = $ip;
	}
	public function getServerIp() {
  		return $this->server_ip;
	}
	public function setRemoteIp($ip) {
  		$this->remote_ip = $ip;
	}
	public function getRemoteIp() {
  		return $this->remote_ip;
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
