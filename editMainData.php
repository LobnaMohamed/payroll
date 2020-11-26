<?php
	ob_start();
	session_start();
	include 'functions.php';
	include 'empFunctions.php';
	include 'timesheetFunctions.php';
	include 'mainDataFunctions.php';
	include 'salaryFunctions.php';
    include 'phpoffice_phpspreadsheet/vendor/autoload.php';
    
    if(isset($_POST["updateLevel"])){

		editLevel();
		header("Location:level.php");	

	}elseif(isset($_POST["updatejob"])){

		editJob();
		header("Location:job.php");
	}elseif(isset($_POST["updatecontract"])){

		editContract();
		header("Location:contract.php");
	}elseif(isset($_POST["updateMaritalStatus"])){
		editMaritalStatus();
		header("Location:maritalstatus.php");
	}elseif(isset($_POST["updatesyndicate"])){
		editSyndicate();
		header("Location:syndicates.php");
	}

	ob_end_flush();
	?>