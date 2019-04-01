<?php
	session_start();
	include 'functions.php';
		if(isset($_POST["empID"]))  
		{  
			$con = connect();			
			$sql = "select ID,empName,currentCode,gender,currentLevel,syndicate_id,currentMS,
							  currentContract,currentSalary,currentJob,education
					from employee
					where ID = '".$_POST["empID"]."'";  
			$stmt = $con->prepare($sql);
			$stmt->execute(array($_POST["empID"]));
			$result = $stmt->fetch(); //PDO::FETCH_ASSOC
			//print_r($result) ;
			echo json_encode($result); 

		}
	
	?>