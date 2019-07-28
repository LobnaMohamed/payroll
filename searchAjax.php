<?php
	session_start();
	include 'functions.php';
	$currentURL = $_POST['pageurl'];
	//according to current url the page loads
	if($currentURL == 'timesheet.php'){
		getTimesheet();
	}elseif($currentURL == 'timesheetinsertion.php'){
		getinsertTimesheet();
	}
	elseif($currentURL == 'empdata.php'){

		getAllEmp();
	}
	elseif($currentURL == 'wages.php'){
		// $con = connect();
		// $sql=  "select count(s.TS_id)
		// 		from timesheets t,salary s
		// 		where t.ID=s.TS_id and t.emp_id = s.emp_id
		// 		and t.sheetDate = '" . $_POST['dateFrom'] ."'";
		// $stmt = $con->prepare($sql);
		// $stmt->execute(array($_POST["dateFrom"]));
		// $result = $stmt->fetchColumn();
		//echo $result;
		// if($result <= 0){   //if this date already exists in salary table
	     	calculateSalary24();
		 	getWagesTotals();
			
		// }
		// else{
		// 	getWagesTotals();
			
		// }
		
	}
	elseif($currentURL == 'Deductions.php'){

		getDeductions();
	}
	elseif($currentURL == 'sanctions.php'){

		getSanctions();
	}
	?>