<?php
	session_start();
	include 'functions.php';
    require_once 'phpexcel/PHPExcel/IOFactory.php';

            calculateSalary24();
            
            getWagesTotals();