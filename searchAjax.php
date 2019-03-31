<?php
	session_start();
	include 'functions.php';
	$currentURL = $_POST['pageurl'];
	//according to current url the page loads
	if($currentURL == 'timesheet.php'){
			getTimesheet();
	}
	elseif($currentURL == 'empdata.php'){
		if(isset($_POST["empID"]))  
		{  
			$con = connect();
			$sql= '';
			//$sql .= "SELECT * FROM empdata"
			$sql = "select e.ID,e.empName,e.currentCode,e.gender,c.contractType,l.empLevel,ms.maritalStatus,s.syndicate,
						j.job
					from employee e,syndicates s,contract c,level l,maritalstatus ms, job j
					where e.ID = '".$_POST["empID"]."' 
						and e.syndicate_id = s.ID
						and e.currentJob = j.ID
						and e.currentLevel = l.ID
						and e.currentContract = c.ID
						and e.currentMS = ms.ID   ";  
			$stmt = $con->prepare($sql);
			$stmt->execute(array($_POST["empID"]));
			$result = $stmt->fetch(); //PDO::FETCH_ASSOC
			//print_r($result) ;
			echo json_encode($result); 

		}
	}
	?>