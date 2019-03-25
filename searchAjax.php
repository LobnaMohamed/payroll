<?php
	session_start();
	include 'functions.php';
	$currentURL = $_GET['pageurl'];
	//according to current url the page loads
	if($currentURL == 'timesheet.php'){
			getTimesheet();
	}
	?>