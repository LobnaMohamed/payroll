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
		}elseif($page == 'empdata.php'){
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
	
		}elseif($page == 'empdata.php'){
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
	
		}elseif($page == 'empdata.php'){
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
	
		}elseif($page == 'empdata.php'){
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
	
		}elseif($page == 'empdata.php'){
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
			$sql = "select ID,empName,currentCode
					from employee 
					where  (currentCode like '%". $_GET['search'] ."%' 
								OR empName like '%". $_GET['search'] ."%') 
					ORDER BY currentCode";
		}else{
			$sql=" select ID,empName,currentCode
					from employee 
					ORDER BY currentCode";
		}
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		foreach($result as $row){
			$output .= 
			"<tr>
				<td>".  $row['currentCode']. "</td>
				<td>".  $row['empName']. "</td>
				<td>
					<button type='button' class='btn btn-primary btn-sm editEmpData' data-toggle='modal' 
					data-target='#editEmpModal' id=".$row['ID']."><i class='fa fa-edit fa-lg' aria-hidden='true'></i></button>
				</td>
				<td>
					<button type='button' class='btn btn-primary btn-sm viewcurrentEmp' data-toggle='modal' 
					data-target='#viewcurrentEmpModal' id=".$row['ID']."><i class='fa fa-address-card-o fa-lg' aria-hidden='true'></i></button>
				</td>
				<td>
					<button type='button' class='btn btn-primary btn-sm' data-toggle='modal' 
					data-target='#viewEmphistoryModal' id=".$row['ID']."><i class='fa fa-history fa-lg' aria-hidden='true'></i></button>
				</td>
			</tr>";
		 }
		echo $output;
	}
	// --------------get Employee current profile function-----------------------
	function getEmpCurrentProfile(){
		//$output="";
		$con = connect();		
		$sql="select * from empCurrentProfile where ID = ".$_POST['currentProfileEmpID']."";
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch();
		echo json_encode($result); 

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
	
	//---------------get timesheet function------------------------
	function getTimesheet(){
		$output="";	
		$con = connect();
		$sql= '';		
		$sql="select t.*,e.currentCode,e.empName
				from employee e,timesheet t
				where t.emp_id = e.ID
						and month(t.sheetDate) = month(getdate())";
		
		if(!empty($_GET['timesheetDate'])){
			$sql = "select t.*,e.currentCode,e.empName
					from employee e,timesheet t
					where t.emp_id = e.ID
							and month(t.sheetDate)= month('".$_GET['timesheetDate']."')";	
		}
		if(!empty($_GET['search'])){
			$sql .= " and (e.currentCode like '%". $_GET['search'] ."%' OR e.empName like '%". $_GET['search'] ."%')";	
		}
		
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		foreach($result as $row){
			//$output .= "<tr><td>".  $row['sheetDate']. "</td></tr>";
			$output .=
			"<tr>
				<td>".  $row['currentCode']. "</td>
				<td>".  $row['empName']. "</td>
				<td>".  $row['presence_days']. "</td>
				<td>".  $row['absence_days']. "</td>
				<td>".  $row['casual_days']. "</td>
				<td>".  $row['sickLeave_days']. "</td>
				<td>".  $row['deduction_days']. "</td>
				<td>".  $row['annual_days']. "</td>
				<td>".  $row['manufacturing_days']. "</td>
				<td>".  $row['shift_days']. "</td>
				<td>".  $row['overnight_days']. "</td>
				<td>".  $row['notes']. "</td>
			</tr>";
			}
		echo $output;
	}
	// --------------Add Employee function-----------------------
	function addEmp(){
		//check if user comming from a request
			// $_SERVER['REQUEST_METHOD'] == 'POST'
			//assign variables
			
			$addempName= isset($_POST['addempName'])? filter_var($_POST['addempName'],FILTER_SANITIZE_STRING) : '';
			$addempCode= isset($_POST['addempCode'])? filter_var($_POST['addempCode'],FILTER_SANITIZE_NUMBER_INT):'';
			$addcontractType= isset($_POST['addcontractType'])? filter_var($_POST['addcontractType'],FILTER_SANITIZE_NUMBER_INT):'';
			$addjob= isset($_POST['addjob'])? filter_var($_POST['addjob'],FILTER_SANITIZE_NUMBER_INT):'';
			$addlevel = isset($_POST['addlevel'])? filter_var($_POST['addlevel'],FILTER_SANITIZE_NUMBER_INT):'';
			$addshift= isset($_POST['addshift'])? filter_var($_POST['addshift'],FILTER_SANITIZE_STRING) :'';
			$addmaritalstatus= isset($_POST['addmaritalstatus'])? filter_var($_POST['addmaritalstatus'],FILTER_SANITIZE_NUMBER_INT) :'';
			$adddesc_job= isset($_POST['adddesc_job'])? filter_var($_POST['adddesc_job'],FILTER_SANITIZE_STRING) : '';
			$addeducation = isset($_POST['addeducation'])? filter_var($_POST['addeducation'],FILTER_SANITIZE_STRING) : '';
			$addbasicsalary = isset($_POST['addbasicsalary'])? filter_var($_POST['addbasicsalary'],FILTER_SANITIZE_NUMBER_FLOAT) :'';
			$addsyndicate = isset($_POST['addsyndicate'])? filter_var($_POST['addsyndicate'],FILTER_SANITIZE_NUMBER_INT):'';
			$addgender = isset($_POST['addgender'])? filter_var($_POST['addgender'],FILTER_SANITIZE_STRING) : '';
			// creating array of errors
			$formErrors = array();

			if (empty($addempName) || empty($addempCode) ){
				//$formErrors[] = 'username must be larger than  chars';
				echo "name and code cant be empty";
				// print_r($formErrors) ;
			} else {
				$con = connect();
				$sql= "INSERT INTO employee(currentCode,empName,currentContract,currentJob,currentLevel,currentShift,currentMS,gender,
							currentSalary,syndicate_id) 
						VALUES ('".$addempCode."','".$addempName."','".$addcontractType."','".$addjob."','".$addlevel."','".$addshift."',
						'".$addmaritalstatus."','".$addgender."','".$addbasicsalary."','".$addsyndicate."')" ;
				$stmt = $con->prepare($sql);
				$stmt->execute();
				
				echo "done";
			}
	}
	// --------------Edit Employee function-----------------------
	function editEmp(){
		$employee_ID = isset($_POST['employee_idEdit'])? filter_var($_POST['employee_idEdit'],FILTER_SANITIZE_NUMBER_INT):'';
		$contractDate = isset($_POST['contractDate'])? $_POST['contractDate']:'';
		$levelDate = isset($_POST['levelDate'])? $_POST['levelDate']:'';
		$jobDate = isset($_POST['jobDate'])? $_POST['jobDate']:'';
		$basicSalaryDate = isset($_POST['basicSalaryDate'])? $_POST['basicSalaryDate']:'';
		$empNameEdit= isset($_POST['empNameEdit'])? filter_var($_POST['empNameEdit'],FILTER_SANITIZE_STRING) : '';
		$empCodeEdit= isset($_POST['empCodeEdit'])? filter_var($_POST['empCodeEdit'],FILTER_SANITIZE_NUMBER_INT):'';
		$contractTypeEdit= isset($_POST['contractTypeEdit'])? filter_var($_POST['contractTypeEdit'],FILTER_SANITIZE_NUMBER_INT):'';
		//$jobEdit= isset($_POST['jobEdit'])? filter_var($_POST['jobEdit'],FILTER_SANITIZE_NUMBER_INT):'';
		$jobEdit=  filter_var($_POST['jobEdit'],FILTER_SANITIZE_NUMBER_INT);
		
		$levelEdit = isset($_POST['levelEdit'])? filter_var($_POST['levelEdit'],FILTER_SANITIZE_NUMBER_INT):'';
		$shiftEdit= isset($_POST['shiftEdit'])? filter_var($_POST['shiftEdit'],FILTER_SANITIZE_STRING) :'';
		$maritalstatusEdit= isset($_POST['maritalstatusEdit'])? filter_var($_POST['maritalstatusEdit'],FILTER_SANITIZE_NUMBER_INT) :'';
		$desc_jobEdit= isset($_POST['desc_jobEdit'])? filter_var($_POST['desc_jobEdit'],FILTER_SANITIZE_STRING) : '';
		$educationEdit = isset($_POST['educationEdit'])? filter_var($_POST['educationEdit'],FILTER_SANITIZE_STRING) : '';
		$basicsalaryEdit = isset($_POST['basicsalaryEdit'])? filter_var($_POST['basicsalaryEdit'],FILTER_SANITIZE_NUMBER_FLOAT) :'';
		$syndicateEdit = isset($_POST['syndicateEdit'])? filter_var($_POST['syndicateEdit'],FILTER_SANITIZE_NUMBER_INT):'';
		$genderEdit = isset($_POST['genderEdit'])? filter_var($_POST['genderEdit'],FILTER_SANITIZE_STRING) : '';
		
		echo "job:";
		echo $jobEdit;
		echo "level:";

		echo $levelEdit;
		echo "ms:";

		echo $maritalstatusEdit;
		echo "contract:";

		echo $contractTypeEdit;

		echo "<br>";
		
		//sql statements to be executed
		if(isset($jobEdit)){
			$job_sql = "insert into emp_job(emp_id,job_id,job_date,job_description,shift)
						values('$employee_ID','$jobEdit','$jobDate','$desc_jobEdit','$shiftEdit')";
			$emp_sql = "UPDATE employee SET currentJob = '$jobEdit'	WHERE ID= '$employee_ID'";		
			$con = connect();
			$stmt = $con->prepare($job_sql);
			$stmt2 = $con->prepare($emp_sql);
			$stmt->execute();
			$stmt2->execute();	
		}
		elseif(isset($maritalstatusEdit)){
			$MS_sql = "insert into emp_maritalstatus(emp_id,marital_status_id)values('$employee_ID','$maritalstatusEdit')";
			$emp_sql = "UPDATE employee SET currentMS = '$maritalstatusEdit' WHERE ID= '$employee_ID'";		
			$stmt = $con->prepare($MS_sql);
			$stmt2 = $con->prepare($emp_sql);
			$stmt->execute();
			$stmt2->execute();
		}
		elseif(isset($levelEdit)){
		    $level_sql = "insert into emp_level(emp_id,level_id)values('$employee_ID','$levelEdit')";
			$emp_sql = "UPDATE employee SET currentLevel = '$levelEdit' WHERE ID= '$employee_ID'";		
			$stmt = $con->prepare($level_sql);
			$stmt2 = $con->prepare($emp_sql);
			$stmt->execute();
			$stmt2->execute();
		}
		elseif(isset($contractTypeEdit)){
		    $contract_sql = "insert into emp_contract(emp_id,contract_id,empCode,contract_date)values('$employee_ID','$contractTypeEdit','$empCodeEdit')";
			$emp_sql = "UPDATE employee SET currentContract = '$contractType' WHERE ID= '$employee_ID'";		
			$stmt = $con->prepare($contract_sql);
			$stmt2 = $con->prepare($emp_sql);
			$stmt->execute();
			$stmt2->execute();
		}
		elseif(isset($basicsalaryEdit)){
		    $basicSalary_sql = "insert into emp_basicsalary(emp_id,basicSalary,salaryDate)values('$employee_ID','$basicsalaryEdit')";
			$emp_sql = "UPDATE employee SET currentSalary = '$basicsalaryEdit' WHERE ID= '$employee_ID'";		
			$stmt = $con->prepare($basicSalary_sql);
			$stmt2 = $con->prepare($emp_sql);
			$stmt->execute();
			$stmt2->execute();
		}
		else{
			echo "nothing to edit";
		}
		// $emp_sql = "UPDATE employee
		// 			SET currentCode = '$empCode',
		// 				empName = '$empName',
		// 				currentContract = '$contractType',
		// 				currentJob = '$job',
		// 				currentMS = '$maritalstatusEdit',
		// 				currentLevel = '$level',
		// 				currentShift = '$shiftEdit',
		// 				currentSalary = '$basicsalaryEdit',
		// 				gender = '$genderEdit'
		// 			WHERE ID= '$employee_ID'";
		// $con = connect();
		// $stmt = $con->prepare($sql);
		// $stmt->execute();
		//echo json_encode($result); 
	}
	//---------------edit levels function-------------------------
	//---------------edit contracts function----------------------
	//---------------edit marital status function-----------------
	//---------------edit jobs function---------------------------
	//---------------edit syndicates function---------------------
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
	//---------------calculate benifits of salary------------------
	function calculateBenefits(){
		$con = connect();		
		$sql = "select e.ID	,e.currentSalary,e.currentSpecialization,ts.presence_days,ms.social_insurance,s.amount,
					   e.currentWorkAllowanceNature,ts.manufacturing_days,ts.overnight_days,ts.shift_days,l.incentivePercent,
					   j.specialization_amount,j.experience_amount,j.representation_amount,ts.ID as timesheetID
				from   employee e,timesheet ts,maritalStatus ms,syndicates s,level l,job j
				where  e.ID = ts.emp_id
					   and e.currentMS = ms.ID
					   and e.syndicate_id = s.ID
					   and e.currentLevel = l.ID
					   and e.currentJob = j.ID";
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		foreach($result as $row){
			$currentDays = ($row['presence_days'])/30; // عدد أيام الحضور/30

			$attendancePay = $row['currentSalary'] * $currentDays;//اجر الحضور
			$natureOfworkAllowance =$row['currentWorkAllowanceNature'] * $currentDays; // بدل طبيعة
			$socialAid = $row['social_insurance'] ; //م.اجتماعية
			$representation = $row['representation_amount']; // تمثيل
			// if($row['syndicate_id'] == 2){
			// 	$chemistIncentive = $row['amount'];//حافز علميين
			// 	$occupationalAllowance = 0;
			// }
			// else{
			// 	$occupationalAllowance = $row['amount'] ; // بدل مهنى
			// 	$chemistIncentive = 0 ;
			// }
			$occupationalAllowance = $row['amount'];
			$manufacturingAllowance = 8 * (22- $row['manufacturing_days']); // بدل تصنيع
			$experience = ($currentDays) * $row['experience_amount']; // خبرة
			$overnightShift = ($row['overnight_days'] * 2) * ($row['currentSalary']/30) ; // نوباتجية
			$labordayGrant = (10) *  $currentDays ; // منحة عيد العمال
			$tiffinAllowance = (15) *  $row['presence_days'] ; // وجبات نقدية
		    $incentive = $row['currentSalary'] * $row['incentivePercent'] * 0.75 * $currentDays;//الحافز
		    $shift = 75 * $row['shift_days']; // وردية
			$specializationAllowance = $currentDays * ($row['specialization_amount']+ ($row['currentSalary']/4)) ; // بدل تخصص
			// $specialBonus = ; // علاوات خاصة
			// $otherDues = ; // استحقاق
			// $totalBenifits = ; // اجمالى الاستحقاق

			//-----------insert into salary table---------------- 
			$sql2 ="insert into salary(emp_id,TS_id,attendancePay,natureOfworkAllowance,socialAid,representation,occupationalAllowance,
					experience,overnightShift,labordayGrant,tiffinAllowance,incentive,specializationAllowance)
					values(".$row['ID'].",".$row['timesheetID'].",".$attendancePay.",".$natureOfworkAllowance.",".$socialAid.",".$representation.",".$occupationalAllowance.",
					".$experience.",".$overnightShift.",".$labordayGrant.",".$tiffinAllowance.",".$incentive.",".$specializationAllowance.")";
			$stmt = $con->prepare($sql2);
			$stmt->execute();
			echo $sql2;
		}
	}
	//---------------calculate benifits of salary------------------
	function calculateDeductions(){
		$con = connect();		
		$sql = "select  e.ID,e.currentSalary,ts.presence_days,ms.med_insurance
				from    employee e,timesheet ts,maritalStatus ms
				where   e.ID = ts.emp_id
						and e.currentMS = ms.ID";
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		foreach($result as $row){
			$sanction_days = 0;
			$pastPeriod = 0;//مدة سابقة
			$perimiumCard = 0 ; 
			$familyHealthInsurance = $row['med_insurance']  ; //علاج اسر
			$otherDeduction = 0; // استقطاع اخر
			$petroleumSyndicate= 10; // ن.بترول
			$sanctions = ($row['currentSalary']/30) * $sanction_days; // جزاءات
			$mobil = 0; // نوباتجية
			$loan = 0; //قرض
			$empServiceFund = 20; // صندوق خدمات عاملين
			$socialInsurances = 0;//تأمينات
			$etisalatNet =  0; 
			//$totalDeductions = ; // اجمالى الاستقطاع

		}
	}
	//---------get totals of benefits and deductions and netsalary-------
	function getWagesTotals(){
		$output="";
		$con = connect();
		if(!empty($_GET['dateFrom'])){		
			$sql = "select  e.empName,e.currentCode,s.totalBenefits,s.totalDeductions,s.netSalary,
							s.emp_id,s.TS_id
					from    employee e inner join timesheet ts 
							on e.ID = ts.emp_id inner join salary s 
							on ts.ID = s.TS_id
					where  ts.sheetDate = '" . $_GET['dateFrom'] ."'";
		}else{
			$sql = "select  e.empName,e.currentCode,s.totalBenefits,s.totalDeductions,s.netSalary,
							s.emp_id,s.TS_id
					from    employee e inner join timesheet ts 
							on e.ID = ts.emp_id inner join salary s 
							on ts.ID = s.TS_id
					where  month(ts.sheetDate) = month(getDate())-1 and year(ts.sheetDate)= year(getDate())";
		}
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		foreach($result as $row){
			$output .= 
			"<tr>
				<td>".  $row['currentCode']. "</td>
				<td>".  $row['empName']. "</td>
				<td>".  $row['totalBenefits']. "</td>
				<td>".  $row['totalDeductions']. "</td>
				<td>".  $row['netSalary']. "</td>

			</tr>";
			
		}
		echo $output;
	}
	//----------get wage details-----------------------------
	function viewWagesDetails(){
	// 	<td>
	// 	<button type='button' class='btn btn-primary btn-sm' data-toggle='modal' 
	// 	data-target='#WagesDetailsModal' id=".array($row['emp_id'],$row['TS_id']).">
	// 	<i class='fa fa-info fa-lg' aria-hidden='true'></i>
	// 	</button>
	// </td>
	}