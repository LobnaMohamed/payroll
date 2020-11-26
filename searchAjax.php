<?php
	session_start();
	include 'functions.php';
	include 'empFunctions.php';
	include 'timesheetFunctions.php';
	include 'mainDataFunctions.php';
	include 'salaryFunctions.php';
	$currentURL = $_POST['pageurl'];
	//according to current url the page loads
	if($currentURL == 'timesheet.php'){
		getTimesheet();
	}elseif($currentURL == 'timesheetinsertion.php'){
		getinsertTimesheet();

	}elseif($currentURL == 'shiftinsertion.php'){
		getinsertshiftDays();

	}elseif($currentURL == 'overnightinsertion.php'){
		getinsertovernightDays();
		
	}elseif($currentURL == 'sickleavesinsertion.php'){
		getsickLeavesDays();
		
	}
	elseif($currentURL == 'empdata.php'){

		getAllEmp();



	}
	elseif($currentURL == 'wages.php'){
		$con = connect();
		$sql=  "select count(s.TS_id)
				from timesheets t,salary s
				where t.ID=s.TS_id 
				and month(t.sheetDate) = month('" . $_POST['dateFrom'] ."')
				and year(t.sheetDate) = year('" . $_POST['dateFrom'] ."')";
		$stmt = $con->prepare($sql);
		$stmt->execute(array($_POST["dateFrom"]));
		$result = $stmt->fetchColumn();
		echo $result;
		if($result <= 0){   
			echo "no salary in choosen date";
	     	// calculateSalary24();
		 	// getWagesTotals();
			
		}
		else{//if this date already exists in salary table 
			 getWagesTotals();
			//echo"in search ajax ";
		}
		
	}
	elseif($currentURL == 'deductions.php'){

		getDeductions();
	}
	elseif($currentURL == 'sanctions.php'){

		getSanctions();
	}elseif($currentURL == 'benefitsreview.php'){

		showbenefits();
	}elseif($currentURL == 'benefits.php'){

		getBenefits();
	}
	
	//elseif($currentURL == 'insertDedfromcredit.php'){

	// 	$sql = "select empName from employee where ID = ".$_POST['search']."";
	// }
	?>