<?php
	//include 'connect.php';
	// --------------connection to database function-------------
	function connect(){
        $servername = "LOBNA-PC";
        // $username = "username";
        // $password = "password";
        
        try {
			//$con = new PDO("sqlsrvr:host=$servername;dbname=wages" );
			$con = new PDO("sqlsrv:Server=$servername;Database=payroll");
            // set the PDO error mode to exception
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully"; 
            }
        catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
		    }
		
		// $serverName = "DESKTOP-B9U461U"; //serverName\instanceName

		// // Since UID and PWD are not specified in the $connectionInfo array,
		// // The connection will be attempted using Windows Authentication.
		// $connectionInfo = array( "Database"=>"wages");
		// $con = sqlsrv_connect( $serverName, $connectionInfo);
		
		// if( $con ) {
		// 	 echo "Connection established.<br />";
		// }else{
		// 	 echo "Connection could not be established.<br />";
		// 	 die( print_r( sqlsrv_errors(), true));
		// }

        //-----------------------------------------------  
        // Perform operations with connection.  
        //-----------------------------------------------  
        
        /* Close the connection. */  
        // sqlsrv_close( $conn); 
		// $dsn = 'sqlserver:host=DESKTOP-B9U461U;dbname=wages';//data source name
		// $user= '';
		// $pass='';
		// $options = array (
		// 		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
		// 		//PDO::ATTR_PERSISTENT => true
		// 	);

		// try{
		// 	//new connection to db
		// 		static $con;
		// 	    if ($con == NULL){ 
		// 	        $con =  new PDO($dsn, $user, $pass, $options);
		// 			$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		//     }
		// 	// $con = new PDO($dsn, $user, $pass, $options);
		// 	// $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		// 	//QUERY
		// 	// $q = "INSERT INTO test(name,phone)VALUES('لبنى','محمد')";
		// 	// $con->exec($q);
		// 	//echo "success";
		// 	//print_r($con) ;

		// }
		// catch(PDOexception $e){
		// 	echo "failed" . $e->getMessage();
        // }
       // print_r($con);
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
	//-----------------function to get managements------------------
	function get_All_Mangements(){
		$con = connect();
		$sql= "SELECT ID,Management FROM managements " ;
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
			foreach($result as $row){
			echo '<button  class="btn  btn-lg managements editManagementData well well-sm col-sm-4" data-toggle="modal" data-target="#editManagementModal" id="'.$row['ID'].'">'. $row['Management'] .'</button>';
				// echo "<div class='managements well well-sm col-sm-4'><span>". $row['Management'] ."</span></div>";
			}
			echo "<div class='btn  btn-lg managements well well-sm col-sm-4' data-toggle='modal' data-target='#addManagementModal'><i class='fa fa-plus-circle'></i></div>";
	}

	//---------------get active status function-----------------------
	function getActive(){
		$con = connect();
		$sql= "SELECT ID,active FROM t_active" ;
    	$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
	    	foreach($result as $row){
			    echo "<option value=" .$row['ID'].">" . $row['active'] . "</option>";
			}
	}
	//---------------get day/night status function-----------------------
	function getDayN(){
		$con = connect();
		$sql= "SELECT ID,day_n FROM t_day_n" ;
    	$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
	    	foreach($result as $row){
			    echo "<option value=" .$row['ID'].">" . $row['day_n'] . "</option>";
			}
	}
	//---------------get emp level function-----------------------
	function getLevel(){
		$con = connect();
		$page =  basename($_SERVER['REQUEST_URI']);
		$sql= "SELECT ID,empLevel FROM level " ;
    	$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		if($page == 'level.php'){
			foreach($result as $row){
				echo '<button  class="btn  btn-lg col-sm-10 col-sm-offset-1 managements editLevelData well well-sm " data-toggle="modal" data-target="#editLevelModal" id="'.$row['ID'].'">'. $row['empLevel'] .'</button>';
					// echo "<div class='managements well well-sm col-sm-4'><span>". $row['Management'] ."</span></div>";
				}
				echo "<div class='btn  btn-lg managements well well-sm col-sm-10 col-sm-offset-1' data-toggle='modal' data-target='#addLevelModal'><i class='fa fa-plus-circle'></i></div>";
		}elseif($page == 'empData.php'){
			foreach($result as $row){
			    echo "<option value=" .$row['ID'].">" . $row['empLevel'] . "</option>";
			}
		}
	}
	//---------------get contract type function-----------------------
	function getContract(){
		$con = connect();
		$page =  basename($_SERVER['REQUEST_URI']);
		$sql= "SELECT ID,contractType FROM contract" ;
    	$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		if($page == 'contract.php'){
			foreach($result as $row){
				echo '<button  class="btn  btn-lg managements editcontractData well well-sm col-sm-10 col-sm-offset-1" data-toggle="modal" data-target="#editcontractModal" id="'.$row['ID'].'">'. $row['contractType'] .'</button>';
				}
				echo "<div class='btn  btn-lg managements well well-sm col-sm-10 col-sm-offset-1' data-toggle='modal' data-target='#addcontractModal'><i class='fa fa-plus-circle'></i></div>";
	
		}elseif($page == 'empData.php'){
			foreach($result as $row){
			    echo "<option value=" .$row['ID'].">" . $row['contractType'] . "</option>";
			}
		}
	    	
	}
	//get marital status in choises
	function get_marital_status(){
		$con = connect();
		$page =  basename($_SERVER['REQUEST_URI']);
		$sql= "SELECT ID,maritalStatus,social_insurance,med_insurance FROM maritalStatus" ;
    	$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		if($page == 'maritalstatus.php'){
			foreach($result as $row){
				echo '<button  class="btn  btn-lg managements editmaritalstatusData well well-sm col-sm-10 col-sm-offset-1" data-toggle="modal" data-target="#editMaritalStatusModal" id="'.$row['ID'].'">'. $row['maritalStatus'] .'</button>';
				}
				echo "<div class='btn  btn-lg managements well well-sm col-sm-10 col-sm-offset-1' data-toggle='modal' data-target='#addMaritalStatusModal'><i class='fa fa-plus-circle'></i></div>";
	
		}elseif($page == 'empData.php'){
	    	foreach($result as $row){
			    echo "<option value=" .$row['ID'].">" . $row['maritalStatus'] . "</option>";
			}
		}

	}
	//---------------get user group function-----------------------
	function getUserGroup(){
		$con = connect();
		$sql= "SELECT ID,userGroup FROM user_group" ;
    	$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
	    	foreach($result as $row){
			    echo "<option value=" .$row['ID'].">" . $row['userGroup'] . "</option>";
			}
	}
	//---------------get jobs type function-----------------------
	function getJob(){
		$page =  basename($_SERVER['REQUEST_URI']);
		$con = connect();
		$sql= "SELECT ID,job FROM job" ;
    	$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		if($page == 'job.php'){
			foreach($result as $row){
				echo '<button  class="btn  btn-lg managements editjobData well well-sm col-sm-10 col-sm-offset-1" data-toggle="modal" data-target="#editjobModal" id="'.$row['ID'].'">'. $row['job'] .'</button>';
				}
				echo "<div class='btn  btn-lg managements well well-sm col-sm-10 col-sm-offset-1' data-toggle='modal' data-target='#addjobModal'><i class='fa fa-plus-circle'></i></div>";
	
		}elseif($page == 'empData.php'){
	    	foreach($result as $row){
			    echo "<option value=" .$row['ID'].">" . $row['job'] . "</option>";
			}
		}

	}
	//---------------get syndicates-----------------------
	function getsyndicate(){
		$page =  basename($_SERVER['REQUEST_URI']);
		$con = connect();
		$sql= "SELECT ID,syndicate,amount FROM syndicates" ;
    	$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		if($page == 'syndicates.php'){
			foreach($result as $row){
				echo '<button  class="btn  btn-lg managements editsyndicateData well well-sm col-sm-10 col-sm-offset-1" data-toggle="modal" data-target="#editsyndicateModal" id="'.$row['ID'].'">'. $row['syndicate'] .'</button>';
				}
				echo "<div class='btn  btn-lg managements well well-sm col-sm-10 col-sm-offset-1' data-toggle='modal' data-target='#addsyndicateModal'><i class='fa fa-plus-circle'></i></div>";
	
		}elseif($page == 'empData.php'){
	    	foreach($result as $row){
			    echo "<option value=" .$row['ID'].">" . $row['syndicate'] . "</option>";
			}
		}

	}
	// --------------get Employee function-----------------------
	function getAllEmp(){
		$output="";
		$con = connect();
		$sql= '';		
		if(!empty($_GET['search'])){
			$sql = "select e.*,s.syndicate
					from employee e,syndicates s 
					where e.syndicate_id = s.ID
						  and (currentCode like '%". $_GET['search'] ."%' 
								OR empName like '%". $_GET['search'] ."%') 
					ORDER BY currentCode";
		}else{
			// $sql = "select e.ID,e.empName,e.gender,e.education,e.basicSalary,s.syndicate,ec.empCode,s.syndicate,
			// 				j.job,l.empLevel,c.contractType,ms.maritalStatus
					
			// 		from employee e inner join emp_contract ec on e.ID = ec.emp_id
			// 			inner join emp_job ej on e.ID = ej.emp_id
			// 			inner join  emp_level el on e.ID = el.emp_id
			// 			inner join	syndicates s on e.syndicate_id = s.ID
			// 			inner join emp_maritalstatus ems on e.ID = ems.emp_id
			// 			,job j,level l,contract c,maritalStatus ms
				
			// 		where j.id = ej.job_id
			// 			and l.id= el.level_id
			// 			and c.ID = ec.contract_id
			// 			and ms.ID = ems.marital_status_id"; 
			$sql=" select e.*,s.syndicate
				   from employee e,syndicates s 
				   where e.syndicate_id = s.ID";
		}
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		foreach($result as $row){
			$output .= 
			"<tr>
				<td>".  $row['currentCode']. "</td>
				<td>".  $row['empName']. "</td>
				<td>".  $row['currentContract']. "</td>
				<td>".  $row['currentJob']. "</td>
				<td>".  $row['currentMS']. "</td>
				<td>".  $row['currentLevel']. "</td>
				<td>".  $row['gender']. "</td>
				<td>".  $row['syndicate']. "</td>
				<td><button type='button' class='btn btn-primary btn-sm editEmpData' data-toggle='modal' 
				data-target='#editEmpModal' id=".$row['ID'].">تعديل</button></td>
				</tr>";
		 }
		echo $output;
	}
	//---------------get number of Employees---------------------
	function getEmpCount(){
		$con = connect();		
		$sql = "SELECT count(*) FROM employee"; //count emp from view
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		echo $result;
	}
	// --------------Add Employee function-----------------------
	function addEmp(){
		//check if user comming from a request
		 // $_SERVER['REQUEST_METHOD'] == 'POST'
		if(isset($_POST['insertEmp'])){
			//assign variables

			$empName= isset($_POST['empName'])? filter_var($_POST['empName'],FILTER_SANITIZE_STRING) : '';
			$empCode= isset($_POST['empCode'])? filter_var($_POST['empCode'],FILTER_SANITIZE_NUMBER_INT):'';
			$contractType= isset($_POST['contractType'])? filter_var($_POST['contractType'],FILTER_SANITIZE_NUMBER_INT):'';
			$job= isset($_POST['job'])? filter_var($_POST['job'],FILTER_SANITIZE_NUMBER_INT):'';
			// $job= $_POST['job'];
			// echo $job;
			$GManagement= isset($_POST['GManagement'])? filter_var($_POST['GManagement'],FILTER_SANITIZE_NUMBER_INT) :'';
			$level = isset($_POST['level'])? filter_var($_POST['level'],FILTER_SANITIZE_NUMBER_INT):'';
			$day_n= isset($_POST['day_n'])? filter_var($_POST['day_n'],FILTER_SANITIZE_NUMBER_INT) :'';
			$active= isset($_POST['active'])? filter_var($_POST['active'],FILTER_SANITIZE_NUMBER_INT) :'';
			$management= isset($_POST['management'])? filter_var($_POST['management'],FILTER_SANITIZE_STRING) :'';
			$jobDesc= isset($_POST['desc_job'])? filter_var($_POST['desc_job'],FILTER_SANITIZE_STRING) : '';
			$userGroup=isset($_POST['userGrp'])? filter_var($_POST['userGrp'],FILTER_SANITIZE_NUMBER_INT):'';
			$defaultPass=sha1(1234567);
			// creating array of errors
			$formErrors = array();

			if (empty($empName) || empty($empCode) ){
				//$formErrors[] = 'username must be larger than  chars';
				echo "name and code cant be empty";
				// print_r($formErrors) ;
			} else {
				$con = connect();
				$sql= "INSERT INTO t_data(emp_code,emp_name,contract_type,id_job,desc_job,level_id,management,g_management_id,day_night,active,password,id_userGroup) 
					   VALUES ('".$empCode."','".$empName."','".$contractType."','".$job."','".$jobDesc."','".$level."','".$management."','".$GManagement."' ,'".$day_n."','".$active."','".$defaultPass."','".$userGroup."')" ;
		        $stmt = $con->prepare($sql);
				$stmt->execute();
				echo "done";
			}
		}
	}	
	
	// --------------Edit Employee function-----------------------
	function editEmp(){
		$empID=isset($_POST['employee_id'])? filter_var($_POST['employee_id'],FILTER_SANITIZE_NUMBER_INT):'';
		$empName= isset($_POST['empNameEdit'])? filter_var($_POST['empNameEdit'],FILTER_SANITIZE_STRING) : '';
		$empCode= isset($_POST['empCodeEdit'])? filter_var($_POST['empCodeEdit'],FILTER_SANITIZE_NUMBER_INT):'';
		$contractType= isset($_POST['contractTypeEdit'])? filter_var($_POST['contractTypeEdit'],FILTER_SANITIZE_NUMBER_INT):'';
		$job= isset($_POST['jobEdit'])? filter_var($_POST['jobEdit'],FILTER_SANITIZE_NUMBER_INT):'';
		$GManagement= isset($_POST['GManagementEdit'])? filter_var($_POST['GManagementEdit'],FILTER_SANITIZE_NUMBER_INT) :'';
		$level = isset($_POST['levelEdit'])? filter_var($_POST['levelEdit'],FILTER_SANITIZE_NUMBER_INT):'';
		$day_n= isset($_POST['day_nEdit'])? filter_var($_POST['day_nEdit'],FILTER_SANITIZE_NUMBER_INT) :'';
		$active= isset($_POST['activeEdit'])? filter_var($_POST['activeEdit'],FILTER_SANITIZE_NUMBER_INT) :'';
		$management= isset($_POST['managementEdit'])? filter_var($_POST['managementEdit'],FILTER_SANITIZE_STRING) :'';
		$jobDesc= isset($_POST['desc_jobEdit'])? filter_var($_POST['desc_jobEdit'],FILTER_SANITIZE_STRING) : '';
		$userGroup=isset($_POST['userGrpEdit'])? filter_var($_POST['userGrpEdit'],FILTER_SANITIZE_NUMBER_INT):'';		
		$con = connect();
		$sql= '';
		$sql .= "UPDATE t_data
				 SET emp_code = '$empCode' ,
					 emp_name = '$empName',
					 contract_type = '$contractType',
					 id_job = '$job',
					 desc_job = '$jobDesc',
					 level_id = '$level',
					 management = '$management',
					 g_management_id = '$GManagement',
					 day_night = '$day_n',
					 active = '$active',
					 id_userGroup= '$userGroup'
				 WHERE ID= '$empID'";
		$stmt = $con->prepare($sql);
		$stmt->execute();
	}	
	//---------------get managments function-----------------------
	function getManagement(){
		$con = connect();
		$sql= "SELECT ID,Management FROM managements" ;
    	$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
	    	foreach($result as $row){
			    echo "<option value=" .$row['ID'].">" . $row['Management'] . "</option>";
			}		
	}
		//---------------add new managment function-----------------------
	function addManagement(){
		if(isset($_POST['insertManagement'])){
			//assign variables

			$managementName= isset($_POST['managementName'])? filter_var($_POST['managementName'],FILTER_SANITIZE_STRING) : '';

			// creating array of errors
			$formErrors = array();

			if (empty($managementName) ){
				//$formErrors[] = 'username must be larger than  chars';
				echo "management cant be empty";
				// print_r($formErrors) ;
			} else {
				$con = connect();
				$sql= "INSERT INTO managements(Management)VALUES ('".$managementName."')" ;
				$stmt = $con->prepare($sql);
				$stmt->execute();
				echo "done";
			}
		}
	}
	//---------------edit managment function-----------------------
	function editManagement(){

			//assign variables
			$managementID=isset($_POST['management_id'])? filter_var($_POST['management_id'],FILTER_SANITIZE_NUMBER_INT):'';
			$managementName= isset($_POST['managementEdit'])? filter_var($_POST['managementEdit'],FILTER_SANITIZE_STRING) : '';
			echo $managementID;
			echo $managementName;
				$con = connect();
				$sql =     "UPDATE managements
							SET Management = '$managementName'
							WHERE ID= '$managementID'";
				$stmt = $con->prepare($sql);
				$stmt->execute();
				echo "done";
	}
