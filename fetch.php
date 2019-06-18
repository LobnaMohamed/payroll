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
			//getDeductions();
		}
		elseif(isset($_POST["updatesanctions"])){
			//updateSanctions();
		}
	
	?>