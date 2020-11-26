<?php
	session_start();
    include 'functions.php';
    include 'empFunctions.php';
	include 'timesheetFunctions.php';
	include 'mainDataFunctions.php';
	include 'salaryFunctions.php';
    require_once 'phpexcel/PHPExcel/IOFactory.php';

            calculateSalary24();
            
            getWagesTotals();