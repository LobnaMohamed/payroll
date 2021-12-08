<?php
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
			echo "<div class='btn  btn-lg managements well well-sm col-sm-10 col-sm-offset-1' data-toggle='modal' data-target='#addLevelModal'><i class='fa fa-plus-circle'></i></div>";

			foreach($result as $row){
				echo '<button  class="btn  btn-lg col-sm-10 col-sm-offset-1 managements editLevelData well well-sm " data-toggle="modal" data-target="#editLevelModal" id="'.$row['ID'].'">'. $row['empLevel'] .'</button>';
					// echo "<div class='managements well well-sm col-sm-4'><span>". $row['Management'] ."</span></div>";
				}
		}elseif($page == 'empdata.php' || $page == 'job.php'){
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
			echo "<div class='btn btn-lg managements well well-sm col-sm-10 col-sm-offset-1' data-toggle='modal' data-target='#addcontractModal'><i class='fa fa-plus-circle'></i></div>";			foreach($result as $row){
				echo '<button  class="btn btn-lg managements editcontractData well well-sm col-sm-10 col-sm-offset-1" data-toggle="modal" data-target="#editcontractModal" id="'.$row['ID'].'">'. $row['contractType'] .'</button>';
				}
				
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
			echo "<div class='btn  btn-lg managements well well-sm col-sm-10 col-sm-offset-1' data-toggle='modal' data-target='#addMaritalStatusModal'><i class='fa fa-plus-circle'></i></div>";
			foreach($result as $row){
				echo '<button  class="btn  btn-lg managements editmaritalstatusData well well-sm col-sm-10 col-sm-offset-1" data-toggle="modal" data-target="#editMaritalStatusModal" id="'.$row['ID'].'">'. $row['maritalStatus'] .'</button>';
				}
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
			echo "<div class='btn  btn-lg managements well well-sm col-sm-10 col-sm-offset-1' data-toggle='modal' data-target='#addsyndicateModal'><i class='fa fa-plus-circle'></i></div>";
			foreach($result as $row){
				echo '<button  class="btn  btn-lg managements editsyndicateData well well-sm col-sm-10 col-sm-offset-1" data-toggle="modal" data-target="#editsyndicateModal" id="'.$row['ID'].'">'. $row['syndicate'] .'</button>';
				}
				
	
		}elseif($page == 'empdata.php'){
			// echo "<option selected disabled hidden style='display: none' value= '0'></option>";
			// echo "<option selected  value='0'>لا يوجد</option>";
	    	foreach($result as $row){
				if($row['ID'] == 1){
					echo "<option selected  value= " .$row['ID'].">" . $row['syndicate'] . "</option>";

				}else{
					echo "<option value=" .$row['ID'].">" . $row['syndicate'] . "</option>";

				}
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
    /**
	 * function to insert new job
	 * 	
	*/
	function insertNewJob()	{
		if(isset($_POST['insertJob'])){
			//assign variables

			$jobName= isset($_POST['job'])? filter_var($_POST['job'],FILTER_SANITIZE_STRING) : '';
			$representationAdd = isset($_POST['representationAdd'])? filter_var($_POST['representationAdd'],FILTER_SANITIZE_NUMBER_FLOAT) :0;
			$experienceAdd = isset($_POST['experienceAdd'])? filter_var($_POST['experienceAdd'],FILTER_SANITIZE_NUMBER_FLOAT) : 0;
			$specializationAdd= isset($_POST['specializationAdd'])? filter_var($_POST['specializationAdd'],FILTER_SANITIZE_NUMBER_FLOAT) : 0;
			$addlevel = isset($_POST['addlevel'])? filter_var($_POST['addlevel'],FILTER_SANITIZE_NUMBER_INT):'';

			if(empty($jobName) ){
				//$formErrors[] = 'username must be larger than  chars';
				echo "empty";
				// print_r($formErrors) ;
			} else {
				
				$con = connect();
				$sql= "INSERT INTO job(job,level_id,experience_amount,specialization_amount,representation_amount) 
					VALUES ('".$jobName."','".$addlevel."','".$experienceAdd."','".$specializationAdd."','".$representationAdd."')" ;
				$stmt = $con->prepare($sql);
				$stmt->execute();
				// echo "done";
			}
		}
	}
	/**
	 * function to insert new level
	 * 	
	*/
	function insertNewLevel()	{
		if(isset($_POST['insertLevel'])){
			//assign variables

			$level= isset($_POST['level'])? filter_var($_POST['level'],FILTER_SANITIZE_STRING) : '';
			$incentivepercent = isset($_POST['hafezpercent'])? filter_var($_POST['hafezpercent'],FILTER_SANITIZE_NUMBER_FLOAT) :0;
		
			if(empty($level) ){
				//$formErrors[] = 'username must be larger than  chars';
				echo "empty";
				// print_r($formErrors) ;
			} else {
				
				$con = connect();
				$sql= "INSERT INTO level(empLevel,incentivePercent) VALUES ('".$level."','".$incentivepercent."')" ;
				$stmt = $con->prepare($sql);
				$stmt->execute();
				//echo "done";
			}
		}
	}
	/**
	 * function to insert new level
	 * 	
	*/
	function insertNewSyndicate()	{
		if(isset($_POST['insertsyndicate'])){
			//assign variables

			$syndicate= isset($_POST['syndicate'])? filter_var($_POST['syndicate'],FILTER_SANITIZE_STRING) : '';
			$amount = isset($_POST['syndicate_amount'])? filter_var($_POST['syndicate_amount'],FILTER_SANITIZE_NUMBER_FLOAT) :0;
		
			if(empty($syndicate) ){
				//$formErrors[] = 'username must be larger than  chars';
				echo "job cant be empty";
				// print_r($formErrors) ;
			} else {
				
				$con = connect();
				$sql= "INSERT INTO syndicates(syndicate,amount) VALUES ('".$syndicate."','".$amount."')" ;
				$stmt = $con->prepare($sql);
				$stmt->execute();
				// echo "done";
			}
		}
	}
	/**
	 * function to insert new contract
	 * 	
	*/
	function insertContract(){
		if(isset($_POST['insertcontract'])){
			//assign variables

			$contract= isset($_POST['contract'])? filter_var($_POST['contract'],FILTER_SANITIZE_STRING) : '';
			
			if(empty($contract) ){
				//$formErrors[] = 'username must be larger than  chars';
				echo "contract cant be empty";
				// print_r($formErrors) ;
			} else {
				
				$con = connect();
				$sql= "INSERT INTO contract(contractType) VALUES ('".$contract."')" ;
				$stmt = $con->prepare($sql);
				$stmt->execute();
				// echo "done";
			}
		}
	}
	/**
	 * function to insert new marital status
	 * 	
	*/
	function insertMaritalStatus(){
		if(isset($_POST['insertMaritalStatus'])){
			//assign variables

			$maritalStatus= isset($_POST['MaritalStatus'])? filter_var($_POST['MaritalStatus'],FILTER_SANITIZE_STRING) : '';
			$amount= isset($_POST['amount'])? filter_var($_POST['amount'],FILTER_SANITIZE_NUMBER_FLOAT) : '';
			$medInsurance= isset($_POST['medInsurance'])? filter_var($_POST['medInsurance'],FILTER_SANITIZE_NUMBER_FLOAT) : '';
			
			if(empty($maritalStatus) ){
				//$formErrors[] = 'username must be larger than  chars';
				echo "marital status cant be empty";
				// print_r($formErrors) ;
			} else {
				
				$con = connect();
				$sql= "INSERT INTO maritalstatus(maritalStatus,social_insurance,med_insurance) 
						VALUES ('".$maritalStatus."','".$amount."','".$medInsurance."')" ;
				$stmt = $con->prepare($sql);
				$stmt->execute();
				// echo "done";
			}
		}
    }
	/**
	 * function to edit existing level
	 * 	
	*/
	function editLevel(){
		if(isset($_POST['updateLevel'])){
			//assign variables
			$level_ID = isset($_POST['level_id'])? filter_var($_POST['level_id'],FILTER_SANITIZE_NUMBER_INT):'';
			$leveledit= isset($_POST['levelEdit'])? filter_var($_POST['levelEdit'],FILTER_SANITIZE_STRING) : '';
			$incentive= isset($_POST['hafezpercentEdit'])? filter_var($_POST['hafezpercentEdit'],FILTER_SANITIZE_NUMBER_FLOAT,
			FILTER_FLAG_ALLOW_FRACTION) : '';
			if(empty($leveledit) ){
				//$formErrors[] = 'username must be larger than  chars';
				echo "level cant be empty";
				// print_r($formErrors) ;
			} else {
				
				$con = connect();
				$sql= "update level 
					   set empLevel = '$leveledit',
					   		incentivePercent = $incentive
					   where ID = $level_ID" ;
				$stmt = $con->prepare($sql);
				$stmt->execute();
				
			}
		}
	}
	/**
	 * function to edit existing job
	 * 	
	*/
	function editJob(){
		if(isset($_POST['updatejob'])){
			//assign variables
			$job_id = isset($_POST['job_id'])? filter_var($_POST['job_id'],FILTER_SANITIZE_NUMBER_INT):'';
			$level_id = isset($_POST['level_id'])? filter_var($_POST['level_id'],FILTER_SANITIZE_NUMBER_INT):'';

			$jobEdit= isset($_POST['jobEdit'])? filter_var($_POST['jobEdit'],FILTER_SANITIZE_STRING) : '';
			$experienceEdit= isset($_POST['experienceEdit'])? filter_var($_POST['experienceEdit'],FILTER_SANITIZE_NUMBER_FLOAT,
								FILTER_FLAG_ALLOW_FRACTION) : '';
			$representationEdit= isset($_POST['representationEdit'])? filter_var($_POST['representationEdit'],FILTER_SANITIZE_NUMBER_FLOAT,
								FILTER_FLAG_ALLOW_FRACTION) : '';
			$specializationEdit= isset($_POST['specializationEdit'])? filter_var($_POST['specializationEdit'],FILTER_SANITIZE_NUMBER_FLOAT,
								FILTER_FLAG_ALLOW_FRACTION) : '';
			if(empty($jobEdit) ){
				//$formErrors[] = 'username must be larger than  chars';
				echo "job cant be empty";
				// print_r($formErrors) ;
			} else {
				
				$con = connect();
				$sql= "update job 
					   set 	  job = '$jobEdit',
							  level_id = $level_id,
							  experience_amount = $experienceEdit,
							  specialization_amount=$specializationEdit,
							  representation_amount	=$representationEdit							  
					   where ID = $job_id" ;
				$stmt = $con->prepare($sql);
				$stmt->execute();
			}
		}
	}
	/**
	 * function to edit existing contract
	 * 	
	*/
	function editContract(){
		if(isset($_POST['updatecontract'])){
			//assign variables
			$contract_id = isset($_POST['contract_id'])? filter_var($_POST['contract_id'],FILTER_SANITIZE_NUMBER_INT):'';
			$contract = isset($_POST['contractEdit'])? filter_var($_POST['contractEdit'],FILTER_SANITIZE_STRING):'';

			if(empty($contract) ){
				//$formErrors[] = 'username must be larger than  chars';
				echo "job cant be empty";
				// print_r($formErrors) ;
			} else {
				
				$con = connect();
				$sql= "update contract
					   set 	  contractType = '$contract'
					   where ID = $contract_id" ;
				$stmt = $con->prepare($sql);
				$stmt->execute();
			}
		}
	}
	/**
	 * function to edit existing marital status
	 * 	
	*/
	function editMaritalStatus(){
		if(isset($_POST['updateMaritalStatus'])){
			//assign variables
			$MaritalStatus_id = isset($_POST['MaritalStatus_id'])? filter_var($_POST['MaritalStatus_id'],FILTER_SANITIZE_NUMBER_INT):'';
			$MaritalStatusEdit = isset($_POST['MaritalStatusEdit'])? filter_var($_POST['MaritalStatusEdit'],FILTER_SANITIZE_STRING):'';
			$amountEdit = isset($_POST['amountEdit'])? filter_var($_POST['amountEdit'],FILTER_SANITIZE_NUMBER_FLOAT,
						FILTER_FLAG_ALLOW_FRACTION) : '';
			$medInsuranceEdit = isset($_POST['medInsuranceEdit'])? filter_var($_POST['medInsuranceEdit'],FILTER_SANITIZE_NUMBER_FLOAT,
						FILTER_FLAG_ALLOW_FRACTION) : '';
			if(empty($MaritalStatusEdit) ){
				//$formErrors[] = 'username must be larger than  chars';
				echo "ms cant be empty";
				// print_r($formErrors) ;
			} else {
				
				$con = connect();
				$sql= "update maritalstatus
					   set 	 maritalStatus = '$MaritalStatusEdit',
							social_insurance = $amountEdit,
							med_insurance = $medInsuranceEdit 
					   where ID = $MaritalStatus_id" ;
				$stmt = $con->prepare($sql);
				$stmt->execute();
			
			}
		}
	}
		/**
	 * function to edit existing marital status
	 * 	
	*/
	function editSyndicate(){
		if(isset($_POST['updatesyndicate'])){
			//assign variables
			$syndicate_id = isset($_POST['syndicate_id'])? filter_var($_POST['syndicate_id'],FILTER_SANITIZE_NUMBER_INT):'';
			$syndicateEdit = isset($_POST['syndicateEdit'])? filter_var($_POST['syndicateEdit'],FILTER_SANITIZE_STRING):'';
			$syndicateAmountEdit = isset($_POST['syndicateAmountEdit'])? filter_var($_POST['syndicateAmountEdit'],FILTER_SANITIZE_NUMBER_FLOAT,
						FILTER_FLAG_ALLOW_FRACTION) : '';

			if(empty($syndicateEdit) ){
				//$formErrors[] = 'username must be larger than  chars';
				echo "ms cant be empty";
				// print_r($formErrors) ;
			} else {
				
				$con = connect();
				$sql= "update syndicates
					   set 	 syndicate = '$syndicateEdit',
							amount = $syndicateAmountEdit
					   where ID = $syndicate_id" ;
				$stmt = $con->prepare($sql);
				$stmt->execute();
			
			}
		}
	}

