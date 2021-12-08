<?php
	ob_start();
	include 'header.php';
	// Include config file
	include 'functions.php';
	include 'empFunctions.php';
	include 'timesheetFunctions.php';
	include 'mainDataFunctions.php';
	include 'salaryFunctions.php';

	if(isset($_POST['ResetPassword'])){ //reset password
		//resetPassword();
		header("Location:empData.php");

	}elseif(isset($_POST["insertEmp"])){
		addEmp();
		header("Location:empdata.php");
	}
	elseif(isset($_POST['insertjob'])){ // insert new management
		insertNewJob();
		header("Location:jobs.php");

	}elseif(isset($_POST['insertsyndicate'])){ // insert new management
		insertNewSyndicate();
		header("Location:syndicates.php");

	}
	elseif(isset($_POST['insertLevel'])){ // insert new management
		insertNewLevel();
		header("Location:level.php");

    }elseif(isset($_POST['insertMaritalStatus'])){ // insert new management
		insertMaritalStatus();
		header("Location:maritalstatus.php");

    }
	elseif(isset($_POST['updatejob'])){ // edit management
		editJob();
		header("Location:jobs.php");

	}
	elseif(isset($_POST['insertcontract'])){
		header("Location:contract.php");
		
		insertContract();
	
	}
	
		
	include 'footer.php';
	ob_end_flush();
?>
