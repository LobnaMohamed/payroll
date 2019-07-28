<?php
	session_start();
	include 'functions.php';
		if(isset($_POST["empID"]))  
		{  
			//show data in emp modal
			$con = connect();			
			$sql = "select ID,empName,currentCode,gender,currentLevel,syndicate_id,currentMS,currentContract,
						   currentSalary,currentJob,education,currentShift,shift,job_description,ej.MaxDate
					from employee inner join emp_job on employee.ID = emp_job.emp_id
					inner join (select emp_id, max(job_date) as MaxDate
								from emp_job
								group by emp_id) ej
							on  emp_job.job_date = ej.MaxDate
					where ID = '".$_POST["empID"]."'";  
					
			$stmt = $con->prepare($sql);
			$stmt->execute(array($_POST["empID"]));
			$result = $stmt->fetch(); //PDO::FETCH_ASSOC
			//print_r($result) ;
			echo json_encode($result); 

		}elseif(isset($_POST["currentProfileEmpID"])){
			getEmpCurrentProfile(); 
		}
		elseif(isset($_POST["insertEmp"])){
			addEmp();
		}
		elseif(isset($_POST["UpdateEmp"])){
			editEmp();
		}
		elseif(isset($_POST["calculateSalary24"])){
			//check timesheet for the month
			$con = connect();
			$sql=  "select count(s.TS_id)
					from timesheet t,salary s
					where t.ID=s.TS_id and t.emp_id = s.emp_id
					and t.sheetDate = '" . $_POST['searchDateFrom'] ."'";
			$stmt = $con->prepare($sql);
			$stmt->execute(array($_POST["searchDateFrom"]));
			$result = $stmt->fetchColumn();
			//echo $result;
			if($result <= 0){   //if this date already exists in salary table
				calculateSalary24();
				getWagesTotals();
				
			}
			else{
				getWagesTotals();
				
			}
		}
		elseif(isset($_POST["updateDeductions"])){
		
			updateDeductions();
			header("Location:deductions.php");
			//getDeductions();
		}
		elseif(isset($_POST["updatesanctions"])){
			insertSanctions();
			header("Location:sanctions.php");
			
		}
		elseif(isset($_POST["insertTimesheet"])){
			$con = connect();
			print_r( $_POST);
			//$timesheetDate =$_POST['timesheetDate'];
			$checkDate_sql = "select distinct ID from timesheets where sheetDate ='" . $_POST['timesheetDate'] ."' ";
			// echo $checkDate_sql;
			$stmt = $con->prepare($checkDate_sql);
			$stmt->execute();
			$result = $stmt->fetchColumn();
			// echo "<br>";
			// echo "hi";
			// echo $result;
			if( !$result){
				echo"insert timesheet";
				insertTimesheet();
			    header("location:timesheetinsertion.php");
			}else{
				//echo "already exists";
			}
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
	
	?>