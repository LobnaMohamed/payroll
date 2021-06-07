<?php
    // --------------Add Employee function-----------------------
    function addEmp(){
        //check if user comming from a request
            // $_SERVER['REQUEST_METHOD'] == 'POST'
            //assign variables
            
            $addempName= isset($_POST['addempName'])? filter_var($_POST['addempName'],FILTER_SANITIZE_STRING) : '';
            $addempCode= isset($_POST['addempCode'])? filter_var($_POST['addempCode'],FILTER_SANITIZE_NUMBER_INT):'';
            $addcontractType= isset($_POST['addcontractType'])? filter_var($_POST['addcontractType'],FILTER_SANITIZE_NUMBER_INT):'';
            $addjob= isset($_POST['addjob'])? filter_var($_POST['addjob'],FILTER_SANITIZE_NUMBER_INT):null;
            $addlevel = isset($_POST['addlevel'])? filter_var($_POST['addlevel'],FILTER_SANITIZE_NUMBER_INT):'';
            $addshift= isset($_POST['addshift'])? filter_var($_POST['addshift'],FILTER_SANITIZE_STRING) :'';
            $addmaritalstatus= isset($_POST['addmaritalstatus'])? filter_var($_POST['addmaritalstatus'],FILTER_SANITIZE_NUMBER_INT) :'';
            //$adddesc_job= isset($_POST['adddesc_job'])? filter_var($_POST['adddesc_job'],FILTER_SANITIZE_STRING) : '';
            $addeducation = !empty($_POST['addeducation'])? filter_var($_POST['addeducation'],FILTER_SANITIZE_STRING) : null;
            // $addbasicsalary = isset($_POST['addbasicsalary'])? filter_var($_POST['addbasicsalary'],FILTER_SANITIZE_NUMBER_FLOAT) :null;
            $addbasicsalary = $_POST['addbasicsalary'];

            $addsyndicate = isset($_POST['addsyndicate'])? filter_var($_POST['addsyndicate'],FILTER_SANITIZE_NUMBER_INT):null;
            
            $addgender = isset($_POST['addgender'])? filter_var($_POST['addgender'],FILTER_SANITIZE_STRING) : '';
            $adddesc_job = isset($_POST['adddesc_job'])? filter_var($_POST['adddesc_job'],FILTER_SANITIZE_STRING) : null;
            $addhireDate = !empty($_POST['addhireDate']) ? $_POST['addhireDate']: null;
            $addDOB = !empty($_POST['addDOB']) ? $_POST['addDOB']: null;
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
                                VALUES ($addempCode,'$addempName',$addcontractType,$addjob,$addlevel,'$addshift',
                                $addmaritalstatus,'$addgender',$addbasicsalary,$addsyndicate,'$addhireDate'
                                ,'$addeducation','$addDOB')" ;
                // echo "<pre>";
                // echo $_POST['addsyndicate'];
                // echo $addsyndicate;
                // echo "<br>";
                // echo $employee_sql;
                // echo "</pre>";

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


                
                //echo "done";
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
        $jobEdit= isset($_POST['jobEdit'])? filter_var($_POST['jobEdit'],FILTER_SANITIZE_NUMBER_INT):'';
        // $jobEdit=  filter_var($_POST['jobEdit'],FILTER_SANITIZE_NUMBER_INT);
        $levelEdit = isset($_POST['levelEdit'])? filter_var($_POST['levelEdit'],FILTER_SANITIZE_NUMBER_INT):'';
        $shiftEdit= isset($_POST['shiftEdit'])? filter_var($_POST['shiftEdit'],FILTER_SANITIZE_STRING) :'';
        $maritalstatusEdit= isset($_POST['maritalstatusEdit'])? filter_var($_POST['maritalstatusEdit'],FILTER_SANITIZE_NUMBER_INT) :'';
        $desc_jobEdit= isset($_POST['desc_jobEdit'])? filter_var($_POST['desc_jobEdit'],FILTER_SANITIZE_STRING) : '';
        $educationEdit = isset($_POST['educationEdit'])? filter_var($_POST['educationEdit'],FILTER_SANITIZE_STRING) : '';
        $basicsalaryEdit = $_POST['basicsalaryEdit'];
        $syndicateEdit = isset($_POST['syndicateEdit'])? filter_var($_POST['syndicateEdit'],FILTER_SANITIZE_NUMBER_INT):'';
        $genderEdit = isset($_POST['genderEdit'])? filter_var($_POST['genderEdit'],FILTER_SANITIZE_STRING) : '';
        // echo "<br>";
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        
        //sql statements to be executed
        if($jobEdit != $_POST['jobcurrentValue']){
            $job_sql = "insert into emp_job(emp_id,job_id,job_date,job_description,shift)
                        values($employee_ID,$jobEdit,'$jobDate','$desc_jobEdit','$shiftEdit')";
            $emp_sql = "UPDATE employee SET currentJob = $jobEdit	WHERE ID= $employee_ID";		
            
            $stmt = $con->prepare($job_sql);
            $stmt2 = $con->prepare($emp_sql);
            $stmt->execute();
            $stmt2->execute();	
            // echo "in job";
        }
        if($maritalstatusEdit != $_POST['MScurrentValue'] ){
            $MS_sql = "insert into emp_maritalstatus(emp_id,marital_status_id,marital_status_date)values($employee_ID,$maritalstatusEdit,'$MSDate')";
            $emp_sql = "UPDATE employee SET currentMS = $maritalstatusEdit WHERE ID= $employee_ID";		
            $stmt = $con->prepare($MS_sql);
            $stmt2 = $con->prepare($emp_sql);
            $stmt->execute();
            $stmt2->execute();
            // echo "in ms";
            
        }
        if($levelEdit != $_POST['levelcurrentValue']){
            $level_sql = "insert into emp_level(emp_id,level_id,level_date)values($employee_ID,$levelEdit,'$levelDate')";
            $emp_sql = "UPDATE employee SET currentLevel = $levelEdit WHERE ID= $employee_ID";		
            $stmt = $con->prepare($level_sql);
            $stmt2 = $con->prepare($emp_sql);
            $stmt->execute();
            $stmt2->execute();
            // echo "in level";
            
        }
        if($contractTypeEdit != $_POST['contractTypecurrentValue'] ){
            $contract_sql = "insert into emp_contract(emp_id,contract_id,empCode,contract_date)
            values($employee_ID,$contractTypeEdit,$empCodeEdit,'$contractDate')";
            $emp_sql = "UPDATE employee SET currentContract = $contractTypeEdit WHERE ID= $employee_ID";		
            $stmt = $con->prepare($contract_sql);
            $stmt2 = $con->prepare($emp_sql);
            $stmt->execute();
            $stmt2->execute();
            // echo "in contract";
            
        }
        if($basicsalaryEdit != $_POST['basicSalarycurrentValue']){
            $basicSalary_sql = "insert into emp_basicsalary(emp_id,basicSalary,salaryDate)values($employee_ID,$basicsalaryEdit,'$basicSalaryDate')";
            $emp_sql = "UPDATE employee SET currentSalary = $basicsalaryEdit WHERE ID= $employee_ID";
            $stmt = $con->prepare($basicSalary_sql);
            $stmt2 = $con->prepare($emp_sql);
            $stmt->execute();
            $stmt2->execute();
        }
        if($empNameEdit != $_POST['empNamecurrentValue']){
            $emp_sql = "UPDATE employee SET empName = '$empNameEdit' WHERE ID= $employee_ID";
            echo $emp_sql;
            $stmt = $con->prepare($emp_sql);
            $stmt->execute();
            
        }
        if($genderEdit != $_POST['gendercurrentValue']){
            $emp_sql = "UPDATE employee SET gender = '$genderEdit' WHERE ID= $employee_ID";
            $stmt = $con->prepare($emp_sql);
            $stmt->execute();
            
        }
        if($syndicateEdit != $_POST['syndicatecurrentValue']){
            // $syndicate_sql = "insert into emp_syndicate(emp_id,level_id,level_date)values($employee_ID,$levelEdit,$levelDate)";
            $emp_sql = "UPDATE employee SET syndicate_id = $syndicateEdit WHERE ID= $employee_ID";
            $stmt = $con->prepare($emp_sql);
            $stmt->execute();

            
        }
        if($educationEdit != $_POST['educationcurrentValue']){
            // $syndicate_sql = "insert into emp_syndicate(emp_id,level_id,level_date)values($employee_ID,$levelEdit,$levelDate)";

            $emp_sql = "UPDATE employee SET education = '$educationEdit' WHERE ID= $employee_ID";
            $stmt = $con->prepare($emp_sql);
            $stmt->execute();
            
        }
        else{
            echo "nothing to edit";
        }
        //echo json_encode($result); 
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
	// --------------get Employee history function-----------------------
	function getEmpHistoryMainData(){
		//$output="";
		$con = connect();		
		$sql="select ID,empName,currentCode,DOB,hireDate,gender,education,currentSalary,currentShift,currentMS,syndicate_id,currentContract
				from employee
				where ID = ".$_POST['historyEmpID']."" ;
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
					<button type='button' class='btn btn-primary btn-sm viewEmpHistory' data-toggle='modal' data-target='#checkEmpHistoryModal'
						id=".$row['ID']."><i class='fa fa-history fa-lg' aria-hidden='true'></i></button>
				</td>
			</tr>";
			}
		echo $output;
    }
    
	// --------------get all employees basic salaries function-----------------------
	function getAllBasicSalary(){
		$output="";
		$con = connect();
		$sql= '';		
		if(!empty($_POST['search'])){
			$sql = "select ID,empName,currentCode,currentSalary
					from employee 
					where  (currentCode like '%". $_POST['search'] ."%' 
								OR empName like '%". $_POST['search'] ."%') 
					ORDER BY currentCode";
		}else{
			$sql=" select ID,empName,currentCode,currentSalary
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
				<td>".  $row['currentSalary']. "</td>
			</tr>";
		}
		echo $output;
    }
    //-------------update Benefits----------------------
function updateBasicSalary(){
    $con = connect();
    if(isset($_POST['upload_basicSalaryexcel'])){
        //check if date was choosen
        if(! empty($_POST['searchDateFrom']) && is_uploaded_file($_FILES['result_file']['tmp_name'])){
            if($_FILES["result_file"]["name"] != ''){
                $allowed_extension = array('xls', 'csv', 'xlsx');
                $file_array = explode(".", $_FILES["result_file"]["name"]);
                $file_extension = end($file_array);

                if(in_array($file_extension, $allowed_extension)){
                    $file_name = time() . '.' . $file_extension;
                    move_uploaded_file($_FILES['result_file']['tmp_name'], $file_name);
                    $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
                    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);
                    $spreadsheet = $reader->load($file_name);
                    unlink($file_name);
                    $data = $spreadsheet->getActiveSheet()->toArray();
                    $count = count($data);
                    $sql="";
                    for($row =1; $row < $count ; $row ++){
                        $getEmpID_sql ="select id from employee where currentCode = " . $data[$row][0] ."";
                        $stmt = $con->prepare($getEmpID_sql);
                        $stmt->execute();
                        $empID = $stmt->fetchColumn();                        
                        if($empID){
                            $employee_basicSalary= "($empID," .$data[$row][2].",'" .$data[$row][3]."'),";
                            $sql.= $employee_basicSalary;

                        }else{

                            //echo "emp not found";
                        }
                        $updateCurrentSalary_sql = "UPDATE employee
                        set currentSalary =" .$data[$row][2]."
                        where ID = $empID";                        
                        $statement2 = $con->prepare($updateCurrentSalary_sql);
                        $statement2->execute();                        
                    }
                    $insertBasicSalary_sql = 'INSERT INTO emp_basicsalary(emp_id,basicSalary,salaryDate) 
                                            VALUES '. trim($sql,",");
                    
                    $statement = $con->prepare($insertBasicSalary_sql);
                    $statement->execute();
                    // echo $insertBasicSalary_sql;
                    $message = '<div class="alert alert-success">Data Imported Successfully</div>';

                }else{
                    $message = '<div class="alert alert-danger">Only .xls .csv or .xlsx file allowed</div>';
                }
            }else{
                $message = '<div class="alert alert-danger">Please Select File</div>';
            }

            echo $message;
        }else{
            echo "you have to select date and choose file";
        }

    }
}