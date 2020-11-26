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
		insertNewJob();
		header("Location:jobs.php");

	}elseif(isset($_POST['insertsyndicate'])){ // insert new management
		insertNewSyndicate();
		header("Location:syndicates.php");

	}
	elseif(isset($_POST['insertLevel'])){ // insert new management
		insertNewLevel();
		header("Location:level.php");

    }
	elseif(isset($_POST['updatejob'])){ // edit management
		editJob();
		header("Location:jobs.php");

	}
	
		
	include 'footer.php';
?>
