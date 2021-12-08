<?php
	//include 'connect.php';
	// --------------connection to database function-------------
	// function connect(){
	// 	$servername = "LOBNA";
    //     // $username = "username";
    //     // $password = "password";
        
    //     try {
	// 		//$con = new PDO("sqlsrvr:host=$servername;dbname=wages" );
	// 		$con = new PDO("sqlsrv:Server=$servername;Database=payroll_new");
    //         // set the PDO error mode to exception
    //         $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //         //echo "Connected successfully"; 
    //         }
    //     catch(PDOException $e)
    //         {
    //         echo "Connection failed: " . $e->getMessage();
	// 	    }
	// 	return $con;
	// }	

	function connect(){
		$dsn = 'mysql:host=localhost;dbname=payroll_prod';//data source name
		$user= 'root';
		$pass='';
		$options = array (PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',	);

		try{
			//new connection to db
				static $con;
			    if ($con == NULL){ 
			        $con =  new PDO($dsn, $user, $pass, $options);
					$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		    }
		}
		catch(PDOexception $e){
			echo "failed" . $e->getMessage();
		}
		return $con;
	}	


	// Function to get the client ip address
	function get_client_ip_env() {
	    $ipaddress = '';
	    if (getenv('HTTP_CLIENT_IP'))
	        $ipaddress = getenv('HTTP_CLIENT_IP');
	    else if(getenv('HTTP_X_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	    else if(getenv('HTTP_X_FORWARDED'))
	        $ipaddress = getenv('HTTP_X_FORWARDED');
	    else if(getenv('HTTP_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_FORWARDED_FOR');
	    else if(getenv('HTTP_FORWARDED'))
	        $ipaddress = getenv('HTTP_FORWARDED');
	    else if(getenv('REMOTE_ADDR'))
	        $ipaddress = getenv('REMOTE_ADDR');
	    else
	        $ipaddress = 'UNKNOWN';
	 
	    return $ipaddress;
	}