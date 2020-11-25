<?php
	include 'header.php';
	// Include config file
	include 'functions.php';

	if(isset($_POST['ResetPassword'])){ //reset password
		resetPassword();
		header("Location:empData.php");

	}elseif(isset($_POST["insertEmp"])){
		addEmp();
		header("Location:empdata.php");
	}
	elseif(isset($_POST['insertjob'])){ // insert new management
		addJob();
		header("Location:jobs.php");

    }elseif(isset($_POST['updatejob'])){ // edit management
		editJob();
		header("Location:jobs.php");

	}elseif(isset($_POST['submitOvertime'])){
		insertOvertime();
		header("Location:overtimemodel.php");

	}
	
		
	include 'footer.php';
?>
