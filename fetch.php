<?php
	session_start();
	include 'functions.php';
	include 'phpoffice_phpspreadsheet/vendor/autoload.php';

		if(isset($_POST["empID"]))  
		{  
			//show data in emp modal
			$con = connect();			 
			$sql = "select ID,empName,currentCode,gender,currentLevel,syndicate_id,currentMS,currentContract,currentSalary,currentJob,education,currentShift,hireDate
					,shift,job_description,ej.JobMaxDate,empMS.MSMaxDate,empl.levelMaxDate,empc.contractMaxDate,empbasic.salaryMaxDate
								from employee inner join emp_job on employee.ID = emp_job.emp_id
								inner join (select emp_id, max(job_date) as JobMaxDate
											from emp_job
											group by emp_id) ej
										on  emp_job.job_date = ej.JobMaxDate
								inner join emp_maritalstatus on employee.ID = emp_maritalstatus.emp_id
								inner join (select emp_id, max(marital_status_date) as MSMaxDate
											from emp_maritalstatus
											group by emp_id) empMS
										on  emp_maritalstatus.marital_status_date = empMS.MSMaxDate
								inner join emp_level on employee.ID = emp_level.emp_id
								inner join (select emp_id, max(level_date) as levelMaxDate
											from emp_level
											group by emp_id) empl
										on  emp_level.level_date = empl.levelMaxDate
								inner join emp_contract on employee.ID = emp_contract.emp_id
								inner join (select emp_id, max(contract_date) as contractMaxDate
											from emp_contract
											group by emp_id) empc
										on  emp_contract.contract_date = empc.contractMaxDate
								inner join emp_basicsalary on employee.ID = emp_basicsalary.emp_id
								inner join (select emp_id, max(salaryDate) as salaryMaxDate
											from emp_basicsalary
											group by emp_id) empbasic
										on  emp_basicsalary.salaryDate = empbasic.salaryMaxDate
								where ID ='".$_POST["empID"]."'";
					
			$stmt = $con->prepare($sql);
			$stmt->execute(array($_POST["empID"]));
			$result = $stmt->fetch(); //PDO::FETCH_ASSOC
			//print_r($result) ;
			echo json_encode($result); 

		}
		// elseif(isset($_POST["addjob"])){
		// 	$con = connect();			 
		// 	$sql = "select specialization_amount from job where ID ='".$_POST["addjob"]."' ";

		// }
		elseif(isset($_POST["currentProfileEmpID"])){
			getEmpCurrentProfile(); 
		}
		elseif(isset($_POST["historyEmpID"])){
			getEmpHistoryMainData(); 
		}
		elseif(isset($_POST["level_id"])){
			getLevelDetails();
		}
		elseif(isset($_POST["contract_id"])){
			getContractDetails();
		}
		elseif(isset($_POST["MS_id"])){
			getMSDetails();
		}
		elseif(isset($_POST["syndicate_id"])){
			getsyndicateDetails();
		}
		elseif(isset($_POST["job_id"])){
			getJobDetails();
		}

		elseif(isset($_POST["UpdateEmp"])){
			editEmp();
			header("Location:empdata.php");
		}
		elseif(isset($_POST["calculateSalary24"])){
			// echo"hiii";
			//check timesheet for the month
			//print_r($_POST);
			// $con = connect();
			// $sql=  "select count(s.TS_id)
			// 		from timesheet t,salary s
			// 		where t.ID=s.TS_id and t.emp_id = s.emp_id
			// 		and month(t.sheetDate) = month('" . $_POST['searchDateFrom'] ."')
			// 		and year(t.sheetDate) = year('" . $_POST['searchDateFrom'] ."')";
			// $stmt = $con->prepare($sql);
			// $stmt->execute(array($_POST["searchDateFrom"]));
			// $result = $stmt->fetchColumn();
			// //echo $result;
			// if($result <= 0){   //if this date already exists in salary table
				calculateSalary24();
				
				getWagesTotals();
				// header("Location:wages.php");
				
			// }
			// else{
			// 	getWagesTotals();
				
			// }
		}
		elseif(isset($_POST["updatebenefits"])){
		
			updateBenefits();
			header("Location:benefits.php");
			
		}
		elseif(isset($_POST["updateDeductions"])){
		
			updateDeductions();
			header("Location:deductions.php");
			
		}
		elseif(isset($_POST["updatesanctions"])){
			insertSanctions();
			header("Location:sanctions.php");
			
		}
		elseif(isset($_POST["insertTimesheet"]) || isset($_POST["upload_excel"])){

			insertTimesheet();
			// calculateSalary24();

		    header("location:timesheetinsertion.php");

		}elseif(isset($_POST["insertovernight"]) || isset($_POST["upload_overnightexcel"])){

			insertovernightDays();
			// calculateSalary24();

		     header("location:overnightinsertion.php");

		}elseif(isset($_POST["insertshift"]) || isset($_POST["upload_shiftexcel"])){

			insertshiftDays();
			// calculateSalary24();

		     header("location:shiftinsertion.php");

		}elseif(isset($_POST["insertsickleaves"]) || isset($_POST["upload_sickleavesexcel"])){

			insertsickleavesDays();
			// calculateSalary24();

		    //  header("location:sickleavesinsertion.php");

		}
		elseif(isset($_POST["editTimesheet_empID"]) && isset($_POST["editTimesheet_ID"]) )  
		{  
			//show data in timsheet edit modal
			$con = connect();			
			$sql= "select t.*,e.currentCode,e.empName,empt.*
					from timesheets t inner join empTimesheet empt on t.ID = empt.TS_id 
						inner join employee e on empt.emp_id = e.ID
					where empt.emp_id = '".$_POST["editTimesheet_empID"]."'
					and empt.TS_id ='".$_POST["editTimesheet_ID"]."' ";  
					
			$stmt = $con->prepare($sql);
			$stmt->execute(array($_POST["editTimesheet_empID"], $_POST["editTimesheet_ID"]));
			$result = $stmt->fetch(); //PDO::FETCH_ASSOC
			//print_r($result) ;
			echo json_encode($result); 

		}
		elseif(isset($_POST["UpdateTimesheet"])){
			editTimesheet();
			header("Location:timesheet.php");
		//	getTimesheet();
		}
		elseif(isset($_POST["wagesDetailsEmpID"]) && isset($_POST["wagesDetailssheetID"])){
			viewWagesDetails();
		}
		elseif(isset($_POST["submitDedFromCredit"]) ){
			insertDedFromCredit();
		}
		elseif(isset($_POST["editDed_EmpID"]) ){
			getCurrentCreditDeductionsForEmp();
		}
		elseif(isset($_POST["endedDed_EmpID"]) ){
			getEndedCreditDeductionsForEmp();
		}		
		elseif(isset($_POST["empcodeForCheck"]) ){
			$con = connect();
			$checkempCodeForInsertion ="select currentCode from employee where currentCode = '".$_POST["empcodeForCheck"]."'"; 
			$stmt = $con->prepare($checkempCodeForInsertion);
			$stmt->execute();
			$result = $stmt->fetch(); //PDO::FETCH_ASSOC
			
			if($result){
				echo "notvalid";
			}else{
				echo "valid";
			}
		}

	?>