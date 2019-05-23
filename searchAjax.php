<?php
	session_start();
	include 'functions.php';
	$currentURL = $_POST['pageurl'];
	//according to current url the page loads
	if($currentURL == 'timesheet.php'){
		getTimesheet();
	}
	elseif($currentURL == 'empdata.php'){

		getAllEmp();
	}
	elseif($currentURL == 'wages.php'){

		getWagesTotals();
	}
	?>