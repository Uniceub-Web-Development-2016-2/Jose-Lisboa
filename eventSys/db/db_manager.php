<?php

//DBConn class created extending PDO class properties

class DBConn extends PDO 
{
   
   
	//attributes for database connection
	
	private $engine;
	private $host;
	private $database;
	private $user;
	private $pass;
	private $connector;

	
	//function tha enables database connection, using attributes above listed with __construct function from PDO
   
	public function __construct()
	{
        $this->engine = 'mysql';
        $this->host = 'localhost';
        $this->database = 'mydb';
        $this->user = 'root';
        $this->pass = '';
        $dns = $this->engine.":host=".$this->host.';dbname='.$this->database.";charset=utf8";
        parent::__construct( $dns, $this->user, $this->pass );
	}	
		
}














