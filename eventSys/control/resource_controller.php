<?php

include_once ('../eventSys/model/request.php');
include ('../eventSys/db/db_manager.php');

class ResourceController
{


	//defines all allowed resources

	const VALID_RESOURCES = array('','event', 'login', 'payment', 'subscription', 'user', 'workshop', 'index.php');
	private $RESOURCEMAP = ['event' => 'treat_event', 'login' => 'treat_login', 'payment' => 'treat_payment', 'subscription' => 'treat_subscription', 'user' => 'treat_user', 'workshop' => 'treat_workshop', '' => 'redirect', 'index.php' => 'index'];


	//defines request types accepted and methods for each of them

	private $EVENTMAP = ['GET' => 'search_event' , 'POST' => 'create_event' , 'PUT' => 'update_event', 'DELETE' => 'remove_event'];
	private $PAYMAP = ['GET' => 'search_payment' , 'POST' => 'create_payment' , 'PUT' => 'update_payment', 'DELETE' => 'remove_payment'];
	private $SUBSCMAP = ['GET' => 'search_subscription' , 'POST' => 'create_subscription' , 'PUT' => 'update_subscription', 'DELETE' => 'remove_subscription'];
	private $USERMAP = ['GET' => 'search_user' , 'POST' => 'create_user' , 'PUT' => 'update_user', 'DELETE' => 'remove_user'];
	private $WORKSHOPMAP = ['GET' => 'search_workshop' , 'POST' => 'create_workshop' , 'PUT' => 'update_workshop', 'DELETE' => 'remove_workshop'];
	private $LOGINMAP = ['POST'=>'login', 'PUT'=>'no_duplicate'];

	/*
	** --- VALIDATION METHODS ---
	*/

	public function treat_request($request)
	{
		if(self::is_valid_resource($request) == TRUE)
			return $this->{$this->RESOURCEMAP[$request->getResource()]}($request);

		return array("code" => "404", "message" => "resource not found");
	}


	public function is_valid_resource($request)
	{
		$resource = $request->getResource();
		if(!in_array($resource, self::VALID_RESOURCES))
			return false;

		return true;
	}


	/*
	** --- TREATMENT METHODS ---
	*/

	function treat_login($request)
	{
		return $this->{$this->LOGINMAP[$request->getMethod()]}($request);
	}

	function treat_user($request)
	{
		return $this->{$this->USERMAP[$request->getMethod()]}($request);
	}

	function treat_event($request)
	{
		return $this->{$this->EVENTMAP[$request->getMethod()]}($request);
	}

	function treat_payment($request)
	{
		return $this->{$this->PAYMAP[$request->getMethod()]}($request);
	}

	function treat_subscription($request)
	{
		return $this->{$this->SUBSCMAP[$request->getMethod()]}($request);
	}

	function treat_workshop($request)
	{
		return $this->{$this->WORKSHOPMAP[$request->getMethod()]}($request);
	}

	function redirect($request)
	{
		$redirect = "http://localhost/eventSys/index.php";
		return header("location:$redirect");
	}

	function index($request)
	{
		return "We're working on something here";
	}



	/*
	** --- RESOURCES METHODS ---
	*/



	public function login($request)
	{
		$query = 'SELECT * FROM user WHERE '.self::bodyParams($request->getBody()).' AND usstatus=1';

                return self::selection_query($query);
	}

	public function no_duplicate($request)
	{
		$array = json_decode($request->getBody(), true);
		$query = "SELECT * FROM user WHERE iduser='".$array['iduser']."' OR email='".$array['email']."'";

		if(empty(self::selection_query($query)))
		{
			return true;
		}
		else
		{
			return false;
		}
	}


	//search method for user resource
	private function search_user($request)
	{
		if(!empty($request->getParameters()))
		{
			$query = 'SELECT * FROM user, address WHERE '.self::queryParams($request->getParameters()).' AND codaddress=idaddress AND usstatus=1';
		}
		else
		{
			$query = 'SELECT * FROM user, address WHERE 1 AND codaddress=idaddress AND usstatus=1';
		}

		return self::selection_query($query);
	}

	//create method for user resource
	private function create_user($request)
	{
		$k_v = json_decode($request->getBody(), true);
		$query = "BEGIN;
			INSERT INTO address (cep, logradouro, bairro, localidade, uf, complemento, numero, adstatus) VALUES('".$k_v["cep"]."', '".$k_v["logradouro"]."', '".$k_v["bairro"]."', '".$k_v["localidade"]."', '".$k_v["uf"]."', '".$k_v["complemento"]."', '".$k_v["numero"]."', '".$k_v["adstatus"]."');
			INSERT INTO user (iduser, firstname, lastname, email, password, codaddress, gender, phonenumber, usertype, usstatus) VALUES('".$k_v["iduser"]."', '".$k_v["firstname"]."', '".$k_v["lastname"]."', '".$k_v["email"]."', '".$k_v["password"]."',LAST_INSERT_ID(), '".$k_v["gender"]."', '".$k_v["phonenumber"]."', '".$k_v["usertype"]."', '".$k_v["usstatus"]."');
			COMMIT;";

		return self::execution_query($query);
	}

	//update method for user resource
	private function update_user($request)
	{
		$k_v = json_decode($request->getBody(), true);

		$query = "UPDATE address, user SET cep='".$k_v["cep"]."', logradouro='".$k_v["logradouro"]."', bairro='".$k_v["bairro"]."', 	localidade='".$k_v["localidade"]."', uf='".$k_v["uf"]."', complemento='".$k_v["complemento"]."', numero='".$k_v["numero"]."', iduser='".$k_v["iduser"]."', firstname='".$k_v["firstname"]."', lastname='".$k_v["lastname"]."', email='".$k_v["email"]."', password='".$k_v["password"]."', codaddress='".$k_v["codaddress"]."', gender='".$k_v["gender"]."', phonenumber='".$k_v["phonenumber"]."', usertype='".$k_v["usertype"]."' WHERE user.codaddress=address.idaddress AND user.iduser='".$k_v["iduser"]."'";

		return self::execution_query($query);
	}

	//remove method for user resource. Logical deletion implemented
	private function remove_user($request)
	{
		$k_v = json_decode($request->getBody(), true);

		$query = "UPDATE address, user SET adstatus=0, usstatus=0 WHERE user.codaddress=address.idaddress AND user.iduser='".$k_v["iduser"]."'";

		return self::execution_query($query);
	}



	//search method for event resource
	private function search_event($request)
	{
		$query = 'SELECT * FROM event, address, user WHERE '.self::queryParams($request->getParameters()).' AND eventcreator=iduser AND codeventlocation=idaddress AND evstatus=1';
		return self::selection_query($query);
	}

	//create method for event resource
	private function create_event($request)
	{
		$k_v = json_decode($request->getBody(), true);
		$query = "BEGIN;
			INSERT INTO address (cep, logradouro, bairro, localidade, uf, complemento, numero, adstatus) VALUES('".$k_v["cep"]."', '".$k_v["logradouro"]."', '".$k_v["bairro"]."', '".$k_v["localidade"]."', '".$k_v["uf"]."', '".$k_v["complemento"]."', '".$k_v["numero"]."', '".$k_v["adstatus"]."');
			INSERT INTO event (eventname, eventtheme, startdate, enddate, starttime, codeventlocation, registrationfee, subscriberslimit, observation, eventcreator, evstatus) VALUES('".$k_v["eventname"]."', '".$k_v["eventtheme"]."', '".$k_v["startdate"]."', '".$k_v["enddate"]."', '".$k_v["starttime"]."',LAST_INSERT_ID(), '".$k_v["registrationfee"]."', '".$k_v["subscriberslimit"]."', '".$k_v["observation"]."', '".$k_v["eventcreator"]."', '".$k_v["evstatus"]."');
			COMMIT;";

		return self::execution_query($query);
	}

	//update method for user resource
	private function update_event($request)
	{
		$k_v = json_decode($request->getBody(), true);
		var_dump($k_v);
		$query = "UPDATE address, event SET ".self::bodyParams($request->getBody())." WHERE event.codeventlocation=address.idaddress AND event.idevent='".$k_v["idevent"]."'";

		return self::execution_query($query);
	}

	//remove method for event resource. Logical deletion implemented
	private function remove_event($request)
	{
		$k_v = json_decode($request->getBody(), true);

		$query = "UPDATE address, event SET adstatus=0, evstatus=0 WHERE event.codeventlocation=address.idaddress AND event.idevent='".$k_v["idevent"]."'";

		return self::execution_query($query);
	}



	//search method for payment resource
	private function search_payment($request)
	{
		$query = 'SELECT * FROM payment, subscription, user WHERE '.self::queryParams($request->getParameters()).' AND subscriptionid=idsubscription AND coduser=iduser AND pastatus=1';
		return self::selection_query($query);
	}


	//create method for payment resource
	private function create_payment($request)
	{
		$k_v = json_decode($request->getBody(), true);
		$query = "INSERT INTO payment (value, paymentdate, codsubscription, paymentstatus, pastatus) VALUES('".$k_v["registrationfee"]."', '".$k_v["paymentdate"]."', '".$k_v["codsubscription"]."', '".$k_v["paymentstatus"]."', '".$k_v["pastatus"]."');";

		return self::execution_query($query);
	}

	//update method for payment resource
	private function update_payment($request)
	{
		$k_v = json_decode($request->getBody(), true);
		var_dump($k_v);
		$query = "UPDATE payment SET value='".$k_v["value"]."', paymentdate='".$k_v["paymentdate"]."', codsubscription='".$k_v["codsubscription"]."', paymentstatus='".$k_v["paymentstatus"]."' WHERE idpayment='".$k_v["idpayment"]."'";

		return self::execution_query($query);
	}

	//remove method for payment resource. Logical deletion implemented
	private function remove_payment($request)
	{
		$k_v = json_decode($request->getBody(), true);

		$query = "UPDATE payment SET pastatus=0 WHERE idpayment='".$k_v["idpayment"]."'";

		return self::execution_query($query);
	}



	//search method for subscription resource
	private function search_subscription($request)
	{
		if(!empty($request->getParameters()))
		{
			$query = 'SELECT * FROM user, event, subscription WHERE '.self::queryParams($request->getParameters()).' AND iduser=coduser AND idevent=codevent AND sustatus=1';
		}
		else
		{
			$query = "SELECT * FROM user, event, subscription WHERE iduser=coduser AND idevent=codevent AND sustatus=1";
		}
		return self::selection_query($query);
	}

	//create method for subscription resource
	private function create_subscription($request)
	{
		$k_v = json_decode($request->getBody(), true);
		$query = "INSERT INTO subscription (coduser, codevent, subscriptiondate, subscriptionstatus, sustatus) VALUES('".$k_v["coduser"]."', '".$k_v["codevent"]."', '".$k_v["subscriptiondate"]."', '".$k_v["subscriptionstatus"]."', '".$k_v["sustatus"]."');";

		return self::selection_query($query);
	}

	//update method for subscription resource
	private function update_subscription($request)
	{
		$k_v = json_decode($request->getBody(), true);
		$query = "UPDATE subscription SET ".self::bodyParams($request->getBody())." WHERE idsubscription='".$k_v['idsubscription']."';";

		return self::execution_query($query);
	}

	//remove method for subscription resource. Logical deletion implemented
	private function remove_subscription($request)
	{
		$k_v = json_decode($request->getBody(), true);

		$query = "UPDATE subscription SET subscriptionstatus=0 WHERE idsubscription='".$k_v["idsubscription"]."';";

		return self::selection_query($query);
	}

	//search method for workshop resource
	private function search_workshop($request)
	{
		$query = 'SELECT * FROM workshop WHERE '.self::queryParams($request->getParameters()).' AND wostatus=1';

		return self::selection_query($query);
	}

	//create method for workshop resource
	private function create_workshop($request)
	{
		$k_v = json_decode($request->getBody(), true);
		$query = "INSERT INTO workshop (workshopname, subscriberslitmit, comments, codevent, wostatus) VALUES('".$k_v["workshopname"]."', '".$k_v["subscriberslitmit"]."', '".$k_v["comments"]."', '".$k_v["codevent"]."', '".$k_v["wostatus"]."');";

		return self::selection_query($query);
	}

	//update method for workshop resource
	private function update_workshop($request)
	{
		$k_v = json_decode($request->getBody(), true);
		$query = "UPDATE workshop SET workshopname='".$k_v["workshopname"]."', subscriberslitmit='".$k_v["subscriberslitmit"]."', comments='".$k_v["comments"]."';";

		return self::execution_query($query);
	}

	//remove method for workshop resource. Logical deletion implemented
	private function remove_workshop($request)
	{
		$k_v = json_decode($request->getBody(), true);

		$query = "UPDATE workshop SET wostatus=0 WHERE idworkshop='".$k_v["idworkshop"]."';";

		return self::selection_query($query);
	}


	/*
	** --- DB METHODS ---
	*/

	//db connection and errmode setup
	private function connect()
	{
		$conn = (new DBConn());
		//$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return $conn;
	}

	//executes select query returning data from db
	private function selection_query($query)
	{
		try
		{
			$conn = self::connect()->query($query);
			$results = $conn->fetchAll(PDO::FETCH_ASSOC);

			return $results;

		}catch(PDOException $e)
		{
			echo "Error: ".$e->getMessage();
		}
	}


	//executes insert, update and logical delete queries
	private function execution_query($query)
	{
		try
		{
		$conn = self::connect()->query($query);

		echo 'Success! '.$query;

		}catch (PDOException $e)
		{
			echo 'Error: ' .$e->getMessage();
		}

	}


	//defines select query parameters

	private function queryParams($params)
	{
		$query = "";
		foreach($params as $key => $value) {
			$query .= $key;

			if(is_numeric($value)){
				$query .=' = '."'".$value."'".' AND ';
			}else{
				$query .=" LIKE '%".$value."%'".' AND ';
			}
		}

		$query = substr($query,0,-5);

		if($query==null)
			$query.=1;



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


	private function bodyParams($json)
	{
		$criteria = "";
                	$array = json_decode($json, true);
                	foreach($array as $key => $value)
                	{
                                $criteria .= $key." = '".$value."' AND ";
                	}

                return substr($criteria, 0, -5);
	}

}

