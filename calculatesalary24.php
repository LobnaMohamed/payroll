<?php
	session_start();
    include 'functions.php';
    include 'empFunctions.php';
	include 'timesheetFunctions.php';
	include 'mainDataFunctions.php';
	include 'salaryFunctions.php';
  //  require_once 'phpexcel/PHPExcel/IOFactory.php';
    require_once 'phpoffice_phpspreadsheet\vendor\phpoffice\phpspreadsheet\src\PhpSpreadsheet\IOFactory.php';
            calculateSalary24();
            
            getWagesTotals();