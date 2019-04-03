<?php
	session_start();
	include 'functions.php';
		if(isset($_POST["empID"]))  
		{  
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

		}
		elseif(isset($_POST["insertEmp"])){
			addEmp();
		}
	
	?>