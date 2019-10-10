<?php
	//include 'connect.php';
	// --------------connection to database function-------------
	function connect(){
		$servername = "LOBNA-PC";
        // $username = "username";
        // $password = "password";
        
        try {
			//$con = new PDO("sqlsrvr:host=$servername;dbname=wages" );
			$con = new PDO("sqlsrv:Server=$servername;Database=payroll_new");
            // set the PDO error mode to exception
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully"; 
            }
        catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
		    }
		return $con;
	}	
	// --------------get Employee function-----------------------
	function getEmpDropDown(){
		$con = connect();
		$sql=" select ID,empName,currentCode
					from employee 
					ORDER BY currentCode";

		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		echo "<option selected  value='0'></option>";
		foreach($result as $row){

			echo "<option value=" .$row['ID'].">" . $row['currentCode'] ."   ".$row['empName']. "</option>";
		}
		
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
				echo '<button  class="btn btn-lg managements editcontractData well well-sm col-sm-10 col-sm-offset-1" data-toggle="modal" data-target="#editcontractModal" id="'.$row['ID'].'">'. $row['contractType'] .'</button>';
				}
				echo "<div class='btn btn-lg managements well well-sm col-sm-10 col-sm-offset-1' data-toggle='modal' data-target='#addcontractModal'><i class='fa fa-plus-circle'></i></div>";
	
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
		$output ="";
		$page =  basename($_SERVER['REQUEST_URI']);
		$con = connect();
		$sql= "SELECT * FROM job" ;
    	$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		if($page == 'job.php'){
			foreach($result as $row){
				$output .= 
				"<tr>
					<td>".  $row['job']. "</td>
					<td>".  $row['experience_amount']. "</td>
					<td>".  $row['specialization_amount']. "</td>
					<td>".  $row['representation_amount']. "</td>
					<td>
						<button type='button' class='btn btn-primary btn-sm   editjobData' data-toggle='modal' 
						data-target='#editjobModal' id=".$row['ID']."><i class='fa fa-edit fa-lg' aria-hidden='true'></i></button>
					</td>
				</tr>";
				//echo '<button  class="btn  btn-lg managements editjobData well well-sm col-sm-10 col-sm-offset-1" data-toggle="modal" data-target="#editjobModal" id="'.$row['ID'].'">'. $row['job'] .'</button>';
				}
				//echo "<div class='btn  btn-lg managements well well-sm col-sm-10 col-sm-offset-1' data-toggle='modal' data-target='#addjobModal'><i class='fa fa-plus-circle'></i></div>";
				echo $output ;
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
	// --------------get job details function-----------------------
	function getJobDetails(){
		//$output="";
		$con = connect();		
		$sql="select * from job where ID = ".$_POST['job_id']."";
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch();
		echo json_encode($result); 

	}
	// --------------get Employee function-----------------------
	function getAllEmp(){
		$output="";
		$con = connect();
		$sql= '';		
		if(!empty($_POST['search'])){
			$sql = "select ID,empName,currentCode
					from employee 
					where  (currentCode like '%". $_POST['search'] ."%' 
								OR empName like '%". $_POST['search'] ."%') 
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
					<button type='button' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#viewEmphistoryModal'
					 id=".$row['ID']."><i class='fa fa-history fa-lg' aria-hidden='true'></i></button>
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
	// --------------get level details function-----------------------
	function getLevelDetails(){
		//$output="";
		$con = connect();		
		$sql="select * from level where ID = ".$_POST['level_id']."";
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch();
		echo json_encode($result); 

	}
	// --------------get contract details function-----------------------
	function getContractDetails(){
		//$output="";
		$con = connect();		
		$sql="select * from contract where ID = ".$_POST['contract_id']."";
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch();
		echo json_encode($result); 

	}
	// --------------get ms details function-----------------------
	function getMSDetails(){
		//$output="";
		$con = connect();		
		$sql="select * from maritalStatus where ID = ".$_POST['MS_id']."";
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch();
		echo json_encode($result); 

	}
	// --------------get ms details function-----------------------
	function getsyndicateDetails(){
		//$output="";
		$con = connect();		
		$sql="select * from syndicates where ID = ".$_POST['syndicate_id']."";
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
	//---------------get deduction types---------------------------
	function getDeductionTypes(){
		$page =  basename($_SERVER['REQUEST_URI']);
		$output="";
		$con = connect();
		$sql = "select * from deductionTypes ";

		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		if($page == 'deductiontype.php'){
			foreach($result as $row){
				echo '<button  class="btn  btn-lg managements editsyndicateData well well-sm col-sm-10 col-sm-offset-1" data-toggle="modal" 
				data-target="#editsyndicateModal" id="'.$row['deductionTypeID'].'">'. $row['deductionType'] .'</button>';
			}
			echo "<div class='btn  btn-lg managements well well-sm col-sm-10 col-sm-offset-1' data-toggle='modal' 
				data-target='#addsyndicateModal'><i class='fa fa-plus-circle'></i></div>";
		}elseif($page == 'deductionfromcredit.php'){
			echo "<option value=0 >all</option>";

	    	foreach($result as $row){
				
			    echo "<option value=" .$row['deductionTypeID'].">" . $row['deductionType'] . "</option>";
			}
		}
		
	
		//echo $output;
	}
	//---------------get timesheet function------------------------
	function getTimesheet(){
		$output="";	
		$con = connect();
		$sql= '';		
		if(!empty($_POST['dateFrom'])){
			// $sql = "select t.*,e.currentCode,e.empName
			// 		from employee e,timesheet t
			// 		where t.emp_id = e.ID
			// 				and month(t.sheetDate)= month('".$_POST['timesheetDate']."')";	
			//--------------------------------------------------------------
			//payroll_new database
			$sql= "select t.*,e.currentCode,e.empName,empt.*
					from timesheets t inner join empTimesheet empt on t.ID = empt.TS_id 
						inner join employee e on empt.emp_id = e.ID
					and month(t.sheetDate)=  month('".$_POST['dateFrom']."')";
		}
		if(!empty($_POST['search'])){
			$sql .= " and (e.currentCode like '%". $_POST['search'] ."%' OR e.empName like '%". $_POST['search'] ."%')";	
		}
		
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		if(! $result ){
			$output = "
			<tr>
			<td colspan='13' class='alert alert-warning'> 
			<strong>لا يوجد حصر أيام الحضور بهذا التاريخ.. لادخال الحصر اضغط هنا</strong><a href='#'>here</a>
			</td></tr>";
			
		// 	$sql = "select  e.empName,e.currentCode,e.ID
		// 	from	employee e";

		// $stmt = $con->prepare($sql);
		// $stmt->execute();
		// $result = $stmt->fetchAll();
		// foreach($result as $row){
		// 	$empindex = $row['ID'];
		// 	$output .= "<tr>
		// 		<td>".  $row['currentCode']. "</td>
		// 		<td>".  $row['empName']. "</td>
		// 		<td>". $_POST['timesheetDate']. "</td>
		// 		<input name='emp_id' type='hidden' value=".$row['ID'].">
		// 		<td>
		// 			<input  class='form-control' name='presence_days[".$row['ID']."]' value=30>
		// 		</td> 
		// 		<td>
		// 			<input  class='form-control' name='sickLeave_days[".$row['ID']."]' value=0>
		// 		</td>  
		// 		<td>
		// 			<input class='form-control' name='deduction_days[".$row['ID']."]' value=0>
		// 		</td>
		// 		<td>
		// 			<input class='form-control' name='absence_days[".$row['ID']."]' value=0>
		// 		</td> 
		// 		<td>
		// 			<input class='form-control' name='annual_days[".$row['ID']."]' value=0>
		// 		</td>
		// 		<td>
		// 			<input class='form-control' name='casual_days[".$row['ID']."]' value=0>
		// 		</td>
		// 		<td>
		// 			<input class='form-control' name='manufacturing_days[".$row['ID']."]' value=0>
		// 		</td>
		// 		<td>
		// 			<input class='form-control' name='shift_days[".$row['ID']."]' value=0>
		// 		</td>
		// 		<td>
		// 			<input class='form-control' name='overnight_days[".$row['ID']."]' value=0>
		// 		</td>
		// 		<td>
		// 			<input class='form-control' name='notes[".$row['ID']."]'>
		// 		</td>
					
		// 	</tr>";
		// }
			
		}else{
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
					<td style='display:none;'  class='timesheet_ID'>" .  $row['TS_id']."</td>
					<td><a class='btn btn-sm edittimsesheetData'  id=".$row['emp_id'].">
					<i class='fa fa-edit fa-lg' data-toggle='modal' data-target='#edittimsesheetModal'></i>
					</a></td>
				</tr>";
			}
		}

		echo $output;
	}
	//---------------get timesheet function------------------------
	function getinsertTimesheet(){
		$output="";	
		$con = connect();
		$sql= '';		
		// $sql="select t.*,e.currentCode,e.empName
		// 		from employee e,timesheet t
		// 		where t.emp_id = e.ID
		// 				and month(t.sheetDate) = month(getdate())";
		
		if(!empty($_POST['dateFrom'])){	
			// $sql= "select t.*,e.currentCode,e.empName,empt.*
			// 		from timesheets t inner join empTimesheet empt on t.ID = empt.TS_id 
			// 			inner join employee e on empt.emp_id = e.ID
			// 		and month(t.sheetDate)=  month('".$_POST['timesheetDate']."')";
			$sql = "select  e.empName,e.currentCode,e.ID
					from	employee e
					where e.ID not in (select empt.emp_id
					from timesheets t inner join empTimesheet empt on t.ID = empt.TS_id 
					where month(t.sheetDate)=  month('".$_POST['dateFrom']."')) ";
		}
		if(!empty($_POST['search'])){
			$sql .= " and (e.currentCode like '%". $_POST['search'] ."%' OR e.empName like '%". $_POST['search'] ."%')";	
		}
		
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		if( $result ){
			// $sql = "select  e.empName,e.currentCode,e.ID
			// 		from	employee e
			// 		where e.currentCode like '%". $_POST['search'] ."%' OR e.empName like '%". $_POST['search'] ."%'";
			

			// $stmt = $con->prepare($sql2);
			// $stmt->execute();
			// $result = $stmt->fetchAll();
			foreach($result as $row){
				$empindex = $row['ID'];
				$output .= "<tr>
					<td>".  $row['currentCode']. "</td>
					<td>".  $row['empName']. "</td>
					
					<input name='emp_id' type='hidden' value=".$row['ID'].">
					<td>
						<input class='form-control' name='presence_days[".$row['ID']."]' value=30>
					</td> 
					<td>
						<input class='form-control' name='sickLeave_days[".$row['ID']."]' value=0>
					</td>  
					<td>
						<input class='form-control' name='deduction_days[".$row['ID']."]' value=0>
					</td>
					<td>
						<input class='form-control' name='absence_days[".$row['ID']."]' value=0>
					</td> 
					<td>
						<input class='form-control' name='annual_days[".$row['ID']."]' value=0>
					</td>
					<td>
						<input class='form-control' name='casual_days[".$row['ID']."]' value=0>
					</td>
					<td>
						<input class='form-control' name='manufacturing_days[".$row['ID']."]' value=0>
					</td>
					<td>
						<input class='form-control' name='shift_days[".$row['ID']."]' value=0>
					</td>
					<td>
						<input class='form-control' name='overnight_days[".$row['ID']."]' value=0>
					</td>
					<td>
						<input class='form-control' name='notes[".$row['ID']."]'>
					</td>
					     
				</tr>";
			}
			
		}else{
			$output = "
			<tr>
			<td colspan='12' class='alert alert-warning'> 
			<strong><i class='fa fa-exclamation-triangle'></i>
			تم ادخال حصر لهذا الشهر  من قبل..للتعديل اضغط هنا</strong>
			<a href='timesheet.php'>here</a>
			</td></tr>";
			// foreach($result as $row){
			// 	//$output .= "<tr><td>".  $row['sheetDate']. "</td></tr>";
			// 	$output .=
			// 	"<tr>
			// 		<td>".  $row['currentCode']. "</td>
			// 		<td>".  $row['empName']. "</td>
			// 		<td>".  $row['presence_days']. "</td>
			// 		<td>".  $row['absence_days']. "</td>
			// 		<td>".  $row['casual_days']. "</td>
			// 		<td>".  $row['sickLeave_days']. "</td>
			// 		<td>".  $row['deduction_days']. "</td>
			// 		<td>".  $row['annual_days']. "</td>
			// 		<td>".  $row['manufacturing_days']. "</td>
			// 		<td>".  $row['shift_days']. "</td>
			// 		<td>".  $row['overnight_days']. "</td>
			// 		<td>".  $row['notes']. "</td>
			// 	</tr>";
			// }
		}

		echo $output;
	}
	//===================insert  timesheet================
	function insertTimesheet(){
		$con = connect();
		$checkDate_sql = "select distinct ID from timesheets where sheetDate ='" . $_POST['searchDateFrom'] ."' ";
		$timesheetDate =$_POST['searchDateFrom'];
		//echo $timesheetDate;
		$stmt = $con->prepare($checkDate_sql);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		if(! $result){
			
			$timesheetsql = "insert into timesheets(sheetDate) values('$timesheetDate')";
			$stmt = $con->prepare($timesheetsql);
			$stmt->execute();
	
			$getlastTSID_sql = "select max(ID) from timesheets";
			
			$stmt = $con->prepare($getlastTSID_sql);
			$stmt->execute();
			$lastID = $stmt->fetchColumn();
			//echo $lastID;
		}else{
			// if timesheet already exist get its ID and insert for remaining emp the timesheet
			$getlastTSID_sql = "select ID  from timesheets where sheetDate =  '$timesheetDate' ";
			$stmt = $con->prepare($getlastTSID_sql);
			$stmt->execute();
			$lastID = $stmt->fetchColumn();
			//echo $lastID;

		}


		//---------------timesheet INSERTION---------------------
		foreach ($_POST['presence_days'] as $empID => $value) {
				$sickLeave = $_POST['sickLeave_days'][$empID];
				$deduction = $_POST['deduction_days'][$empID];
				$absence = $_POST['absence_days'][$empID];
				$annual = $_POST['annual_days'][$empID];
				$casual = $_POST['casual_days'][$empID];
				$manufacturing = $_POST['manufacturing_days'][$empID];
				$overnight = $_POST['overnight_days'][$empID];
				$shift = $_POST['shift_days'][$empID];
				$notes = $_POST['notes'][$empID];

				$sql = "insert into empTimesheet(TS_id,emp_id,presence_days,sickLeave_days,deduction_days,absence_days,annual_days,
								casual_days,manufacturing_days,overnight_days,shift_days,notes) 
						values ('$lastID','$empID','$value','$sickLeave','$deduction','$absence','$annual',
								'$casual','$manufacturing','$overnight','$shift','$notes')";
				echo $sql;
				$stmt = $con->prepare($sql);
				$stmt->execute();
				//check if ts_id already exists in salary:
				$sql_check = "select TS_id from salary where TS_id ='$lastID'";
				$stmt = $con->prepare($sql_check);
				$stmt->execute();
				$result = $stmt->fetchColumn();
				if(! $result){
	
					$sql = "insert into salary(TS_id,emp_id) 
					values ('$lastID','$empID')";
					$stmt = $con->prepare($sql);
					$stmt->execute();
				}

		}
		//echo "done insertion";
	}
	//---------------edit timesheet for one employee-----------
	function editTimesheet(){
		// echo "<pre>";
		// print_r($_POST);
		// echo "</pre>";
		
		$empID =$_POST['emp_id'];
		$sheetID = $_POST['sheetID'];
		// $presenceDaysEdit = $_POST['presenceDaysEdit'];
		// $deductionDaysEdit = $_POST['deductionDaysEdit'];
		// $absenceDaysEdit=$_POST['absenceDaysEdit'];
		// $sickLeaveDaysEdit =$_POST['sickLeaveDaysEdit'];
		// $manufacturingDaysEdit = $_POST['manufacturingDaysEdit'];
		// $overnightDaysEdit = $_POST['overnightDaysEdit'];
		// $shiftDaysEdit = $_POST['shiftDaysEdit'];
		// $annualDaysEdit = $_POST['annualDaysEdit'];
		// $casualDaysEdit = $_POST['casualDaysEdit'];
		// $notesEdit = $_POST['notesEdit'];
		
		
		$sql = "UPDATE empTimesheet
				SET 
					presence_days = " . $_POST['presenceDaysEdit'] .",
					sickLeave_days = " . $_POST['sickLeaveDaysEdit'] .",
					deduction_days = " . $_POST['deductionDaysEdit'] .",
					absence_days = " . $_POST['absenceDaysEdit'] .",
					annual_days =  " . $_POST['annualDaysEdit'] .",
					casual_days =  " . $_POST['casualDaysEdit'] .",
					manufacturing_days = " . $_POST['manufacturingDaysEdit'] .",
					overnight_days = " . $_POST['overnightDaysEdit'] .",
					shift_days = " . $_POST['shiftDaysEdit'] .",
					notes = '" . $_POST['notesEdit'] . "'
				WHERE TS_id =" . $_POST['sheetID']."
						 and emp_id =" .$_POST['emp_id'] ."";
				//ECHO $sql;
				
		$con = connect();
		$stmt = $con->prepare($sql);
	
		$stmt->execute();
		//echo json_encode(array("response"=>"done")) ;
       

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
			$adddesc_job = isset($_POST['adddesc_job'])? filter_var($_POST['adddesc_job'],FILTER_SANITIZE_STRING) : '';
			$addhireDate = $_POST['addhireDate'];
			$addDOB = $_POST['addDOB'];
			$addWorkAllowanceNature = isset($_POST['addWorkAllowanceNature'])? filter_var($_POST['addWorkAllowanceNature'],FILTER_SANITIZE_NUMBER_FLOAT) : '';
			$addrepresentation = isset($_POST['addrepresentation'])? filter_var($_POST['addrepresentation'],FILTER_SANITIZE_NUMBER_FLOAT) : '';
			// creating array of errors
			$formErrors = array();

			if (empty($addempName) || empty($addempCode) ){
				//$formErrors[] = 'username must be larger than  chars';
				echo "name and code cant be empty";
				// print_r($formErrors) ;
			} else {
				$con = connect();
				$employee_sql= "INSERT INTO employee(currentCode,empName,currentContract,currentJob,currentLevel,currentShift,currentMS,gender,
									currentSalary,syndicate_id,hireDate,education,DOB) 
								VALUES ('".$addempCode."','".$addempName."','".$addcontractType."','".$addjob."','".$addlevel."','".$addshift."',
								'".$addmaritalstatus."','".$addgender."','".$addbasicsalary."','".$addsyndicate."','".$addhireDate."'
								,'".$addeducation."','".$addDOB."')" ;
				$stmt = $con->prepare($employee_sql);
				$stmt->execute();
				$empID_sql = "select ID FROM employee where currentCode =$addempCode "	;	
				$stmt = $con->prepare($empID_sql);
				$stmt->execute();
				$empID = $stmt->fetchColumn();

				$level_sql= "INSERT INTO emp_level(emp_id,level_id,level_date) VALUES ('".$empID."','".$addlevel."','".$addhireDate."')" ;
				$stmt = $con->prepare($level_sql);
				$stmt->execute();
				$contract_sql = "INSERT INTO emp_contract(emp_id,contract_id,contract_date,empCode) VALUES ('".$empID."','".$addcontractType."',
				'".$addhireDate."','".$addempCode."')" ;
				$stmt = $con->prepare($contract_sql);
				$stmt->execute();
				$job_sql= "INSERT INTO emp_job(emp_id,job_id,job_date,job_description,shift)
							VALUES ('".$empID."','".$addjob."','".$addhireDate."','".$adddesc_job."','" .$addshift ."')" ;

				$stmt = $con->prepare($job_sql);
				$stmt->execute();
				$marital_status_sql= "INSERT INTO emp_maritalstatus(emp_id,marital_status_id,marital_status_date) 
							VALUES ('".$empID."','".$addmaritalstatus."','".$addhireDate."')" ;
				$stmt = $con->prepare($marital_status_sql);
				$stmt->execute();
				$salary_sql= "INSERT INTO emp_basicsalary(emp_id,basicSalary,salaryDate) 
							VALUES ('".$empID."','".$addbasicsalary."','".$addhireDate."')" ;
				$stmt = $con->prepare($salary_sql);
				$stmt->execute();


				
				echo "done";
			}
	}
	// --------------Edit Employee function-----------------------
	function editEmp(){
		$con = connect();
		$employee_ID = isset($_POST['employee_idEdit'])? filter_var($_POST['employee_idEdit'],FILTER_SANITIZE_NUMBER_INT):'';
		$contractDate = isset($_POST['contractDate'])? $_POST['contractDate']:'';
		$levelDate = isset($_POST['levelDate'])? $_POST['levelDate']:'';
		$jobDate = isset($_POST['jobDate'])? $_POST['jobDate']:'';
		$basicSalaryDate = isset($_POST['basicSalaryDate'])? $_POST['basicSalaryDate']:'';
		$MSDate = isset($_POST['MSDate'])? $_POST['MSDate']:'';
		
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
		$basicsalaryEdit = $_POST['basicsalaryEdit'];
		$syndicateEdit = isset($_POST['syndicateEdit'])? filter_var($_POST['syndicateEdit'],FILTER_SANITIZE_NUMBER_INT):'';
		$genderEdit = isset($_POST['genderEdit'])? filter_var($_POST['genderEdit'],FILTER_SANITIZE_STRING) : '';
		
		// echo "job:";
		// echo $jobEdit;
		// echo "level:";

		// echo $levelEdit;
		// echo "ms:";

		// echo $maritalstatusEdit;
		// echo "contract:";

		// echo $contractTypeEdit;

		// echo "<br>";
		echo "<pre>";
		print_r($_POST);
		echo "</pre>";
		
		//sql statements to be executed
		if($jobEdit != $_POST['jobcurrentValue']){
			$job_sql = "insert into emp_job(emp_id,job_id,job_date,job_description,shift)
						values($employee_ID,$jobEdit,'$jobDate','$desc_jobEdit','$shiftEdit')";
			$emp_sql = "UPDATE employee SET currentJob = $jobEdit	WHERE ID= $employee_ID";		
			
			$stmt = $con->prepare($job_sql);
			$stmt2 = $con->prepare($emp_sql);
			$stmt->execute();
			$stmt2->execute();	
			echo "in job";
		}
		elseif($maritalstatusEdit != $_POST['MScurrentValue'] ){
			$MS_sql = "insert into emp_maritalstatus(emp_id,marital_status_id,marital_status_date)values($employee_ID,$maritalstatusEdit,'$MSDate')";
			$emp_sql = "UPDATE employee SET currentMS = $maritalstatusEdit WHERE ID= $employee_ID";		
			$stmt = $con->prepare($MS_sql);
			$stmt2 = $con->prepare($emp_sql);
			$stmt->execute();
			$stmt2->execute();
			echo "in ms";
			
		}
		elseif($levelEdit != $_POST['levelcurrentValue']){
		    $level_sql = "insert into emp_level(emp_id,level_id)values($employee_ID,$levelEdit)";
			$emp_sql = "UPDATE employee SET currentLevel = $levelEdit WHERE ID= $employee_ID";		
			$stmt = $con->prepare($level_sql);
			$stmt2 = $con->prepare($emp_sql);
			$stmt->execute();
			$stmt2->execute();
			echo "in level";
			
		}
		elseif($contractTypeEdit != $_POST['contractTypecurrentValue'] ){
		    $contract_sql = "insert into emp_contract(emp_id,contract_id,empCode,contract_date)values($employee_ID,$contractTypeEdit,$empCodeEdit)";
			$emp_sql = "UPDATE employee SET currentContract = $contractType WHERE ID= $employee_ID";		
			$stmt = $con->prepare($contract_sql);
			$stmt2 = $con->prepare($emp_sql);
			$stmt->execute();
			$stmt2->execute();
			echo "in contract";
			
		}
		elseif($basicsalaryEdit != $_POST['basicSalarycurrentValue']){
		    $basicSalary_sql = "insert into emp_basicsalary(emp_id,basicSalary,salaryDate)values($employee_ID,$basicsalaryEdit,'$basicSalaryDate')";
			$emp_sql = "UPDATE employee SET currentSalary = $basicsalaryEdit WHERE ID= $employee_ID";
			echo $basicSalary_sql;
			echo 	$emp_sql	;
			$stmt = $con->prepare($basicSalary_sql);
			$stmt2 = $con->prepare($emp_sql);
			$stmt->execute();
			$stmt2->execute();
			echo "in salary";
			
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
	function editLevel(){

	}
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
	//---------------show benefits-----------------------
	function showbenefits(){
		$sql = "";
		$output ="";
		$con = connect();
		//check if there are any values in salary for that date:
		$sql = "select ID
				from timesheets
				where sheetDate = '".$_POST['dateFrom']."'";
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$timesheetID = $stmt->fetchColumn();
		if($timesheetID){
			//there is timesheet with this date
			//check salary table

			$sql= "select e.currentCode,e.empName,empt.emp_id ,empt.TS_id,s.attendancePay,s.natureOfworkAllowance,s.laborDayGrant,
						s.socialAid,s.representation,s.occupationalAllowance,s.experience,s.specialBonus,s.overnightShift,
						s.tiffinAllowance,s.incentive,s.additionalIncentive,s.shift,s.specializationAllowance,s.manufacturingAllowance,s.otherDues
					from employee e inner join empTimesheet empt
						on e.ID = empt.emp_id inner join salary s 
						on empt.emp_id = s.emp_id and empt.TS_id = s.TS_id
					where empt.TS_id =  $timesheetID";
			if(!empty($_POST['search'])){
				$sql .= " and (e.currentCode like '%". $_POST['search'] ."%' OR e.empName like '%". $_POST['search'] ."%')";	
			}
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
			if($result){
				foreach($result as $row){
					$empindex = $row['emp_id'];
					$tsindex = $row['TS_id'];
					
					$output .= "<tr>
					<td>".  $row['currentCode']. "</td>
					<td>".  $row['empName']. "</td>
					<input name='emp_id' type='hidden' value=".$row['emp_id'].">
					<input name='tsID' type='hidden' value=".$row['TS_id'].">
					<td>".  $row['attendancePay']. "</td>
					<td>".  $row['natureOfworkAllowance']. "</td>
					<td>".  $row['specializationAllowance']. "</td>
					<td>".  $row['manufacturingAllowance']. "</td>
					<td>".  $row['socialAid']. "</td>
					<td>".  $row['representation']. "</td>
					<td>".  $row['occupationalAllowance']. "</td>
					
					<td>".  $row['experience']. "</td>
					<td>".  $row['specialBonus']. "</td>
					<td>".  $row['overnightShift']. "</td>
					<td>".  $row['laborDayGrant']. "</td>
					<td>".  $row['tiffinAllowance']. "</td>
					<td>".  $row['incentive']. "</td>
					
					<td>".  $row['shift']. "</td>
					<td>".  $row['otherDues']. "</td>
					<td>".  $row['additionalIncentive']. "</td>

					</tr>";
					

				}
			}
		}else{
			$output = "
			<tr>
			<td colspan='13' class='alert alert-warning'> 
			<strong>لا يوجد حصر أيام الحضور بهذا التاريخ.. </strong>
			</td></tr>";
		}

		
		echo $output;

	}
	//---------------get other deductions--------------------
	function getDeductions(){
		$sql = "";
		$output ="";
		$con = connect();
		//check if there are any values in salary for that date:
		$sql = "select ID
				from timesheets
				where month(sheetDate) = month('".$_POST['dateFrom']."')";
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$timesheetID = $stmt->fetchColumn();
		if(! $timesheetID){
			// if no timesheet date insert new one
			$insertSql = "insert into timesheets(sheetDate)values('".$_POST['dateFrom']."') ";
			$stmt = $con->prepare($insertSql);
			$stmt->execute();
			$getlastTSID_sql = "select max(ID) from timesheets";
			
			$stmt = $con->prepare($getlastTSID_sql);
			$stmt->execute();
		    $timesheetID = $stmt->fetchColumn();
			// $insertTimesheetinSalary = "insert into salary(TS_id)values('$timesheetID')";
			//---------------timesheet ID INSERTION in salary table---------------------
			$sql="select ID from employee";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
			
			foreach ($result as $row) {

				$sql = "insert into salary(TS_id,emp_id) 
						values ($timesheetID,". $row['ID'].")";
				//echo $sql;
				$stmt = $con->prepare($sql);
				$stmt->execute();

				//}
				//  print "}\n";
			}

		}
		//if($timesheetID){
			//there is timesheet with this date
			//check salary table

			$sql= "select e.currentCode,e.empName,t.ID,s.otherDeduction,s.mobil,s.TS_id,s.emp_id,
					s.perimiumCard,s.pastPeriod,s.etisalatNet,s.socialInsurances
					from employee e  inner join salary s 
						on e.ID = s.emp_id inner join timesheets t 
						on s.TS_id = t.ID 
					where s.TS_id =  $timesheetID";
			if(!empty($_POST['search'])){ 
				$sql .= " and (e.currentCode like '%". $_POST['search'] ."%' OR e.empName like '%". $_POST['search'] ."%')";	
			}
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
			if($result){
				// 	<td>
				// 	<input type='number' class='form-control' name='socialInsurancesText[$tsindex][$empindex]' value=".$row['socialInsurances'].">
				// </td> 
				foreach($result as $row){
					$empindex = $row['emp_id'];
					$tsindex = $row['TS_id'];
					
					$output .= "<tr>
					<td>".  $row['currentCode']. "</td>
					<td>".  $row['empName']. "</td>
					<input name='emp_id' type='hidden' value=".$row['emp_id'].">
					<input name='tsID' type='hidden' value=".$row['TS_id'].">
					<td>
						<input type='number' class='form-control mb-2' name='otherDeductionText[$tsindex][$empindex]' value=".$row['otherDeduction'].">
					</td> 

					<td>
						<input type='number' class='form-control mb-2' name='mobilText[$tsindex][$empindex]' value=".$row['mobil'].">
					</td>
					<td>
						<input type='number' class='form-control mb-2' name='etisalatNetText[$tsindex][$empindex]'  value=".$row['etisalatNet'].">
					</td>
					<td>
						<input type='number' class='form-control mb-2' name='perimiumCardText[$tsindex][$empindex]'  value=".$row['perimiumCard'].">
					</td>
					<td>
						<input type='number' class='form-control mb-2' name='pastPeriodText[$tsindex][$empindex]'  value=".$row['pastPeriod'].">
					</td>
					</tr>";
				}
			}
		//}
		else{
			
			$sql= "select e.ID,e.currentCode,e.empName from employee e";
			if(!empty($_POST['search'])){ 
				$sql .= " where (e.currentCode like '%". $_POST['search'] ."%' OR e.empName like '%". $_POST['search'] ."%')";	
			}
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
			// $output = "
			// <tr>
			// <td colspan='13' class='alert alert-warning'> 
			// <strong>لا يوجد حصر أيام الحضور بهذا التاريخ.. </strong>
			// </td></tr>";
			foreach($result as $row){
				$empindex = $row['ID'];
				$output .= "<tr>
				<td>".  $row['currentCode']. "</td>
				<td>".  $row['empName']. "</td>
				<input name='emp_id' type='hidden' value=".$row['ID'].">
				<input name='tsID' type='hidden' value= '$timesheetID'>
				<td>
					<input type='number' class='form-control' name='otherDeductionText[$timesheetID][$empindex]' >
				</td> 

				<td>
					<input type='number' class='form-control' name='mobilText[$timesheetID][$empindex]' >
				</td>
				<td>
					<input type='number' class='form-control' name='etisalatNetText[$timesheetID][$empindex]' >
				</td>
				<td>
					<input type='number' class='form-control' name='perimiumCardText[$timesheetID][$empindex]'>
				</td>
				<td>
					<input type='number' class='form-control' name='pastPeriodText[$timesheetID][$empindex]' >
				</td>
				</tr>";
			}
		}

		
		echo $output;
	}
	//---------------get deductions from credit--------------------------
	function getCreditDeductions(){
		$output ="";
		$con = connect();
		//check if there are any values in salary for that date:
		$sql = "select cd.*,e.currentCode,e.empName,dt.deductionType
				from employee e inner join creditDeductions cd on e.ID = cd.emp_id
								inner join deductionTypes dt 
								on cd.deductionType_id = dt.deductionTypeID ";
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		// $timesheetID = $stmt->fetchColumn();
		foreach ($result as $row) {
			$output .= "<tr>
			<td>".  $row['currentCode']. "</td>
			<td>".  $row['empName']. "</td>
			<input name='emp_id' type='hidden' value=".$row['emp_id'].">
			<input name='dedID' type='hidden' value=".$row['deductionType_id'].">
			<td>".$row['deductionDate']."</td> 
			<td>".$row['deductionType']."</td> 

			<td>".$row['totalAmount']."</td> 
			<td>".$row['monthlyValue']."</td> 
			<td>".$row['remainingValue']."</td> 
			<td> <button  class='btn  btn-sm managements editManagementData ' data-toggle='modal'
			 data-target='#editManagementModal' id=''>edit</button></td>
			
			</tr>";
		}

		echo $output;
	}
	//---------------get CURRENT deductions from credit in modal--------------------------
	function getCurrentCreditDeductionsForEmp(){
		$output ="";
		$con = connect();
	
		$sql = "select cd.deductionType_id,cd.emp_id,cd.totalAmount,e.currentCode,e.empName,dt.deductionType,
					min(cd.deductionDate) as startDate,max(cd.deductionDate) as endDate
				from employee e inner join creditDeductions cd on e.ID = cd.emp_id
								inner join deductionTypes dt 
								on cd.deductionType_id = dt.deductionTypeID 
				where  cd.emp_id = " . $_POST['editDed_EmpID'] . "
				group by  cd.deductionType_id,cd.emp_id,cd.totalAmount,e.currentCode,e.empName,dt.deductionType
				having month(GETDATE()) < month(max(cd.deductionDate))";
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		if($result){
			foreach ($result as $row) {
				$output .= "<tr>
				<input name='emp_id' type='hidden' value=".$row['emp_id'].">
				<input name='dedID' type='hidden' value=".$row['deductionType_id'].">
				<td>".$row['deductionType']."</td> 
				<td>".$row['startDate']."</td> 
				<td>".$row['totalAmount']."</td> 
				<td>".$row['endDate']."</td> 
				<td> <button  class='btn  btn-sm' data-toggle='modal'
					data-target='#editManagementModal' id=''>pay</button></td>
				
				</tr>";
			}
	
			echo json_encode( array("tableOutput" => $output,
									"empCode" => $row['currentCode'],
									"empName" => $row['empName']));

		}else{
			$sql = "select TOP 1 currentCode,empName
					from employee
					where  ID = " . $_POST['editDed_EmpID'] . "";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetch();
			$output = "<td colspan='5'>لا يوجـــد استقطاعات جارية </td> ";
			echo json_encode( array("tableOutput" => $output,
									"empCode" => $result['currentCode'],
									"empName" => $result['empName']));
		}
		
	}
	//---------------get ENDED deductions from credit in modal--------------------------
	function getEndedCreditDeductionsForEmp(){
		$output ="";
		$con = connect();

		$sql = "select cd.deductionType_id,cd.emp_id,cd.totalAmount,e.currentCode,e.empName,dt.deductionType,
					min(cd.deductionDate) as startDate,max(cd.deductionDate) as endDate
				from employee e inner join creditDeductions cd on e.ID = cd.emp_id
								inner join deductionTypes dt 
								on cd.deductionType_id = dt.deductionTypeID 
							where  cd.emp_id = " . $_POST['endedDed_EmpID'] . "
							
				group by  cd.deductionType_id,cd.emp_id,cd.totalAmount,e.currentCode,e.empName,dt.deductionType
				having month(GETDATE()) > month(max(cd.deductionDate))";
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		if($result){
			foreach ($result as $row) {
				$output .= "<tr>
				<input name='emp_id' type='hidden' value=".$row['emp_id'].">
				<input name='dedID' type='hidden' value=".$row['deductionType_id'].">
				<td>".$row['deductionType']."</td> 
				<td>".$row['startDate']."</td> 
				<td>".$row['totalAmount']."</td> 
				<td>".$row['endDate']."</td> 
				</tr>";
			}
	
			echo json_encode( array("tableOutput" => $output,
									"empCode" => $row['currentCode'],
									"empName" => $row['empName']));
		}else{
			$sql = "select TOP 1 currentCode,empName
					from employee 
					where  ID = " . $_POST['endedDed_EmpID'] . "";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetch();
			$output = "<td colspan='4'>لا يوجـــد استقطاعات منتهية </td> ";
			echo json_encode( array("tableOutput" => $output,
									"empCode" => $result['currentCode'],
									"empName" => $result['empName']));
		}
		
	}
	//---------------get deduction items in a form---------
	function deductionItems(){
		$sql = "";
		$output ="<div class='row'>";
		$con = connect();
		//check if there are any values in salary for that date:
		$sql = "select dt.*
				from deductionTypes dt  ";
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		// $timesheetID = $stmt->fetchColumn();
		foreach ($result as $row) {                
			$output .=
				"<div class='col-sm-6'>
					<fieldset>
						<legend >".$row['deductionType']."</legend>
						
						<label  for='dedDate'>تاريخ التسجيل:</label>
						<input class='form-control'  type ='date' id='dedDate[".$row['deductionTypeID']."]' 
						name='dedDate[".$row['deductionTypeID']."]' >
					
					
						<label  for='dedAmount'>المبلغ:</label>
						<input class='form-control formControlWidth'  id='dedAmount[".$row['deductionTypeID']."]' 
						name='dedAmount[".$row['deductionTypeID']."]' placeholder='ادخل القيمة الكلية..'>
							
						";
						if($row['deductionTypeID'] != 5){//medicines
							$output .="
								<br><label  for='dedmonthsNo'>عدد الشهور:</label>
								<input class='form-control formControlWidth'  id='dedmonthsNo[".$row['deductionTypeID']."]' 
								name='dedmonthsNo[".$row['deductionTypeID']."]' placeholder='ادخل عدد الشهور ..'>";
						}
			$output .=	
						"<input type='hidden'  id=".$row['deductionTypeID']." name=".$row['deductionTypeID']." >
					</fieldset><br>
				</div>";
		}
		$output .= "</div>";
		echo $output;
	}
	//---------------insert deductions from credit-------------------
	function insertDedFromCredit(){
		$con = connect();
		$empID = $_POST['getEmpForDed'];
		$add_installment = "insert into creditDeductions(emp_id,deductionType_id,
							deductionDate,totalAmount,monthlyValue,remainingValue) values ";
		//divide deductions according to rules:
		//ranges of deductions for medicines:
		$r1 = range(0, 500);
		$r2 = range(501, 1000);
		$r3 = range(1001, 2000);
		$r4 = range(2001, 4000);
		$r5 = range(4001, 5000);
		//---------------deduction from credit insertion ---------------------
		foreach ($_POST['dedDate'] as $DedTypeID => $datevalue) {
			if($_POST['dedAmount'][$DedTypeID] != 0){
				if($DedTypeID == 5){ //ادوية
					//get max date of current deduction:
					$getmaxDate="select max(deductionDate) as endDate
								from  creditDeductions 			
								where  emp_id = $empID and deductionType_id = $DedTypeID
								having month($datevalue) <= month(max(deductionDate))";
					$stmt = $con->prepare($getmaxDate);
					$stmt->execute();
					$result = $stmt->fetch();
					$maxDate = $result['deductionDate'];
					//check if there any current meds deductions:
					$checkSql = "	select totalAmount,deductionDate,remainingValue
									from  creditDeductions 			
									where  emp_id = $empID and deductionType_id =$DedTypeID
									and month( $datevalue) = month(deductionDate)";
					$stmt = $con->prepare($checkSql);
					$stmt->execute();
					$result = $stmt->fetch();
					
					if($result){
						$remainingAmount = $result['remainingValue'] + $_POST['dedAmount'][$DedTypeID]; //new remaining amount 
						$updateSql = "update creditDeductions
										set	totalAmount = ".$result['totalAmount']." + ".$_POST['dedAmount'][$DedTypeID] .",
											monthlyValue = $monthAmount,
											remainingValue = $remainingAmount
										where emp_id = $empID and deductionType_id =$DedTypeID 
										and  month( $datevalue) = month(deductionDate) ";
						
						while($datevalue < $maxDate){

						}
						
						
					}else{
						$remainingAmount =  $_POST['dedAmount'][$DedTypeID];
					}

					// $effectiveDate = $datevalue;
					while( $remainingAmount > 0){
					
						switch ($remainingAmount) {
							case in_array($remainingAmount, $r1) :
								$monthAmount = 50;
								break;
							case in_array($remainingAmount, $r2):
								$monthAmount = 100;
								break;
							case in_array($remainingAmount, $r3):
								$monthAmount = 150;
								break;
							case in_array($remainingAmount, $r4):
								$monthAmount = 200;
								break;
							case in_array($remainingAmount, $r5):
								$monthAmount = 400;
								break;
							case ($remainingAmount > 5000) :
								$monthAmount = 500;
								break;
	
						}

						$remainingAmount =$remainingAmount - $monthAmount ;
						
						$add_installment .=	"($empID,$DedTypeID,'$datevalue',".$_POST['dedAmount'][$DedTypeID].",
													$monthAmount,$remainingAmount),";
						$datevalue = date('Y-m-d', strtotime("+1 months", strtotime($datevalue)));

					}
					
				}else{ //باقى الاستقطاعات حسب عدد الشهور
					//----get quotient of division------------
					$quotientAmount =  intval($_POST['dedAmount'][$DedTypeID] / $_POST['dedmonthsNo'][$DedTypeID]);
					$remainderAmount = fmod($_POST['dedAmount'][$DedTypeID] ,$_POST['dedmonthsNo'][$DedTypeID]);
					echo "quotient". $quotientAmount ;
					echo "<br>";
					echo "remainderAmount". $remainderAmount;
					echo "<br>";
					//------------first month will deduct quotient value plus remainder---------------
					
					$firstMonthAmount = $quotientAmount + $remainderAmount ; //اول قسط
					$remainingAmount = $_POST['dedAmount'][$DedTypeID]  - $firstMonthAmount;
					echo "firstMonthAmount". $firstMonthAmount;
					echo "<br>";
					echo "remainingAmount". $remainingAmount;
					
					//------------add first month in sql statement---------------------
					$add_installment .="($empID,$DedTypeID,'$datevalue',".$_POST['dedAmount'][$DedTypeID].",
										$firstMonthAmount,$remainingAmount),";
					$datevalue = date('Y-m-d', strtotime("+1 months", strtotime($datevalue)));
					
					while( $remainingAmount > 0){
						$remainingAmount = $remainingAmount - $quotientAmount ;
						$add_installment .="($empID,$DedTypeID,'$datevalue',".$_POST['dedAmount'][$DedTypeID].",
						$quotientAmount,$remainingAmount),";
						$datevalue = date('Y-m-d', strtotime("+1 months", strtotime($datevalue)));
						echo "<br>";
						
						echo "quotient". $quotientAmount ;
						echo "<br>";
						echo "remainingAmount". $remainingAmount;
						
						
						}
						echo"<br>";
						

					}
				}

			}
			
			$trimmed_add_installment =  rtrim($add_installment,",");	
			echo $trimmed_add_installment;
			$stmt = $con->prepare($trimmed_add_installment);
			$stmt->execute();
	}	
	//---------------get other benefits--------------------
	function getBenefits(){
		$sql = "";
		$output ="";
		$con = connect();
		//check if there are any values in salary for that date:
		$sql = "select ID
				from timesheets
				where month(sheetDate) = month('".$_POST['dateFrom']."')";
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$timesheetID = $stmt->fetchColumn();
		if(!$timesheetID){

		
			// if no timesheet date insert new one
			$insertSql = "insert into timesheets(sheetDate)values('".$_POST['dateFrom']."') ";
			$stmt = $con->prepare($insertSql);
			$stmt->execute();
			$getlastTSID_sql = "select max(ID) from timesheets";
			
			$stmt = $con->prepare($getlastTSID_sql);
			$stmt->execute();
			$timesheetID = $stmt->fetchColumn();
		
			//---------------timesheet ID INSERTION in salary table---------------------
			$sql="select ID from employee";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
			
			foreach ($result as $row) {

				$sql = "insert into salary(TS_id,emp_id) 
						values ($timesheetID,". $row['ID'].")";
			//	echo $sql;
				$stmt = $con->prepare($sql);
				$stmt->execute();

				//}
				//  print "}\n";
			}
		}
		//if($timesheetID){
			//there is timesheet with this date
			//check salary table

			$sql= "select e.currentCode,e.empName,s.emp_id ,s.TS_id,s.specialBonus,s.otherDues
						
					from employee e inner join  salary s 
						on e.ID = s.emp_id 
					where s.TS_id =  $timesheetID";
			if(!empty($_POST['search'])){
				$sql .= " and (e.currentCode like '%". $_POST['search'] ."%' OR e.empName like '%". $_POST['search'] ."%')";	
			}
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
			if($result){
			// 	<td>
			// 	<input type='number' class='form-control' name='socialInsurancesText[$tsindex][$empindex]' value=".$row['socialInsurances'].">
			// </td> 
				foreach($result as $row){
					$empindex = $row['emp_id'];
					$tsindex = $row['TS_id'];
					
					$output .= "<tr>
					<td>".  $row['currentCode']. "</td>
					<td>".  $row['empName']. "</td>
					<input name='emp_id' type='hidden' value=".$row['emp_id'].">
					<input name='tsID' type='hidden' value=".$row['TS_id'].">
					<td>
						<input type='number' class='form-control' name='specialBonusText[$tsindex][$empindex]' value=".$row['specialBonus'].">
					</td> 

					<td>
						<input type='number' class='form-control' name='otherDuesText[$tsindex][$empindex]' value=".$row['otherDues'].">
					</td>
					</tr>";
				}
			}
		 //}//else{
		// 	$output = "
		// 	<tr>
		// 	<td colspan='13' class='alert alert-warning'> 
		// 	<strong>لا يوجد حصر أيام الحضور بهذا التاريخ.. </strong>
		// 	</td></tr>";
		// }

		
		echo $output;
	}
	//---------------get sanctions for insertion---------------------------
	function getSanctions(){
		$output ="";
		if(isset($_POST['dateFrom'])){
			$date = $_POST['dateFrom'];
		}	
		$con = connect();

		//-------------------------------------------------------------
		$sql = "select ID
				from timesheets
				where month(sheetDate) = month('".$_POST['dateFrom']."')";
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$timesheetID = $stmt->fetchColumn();
		if(!$timesheetID){

		
			// if no timesheet date insert new one
			$insertSql = "insert into timesheets(sheetDate)values('".$_POST['dateFrom']."') ";
			$stmt = $con->prepare($insertSql);
			$stmt->execute();
			$getlastTSID_sql = "select max(ID) from timesheets";
			
			$stmt = $con->prepare($getlastTSID_sql);
			$stmt->execute();
			$timesheetID = $stmt->fetchColumn();
			// $insertTimesheetinSalary = "insert into salary(TS_id)values('$timesheetID')";
			//---------------timesheet ID INSERTION in salary table---------------------
			$sql="select ID from employee";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
			
			foreach ($result as $row) {

				$sql = "insert into salary(TS_id,emp_id) 
						values ($timesheetID,". $row['ID'].")";
			//	echo $sql;
				$stmt = $con->prepare($sql);
				$stmt->execute();

				//}
				//  print "}\n";
			}
		}
		//there is timesheet with this date
		//check salary table
		$sql = "select  e.empName,e.currentCode,e.ID,e.currentSalary
						from	employee e";
		if(!empty($_POST['search'])){

			$sql .= " where (e.currentCode between '".$_POST['search']."' and '".$_POST['searchTo'] ."')
						or e.currentCode like '%". $_POST['search'] ."%'";	

		}
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		foreach($result as $row){
			$empindex = $row['ID'];
			//".$row['TS_ID']."][".$row['ID']."
			$tsindex = $timesheetID;
			$output .= "<tr>
			<td>".  $row['currentCode']. "</td>
			<td>".  $row['empName']. "</td>
			<td class='currentSalary'>".  $row['currentSalary']. "</td>
			
			<input name='emp_id' type='hidden' value=".$row['ID'].">
			<input name='tsID' type='hidden' value=".$timesheetID.">";
			$sql2= "select s.sanctionDays,s.sanctionAmount,s.sanctionNotes,s.employee_id,s.TS_id
				
					from  sanctions s
					where s.TS_id =  $timesheetID and s.employee_id = $empindex";
			$stmt = $con->prepare($sql2);
			$stmt->execute();
			$result2 = $stmt->fetchAll();
			if($result2){
				foreach($result2 as $row2){
					$output .= "<td>
					<input  class='form-control sanctionDays' name='sanctionsDaysText[$tsindex][$empindex]' value=".$row2['sanctionDays'].">
					</td> 

					<td>
						<input  class='form-control sanctionAmount' name='sanctionsAmountText[$tsindex][$empindex]' value=".$row2['sanctionAmount'].">
					</td>
					<td>
						<input type='text' class='form-control sanctionNotes' name='sanctionsNotesText[$tsindex][$empindex]'  value=".$row2['sanctionNotes'].">
					</td>
					
					</tr>";
				}
				
			}else{
				$output .= "<td>
					<input  class='form-control sanctionDays' name='sanctionsDaysText[$tsindex][$empindex]'>
				</td> 

				<td>
					<input  class='form-control sanctionAmount' name='sanctionsAmountText[$tsindex][$empindex]' >
				</td>
				<td>
					<input type='text' class='form-control sanctionNotes' name='sanctionsNotesText[$tsindex][$empindex]' >
				</td>
				
				</tr>";
			}
		}
		echo $output;
		
	}
	//---------------calculate benefits of salary------------------
	function calculateSalary24(){
		$con = connect();			
		$sql = "select e.ID,e.currentSalary,e.currentSpecialization,e.currentWorkAllowanceNature,ms.social_insurance,
				ms.med_insurance,s.amount,l.incentivePercent,j.specialization_amount,j.experience_amount,
				j.representation_amount,empt.TS_id as timesheetID, empt.manufacturing_days,empt.overnight_days,
				empt.shift_days,empt.presence_days
				from   employee e,timesheets ts,maritalStatus ms,syndicates s,level l,job j,empTimesheet empt
				where  e.currentMS = ms.ID
						and e.syndicate_id = s.ID
						and e.currentLevel = l.ID
						and e.currentJob = j.ID
						and ts.sheetDate = '" . $_POST['dateFrom'] ."'
						and e.ID = empt.emp_id
						and ts.ID = empt.TS_id";			   
		$stmt = $con->prepare($sql);
		$stmt->execute();
		//$stmt->execute(array($_POST["searchDateFrom"]));
		$result = $stmt->fetchAll();
		foreach($result as $row){
			$currentDays = ($row['presence_days'])/30; // عدد أيام الحضور/30
			$attendancePay = $row['currentSalary'] * $currentDays;//اجر الحضور
			$natureOfworkAllowance =$row['currentWorkAllowanceNature'] * $currentDays; // بدل طبيعة
			$socialAid = $row['social_insurance'] ; //م.اجتماعية
			$representation = $row['representation_amount']; // تمثيل
			$occupationalAllowance = $row['amount']; // بدل مهنى
			$manufacturingAllowance = 8 * (22- $row['manufacturing_days']); // بدل تصنيع
			$experience = ($currentDays) * $row['experience_amount']; // خبرة
			$overnightShift = ($row['overnight_days'] * 2) * ($row['currentSalary']/30) ; // نوباتجية
			$labordayGrant = (10) *  $currentDays ; // منحة عيد العمال
			$tiffinAllowance = (15) *  $row['presence_days'] ; // وجبات نقدية
		    $incentive = $row['currentSalary'] * $row['incentivePercent'] * 0.75 * $currentDays;//الحافز
		    $additionalincentive = $row['currentSalary'] * $row['incentivePercent'] * 0.5;//حافز اضافى
			
			$shift = 75 * $row['shift_days']; // وردية
			$specializationAllowance = $currentDays * ($row['specialization_amount']+ ($row['currentSalary']/4)) ; // بدل تخصص
		    $specialBonus = 0; // علاوات خاصة
			$otherDues = 0; // استحقاق
			$totalbenefits =$attendancePay+$natureOfworkAllowance+$socialAid+$representation+$occupationalAllowance+
			$manufacturingAllowance+$experience+$overnightShift+$labordayGrant+$labordayGrant+$tiffinAllowance+
			$incentive+$shift+$specializationAllowance+$specialBonus+$otherDues+$additionalincentive ; // اجمالى الاستحقاق


			$getdeductions_sql = "select pastPeriod+perimiumCard+familyHealthInsurance+otherDeduction+petroleumSyndicate+
			sanctions+mobil+loan+empServiceFund+socialInsurances+etisalatNet
			from salary where emp_id =".$row['ID']." and TS_id = ".$row['timesheetID']." ";
			$getdeductions_stmt = $con->prepare($getdeductions_sql);
			$getdeductions_stmt->execute();
			$totalDeductionsresult = $getdeductions_stmt->fetchColumn();
			echo $totalDeductionsresult ;
			//------------deductions calculations---------------------
			//$sanction_days = 0;
			//$pastPeriod = 0;//مدة سابقة
			//$perimiumCard = 0 ; 
			$familyHealthInsurance = $row['med_insurance']  ; //علاج اسر
			//$otherDeduction = 0; // استقطاع اخر
			$petroleumSyndicate= 10; // ن.بترول
			//$sanctions = ($row['currentSalary']/30) * $sanction_days; // جزاءات
			//$mobil = 0; // نوباتجية
			$loan = 0; //قرض
			$empServiceFund = 20; // صندوق خدمات عاملين
			$socialInsurances = 0;//تأمينات
			//$etisalatNet =  0; 
			// $totalDeductions = $pastPeriod+$perimiumCard+$familyHealthInsurance+$otherDeduction+$petroleumSyndicate+
			// $sanctions+$mobil+$loan+$empServiceFund+$socialInsurances+$etisalatNet; // اجمالى الاستقطاع

			//$netsalary=$totalbenefits-$totalDeductions;
			//-----------insert into salary table---------------- 
			// $sql2 ="insert into salary(emp_id,TS_id,attendancePay,natureOfworkAllowance,socialAid,representation,occupationalAllowance,
			// 		experience,overnightShift,labordayGrant,tiffinAllowance,incentive,specializationAllowance,
			// 		pastPeriod,perimiumCard,familyHealthInsurance,otherDeduction,petroleumSyndicate,sanctions,
			// 		mobil,loan,empServiceFund,socialInsurances,etisalatNet,totalBenefits,totalDeductions)
			// 		values(".$row['ID'].",".$row['timesheetID'].",".$attendancePay.",".$natureOfworkAllowance.",".$natureOfworkAllowance.",".$representation.",".$occupationalAllowance.",
			// 		".$experience.",".$overnightShift.",".$labordayGrant.",".$tiffinAllowance.",".$incentive.",".$specializationAllowance.",
			// 		".$pastPeriod.",".$perimiumCard.",".$familyHealthInsurance.",".$otherDeduction.",".$petroleumSyndicate.",
			// 		".$sanctions.",".$mobil.",".$loan.",".$empServiceFund.",".$socialInsurances.",".$etisalatNet.",".$totalbenefits.",
			// 		".$totalDeductions.")";
			$sql2 = "UPDATE salary 
					 SET attendancePay = $attendancePay,
					 natureOfworkAllowance = $natureOfworkAllowance,
					 socialAid = $socialAid,
					 representation = $representation,
					 occupationalAllowance = $occupationalAllowance,
					 experience = $experience,
					 overnightShift =$overnightShift,
					 labordayGrant =$labordayGrant,
					 tiffinAllowance =$tiffinAllowance,
					 incentive =$incentive,
					 additionalIncentive =$additionalincentive, 
					 specializationAllowance =$specializationAllowance,
					 
					 familyHealthInsurance =$familyHealthInsurance,
					
					 petroleumSyndicate =$petroleumSyndicate,
					
					 empServiceFund = $empServiceFund,
					 socialInsurances =$socialInsurances,
					 totalBenefits = $totalbenefits,
					 totalDeductions  =$totalDeductionsresult
					 WHERE TS_id = ".$row['timesheetID']."
					 and emp_id =".$row['ID']." " ;
			$stmt = $con->prepare($sql2);
			$stmt->execute();
			//echo $sql2;
		}
	}
	//-------------update deductions----------------------
	function updateDeductions(){
	
		$otherDeductionText = $_POST['otherDeductionText'];
		$mobilText = isset($_POST['mobilText'])? $_POST['mobilText']:'';
		$etisalatNetText = isset($_POST['etisalatNetText'])? $_POST['etisalatNetText']:'';
		$perimiumCardText = isset($_POST['perimiumCardText'])? $_POST['perimiumCardText']:'';
		$pastPeriodText = isset($_POST['pastPeriodText'])? $_POST['pastPeriodText']:'';
		//print_r($otherDeductionText) ;
		$con = connect();
		//------------OTHER DEDUCTIONS INSERTION---------------------
        if (isset($_POST['otherDeductionText'])) {
			//echo "hi";
            foreach ($otherDeductionText as $timesheetkey => $otherDeductionvalueArray) {
                foreach ($otherDeductionvalueArray as $emp => $deduction) {

					$sql = "UPDATE salary 
						SET otherDeduction ='$deduction' 
						where emp_id= '$emp'
						and TS_id ='$timesheetkey' ";
					//echo $sql;
					$stmt = $con->prepare($sql);
					$stmt->execute();
                }
            }
		}
		//------------SOCIAL INSURANCES INSERTION----------------
		// if (isset($_POST['socialInsurancesText'])) {
		// 	echo "hi";
        //     foreach ($socialInsurancesText as $timesheetkey => $socialInsurancesvalueArray) {
        //         foreach ($socialInsurancesText as $emp => $socialInsurances) {

		// 			$sql = "UPDATE salary 
		// 				SET socialInsurances ='$socialInsurances' 
		// 				where emp_id= '$emp'
		// 				and TS_id ='$timesheetkey' ";
		// 			echo $sql;
		// 			$stmt = $con->prepare($sql);
		// 			$stmt->execute();
        //         }
        //     }
        // }
		//------------MOBIL INSERTION-----------------------------
		if(isset($_POST['mobilText'])){
			foreach($mobilText as $timesheetkey => $mobilvalueArray) {
				foreach($mobilvalueArray as $emp => $mobil){
					$sql = "UPDATE salary 
							SET mobil ='$mobil' 
							where emp_id= '$emp'
							and TS_id ='$timesheetkey' ";
							
					$stmt = $con->prepare($sql);
					$stmt->execute();
				}
			}
		}

		//------------etisalatNet INSERTION-----------------------
		if(isset($_POST['etisalatNetText'])){
			foreach($etisalatNetText as $timesheetkey => $etisalatNetvalueArray) {
				foreach($etisalatNetvalueArray as $emp => $etisalatNet){
					$sql = "UPDATE salary 
							SET etisalatNet ='$etisalatNet' 
							where emp_id= '$emp'
							and TS_id ='$timesheetkey' ";
					//echo $sql;
					$stmt = $con->prepare($sql);
					$stmt->execute();
				}
			}
		}

		//------------perimiumCard INSERTION----------------------
		if(isset($_POST['perimiumCardText'])){
			foreach($perimiumCardText as $timesheetkey => $perimiumCardvalueArray) {
				foreach($perimiumCardvalueArray as $emp => $perimiumCard){
					$sql = "UPDATE salary 
							SET perimiumCard ='$perimiumCard' 
							where emp_id= '$emp'
							and TS_id ='$timesheetkey' ";
					$stmt = $con->prepare($sql);
					$stmt->execute();
				}
			}
		}
		//------------pasrPeriod INSERTION----------------------
		if(isset($_POST['pastPeriodText'])){
			foreach($pastPeriodText as $timesheetkey => $pastPeriodvalueArray) {
				foreach($pastPeriodvalueArray as $emp => $pastPeriod){
					$sql = "UPDATE salary 
							SET pastPeriod ='$pastPeriod' 
							where emp_id= '$emp'
							and TS_id ='$timesheetkey' ";
					$stmt = $con->prepare($sql);
					$stmt->execute();
				}
			}
		}

		
	}
	//-------------update Benefits----------------------
	function updateBenefits(){

		$specialBonusText = $_POST['specialBonusText'];
		$otherDuesText = isset($_POST['otherDuesText'])? $_POST['otherDuesText']:'';
	
		//print_r($specialBonusText) ;
		$con = connect();
		//------------special bonus INSERTION---------------------
		if (isset($_POST['specialBonusText'])) {
			//echo "hi";
			foreach ($specialBonusText as $timesheetkey => $specialBonusvalueArray) {
				foreach ($specialBonusvalueArray as $emp => $bonus) {

					$sql = "UPDATE salary 
						SET specialBonus ='$bonus' 
						where emp_id= '$emp'
						and TS_id ='$timesheetkey' ";
					//echo $sql;
					$stmt = $con->prepare($sql);
					$stmt->execute();
				}
			}
		}
		//------------other dues INSERTION----------------------
		if(isset($_POST['otherDuesText'])){
			foreach($otherDuesText as $timesheetkey => $otherDuesvalueArray) {
				foreach($otherDuesvalueArray as $emp => $otherDues){
					$sql = "UPDATE salary 
							SET otherDues ='$otherDues' 
							where emp_id= '$emp'
							and TS_id ='$timesheetkey' ";
					$stmt = $con->prepare($sql);
					$stmt->execute();
				}
			}
		}

		
	}

	//-------------UPDATE SANCTIONS----------------------
	function insertSanctions(){
		//$sanctionDate =$_POST['searchDateFrom'];
		$con = connect();
		echo "<pre>";
		print_r($_POST);
		echo "</pre>";
		
		//---------------SANCTIONS INSERTION---------------------
      	if (isset($_POST['sanctionsDaysText'])) {
			 
			foreach ($_POST['sanctionsDaysText'] as $TSID => $values) {
				//print "$TSID {\n";
				foreach ($values as $empKey => $sanctionDays) {
					if($sanctionDays){
						//print "    $empKey => $sanctionDays\n";
						$Amount = $_POST['sanctionsAmountText'][$TSID][$empKey];
						$notes = $_POST['sanctionsNotesText'][$TSID][$empKey];
						//echo $notes;
						//check wether there is sanction already to update
						$checkvalues_sql = "select sanctionAmount from sanctions where TS_id = $TSID and employee_id = $empKey";
						
						$checkvalues_stmt = $con->prepare($checkvalues_sql);
						$checkvalues_stmt->execute();
						$result=$checkvalues_stmt->fetchAll();
						if($result){
							$sql = "UPDATE sanctions 
									SET sanctionDays =$sanctionDays,
									sanctionAmount = $Amount,
									sanctionNotes = '$notes'
									WHERE TS_id = $TSID 
									and employee_id = $empKey ";
									echo $sql;
							$updateSalarywithSanctions = "UPDATE salary 
									SET sanctions = $Amount
									WHERE TS_id = $TSID 
									and emp_id = $empKey ";
						}else{
							$sql = "insert into sanctions values ('$TSID','$empKey','$sanctionDays','$Amount','$notes')";
							echo $sql;
							$updateSalarywithSanctions = "UPDATE salary 
									SET sanctions = $Amount
									WHERE TS_id = $TSID 
									and emp_id = $empKey ";
						}
						$stmt = $con->prepare($sql);
						$stmt->execute();
						$updateSalary_stmt = $con->prepare($updateSalarywithSanctions);
						$updateSalary_stmt->execute();
					
					}
				}
				//print "}\n";
			}
        }else{ echo "nothing set";}
	}

	//---------get totals of benefits and deductions and netsalary-------
	function getWagesTotals(){
		$output="";
		$con = connect();
		if(isset($_POST['dateFrom'])){
			$date = $_POST['dateFrom'];
		}elseif(isset($_POST['searchDateFrom'])){
			$date = $_POST['searchDateFrom'];
		}	
		$sql = "select  e.empName,e.currentCode,s.totalBenefits,s.totalDeductions,s.netSalary,
						s.emp_id,s.TS_id,ts.sheetDate
				from    employee e inner join salary s on e.ID = s.emp_id 
						inner join timesheets ts 	on   s.TS_id =ts.ID
				where ts.sheetDate =  '".$_POST['dateFrom']."'";
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		if(! $result ){
			$output = "
			<tr>
			<td colspan='6' class='alert alert-warning'> 
			<strong>لا يوجد حصر أيام الحضور بهذا التاريخ!</strong>
			</td></tr>";
		}else{
			foreach($result as $row){
				$output .= 
				"<tr>
					<input name='emp_id' type='hidden' value=".$row['emp_id'].">
					<input name='TS_id' type='hidden' value=".$row['TS_id'].">
					<td>".  $row['currentCode']. "</td>
					<td>".  $row['empName']. "</td>
					<td>".  $row['totalBenefits']. "</td>
					<td>".  $row['totalDeductions']. "</td>
					<td>".  $row['netSalary']. "</td>
					<td>
						<button type='button' class='btn btn-primary btn-sm wagesDetailsBtn' data-toggle='modal' 
						data-target='#WagesDetailsModal' id=".$row['TS_id'] . $row['emp_id'].">
						<i class='fa fa-info fa-lg' aria-hidden='true'></i>
						</button>
					</td>
				</tr>";
			}
		}

		echo $output;
	}
	//----------get wage details-----------------------------
	function viewWagesDetails(){
		$con = connect();
		$sql = "select s.*,e.currentCode ,e.empName,empt.presence_days,t.sheetDate
				from employee e,salary s inner join empTimesheet empt 
								on s.emp_id = empt.emp_id and s.TS_id = empt.TS_id
								inner join timesheets t on empt.TS_id = t.ID
				where s.TS_id ='".$_POST['wagesDetailssheetID']."'
					AND s.emp_id ='".$_POST['wagesDetailsEmpID'] ."' ";
		//echo $sql;
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		foreach($result as $row){
			$output = "
				<div class='mailtitle'>
					<div><img src='images/amoc2.png' align='left'
							style='max-width:100% ;'></div>
					<div id='mailcompany'>
						<h3>شركة الاسكندرية للزيوت المعدنية(أموك)</h3>
						<h3>الادارة العامة للشئون المالية</h3>
						<h4>قسيمة صرف مرتب</h4>
					</div>
				</div>
				<table class='mailTable'>
					<tr>
						<th colspan='2'>رقم القيد </th>
						<th colspan='3'>الاســــــم</th>
						<th colspan='2'>التاريخ</th>
						<th colspan='2'>عدد الايام</th>
					</tr>
					<tr>
						<td colspan='2'>".$row['currentCode']."</td>
						<td colspan='3'>".$row['empName']."</td>
						<td colspan='2'>".$row['sheetDate']."</td>
						<td colspan='2'>".$row['presence_days']."</td>
					</tr>
					<tr>
						<th colspan='8'>الاستحقاقات</th>
						<th style='background-color:#3c3c3db7'>الرصيد</th>
					</tr>
					<tr>
						
						<td class='mailsubHeader'>المرتب</td>
						<td class='mailsubHeader'>أجر الحضور</td>
						<td class='mailsubHeader'>بدل طبيعة</td>
						<td class='mailsubHeader'>م.أجتماعيه</td>
						<td class='mailsubHeader'>حافز علمين</td>
						<td class='mailsubHeader'>تمثيل</td>
						<td class='mailsubHeader'>بدل مهنى</td>
						<td class='mailsubHeader'>خبرة</td>
						<td></td>
					</tr>

					<tr>
						<td>".$row['empName']."</td>
						<td>".$row['attendancePay']."</td>
						<td>".$row['natureOfworkAllowance']."</td>
						<td>".$row['socialAid']."</td>
						<td></td>
						<td>".$row['representation']."</td>
						<td>".$row['occupationalAllowance']."</td>
						<td>".$row['experience']."</td>
						<td></td>
					</tr>
					<tr>
						<td class='mailsubHeader'>علاوات خاصه</td>
						<td class='mailsubHeader'>نوباتجية</td>
						<td class='mailsubHeader'>منحة عيد العمال</td>
						<td class='mailsubHeader'>وجبات نقدية</td>
						<td class='mailsubHeader'>الحافز</td>
						<td class='mailsubHeader'>وردية</td>
						<td class='mailsubHeader'>بدل تخصص</td>
						<td class='mailsubHeader'>بدل تصنيع</td>
						<td></td>
					</tr>
					<tr>
						
						<td>".$row['specialBonus']."</td>
						<td>".$row['overnightShift']."</td>
						<td>".$row['laborDayGrant']."</td>
						<td>".$row['tiffinAllowance']."</td>
						<td>".$row['incentive']."</td>
						<td>".$row['shift']."</td>
						<td>".$row['specializationAllowance']."</td>
						<td>".$row['manufacturingAllowance']."</td>
						<td></td>
					</tr>

					<tr>
						
						<td class='mailsubHeader'>استحقاق</td>
						<td class='mailsubHeader'>حافز إضافى</td>
						<td colspan='7'></td>
					</tr>
					<tr>
						
						<td>".$row['otherDues']."</td>
						<td>".$row['additionalIncentive']."</td>
						<td colspan='7'></td>
					</tr>
					<tr class='mailtotal'>
						
						<td colspan='8'>اجمالى الدخل</td>
						<td>".$row['totalBenefits']."</td>
					</tr>
					<tr>
						
						<th colspan='8'> الاستقطاعات</th>
						<td></td>
					</tr>

					<tr>
						
						<td class='mailsubHeader'>مدة سابقة</td>
						<td class='mailsubHeader'>كارت بريميوم</td>
						<td class='mailsubHeader'>علاج الأسر</td>
						<td class='mailsubHeader'>استقطاع أخر</td>
						<td class='mailsubHeader'>ن.بترول</td>
						<td class='mailsubHeader'>جزاءات</td>
						<td class='mailsubHeader'>موبايل</td>
						<td class='mailsubHeader'>قرض بنك NBE</td>
						<td></td>
					</tr>
					<tr>
						<td>".$row['pastPeriod']."</td>
						<td>".$row['perimiumCard']."</td>
						<td>".$row['familyHealthInsurance']."</td>
						<td>".$row['otherDeduction']."</td>
						<td>".$row['petroleumSyndicate']."</td>
						<td>".$row['sanctions']."</td>
						<td>".$row['mobil']."</td>
						<td>".$row['loan']."</td>
						<td></td>
					</tr>
					<tr>
						
						<td class='mailsubHeader'>صندوق خدمات عاملين</td>
						<td class='mailsubHeader'>جنيهات مرحله</td>
						<td class='mailsubHeader'>التأمينات</td>
						<td class='mailsubHeader'>معاش تكميلى</td>
						<td class='mailsubHeader'>الضريبة</td>
						<td class='mailsubHeader'>اتصالات</td>
						<td class='mailsubHeader'>الدمغة</td>
						<td class='mailsubHeader'>بنك القاهرة</td>
						<td></td>
					</tr>
					<tr>
						<td>".$row['empServiceFund']."</td>
						<td></td>
						<td>".$row['socialInsurances']."</td>
						<td></td>
						<td></td>
						<td>".$row['etisalatNet']."</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						
						<th colspan='8'> الاستقطاعات من الرصيد</th>
						<td></td>
					</tr>
					<tr>
						
						<td colspan='2' class='mailsubHeader'>بتروتريد</td>
						<td colspan='2' class='mailsubHeader'>	سلفة مدارس 2019</td>
						<td colspan='2' class='mailsubHeader'>إيهاب سنتر</td>
						<td colspan='2' class='mailsubHeader'>سلف عاملين</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						
						<td colspan='2' class='mailsubHeader'>رحلات</td>
						<td colspan='2' class='mailsubHeader'>أدوية</td>
						<td colspan='2' class='mailsubHeader'>سلفة اجتماعية</td>
						<td colspan='2' class='mailsubHeader'>رحلات نصف العام</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr class='mailtotal'>
						
						<td colspan='8'>اجمالى الاستقطاع</td>
						<td>".$row['totalDeductions']."</td>
					</tr>
					<tr class='mailtotal'>
						
						<td colspan='8'>صافى الدخل</td>
						<td>".$row['netSalary']."</td>
					</tr>
				</table>
				<div class='mailnotice'>
					<h4>تنبيه:</h4>
					<p>شيكات القبض المرسلة على البريد الالكتروني لا تعتبر مستند قانوني و ما هي إلا اشعار و في حالة الحاجة إلى مفردات المرتب يرجى التواصل مع الإدارة العامة للشئون المالية</p>
				</div>
				<hr>
				<div style='text-align: right;'>
					<p>قطاع الأجور - قطاع البرامج ونظم المعلومات</p>
				</div>";

		}

		echo $output;
	}