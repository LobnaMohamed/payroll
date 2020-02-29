<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
	<title>الأجـــور</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="jquery-ui/jquery-ui.min.css">
	<link rel="stylesheet" href="css/style.css">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<nav class="navbar navbar-inverse fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
		  		<!-- <a class="navbar-brand" href="#">Computer Name: <?php  
						if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
					    {
					      $ip=$_SERVER['HTTP_CLIENT_IP'];
					    }
					    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
					    {
					      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
					    }
					    else
					    {
					      $ip=$_SERVER['REMOTE_ADDR'];
					    }
					    echo $ip;   
					 ?></a> -->
				<div class="navbar-brand">
					<img class= "logo col-sm-1" src="images/amoc2.png">
					<span>شركة الأسكندرية للزيوت المعدنية ( أموك )</span> 
					<br>
					<span><?php echo gethostbyaddr($_SERVER['REMOTE_ADDR']);?></span>
				</div>
			</div>
			<ul class="nav navbar-nav pull-right">
			
					<div class="dropdown">
						<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">بيانات أســاسية
						<span class="caret"></span></button>
						<ul class="dropdown-menu dropdown-menu-right">
							<li><a href="empdata.php">بيانات العاملين</a></li>
							<li><a href="level.php">المستويــات</a></li>
							<li><a href="contract.php">أنواع العقود</a></li>
							<li><a href="maritalstatus.php">الحالة الاجتماعية</a></li>
							<li><a href="job.php">الوظــائف</a></li>
							<li><a href="syndicates.php">النقــابات</a></li>
						</ul>
					</div>
					<div class="dropdown">
						<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> الحــصر
						<span class="caret"></span></button>
						<ul class="dropdown-menu dropdown-menu-right">
							<li><a href="timesheetinsertion.php">ادخال الحــصر </a></li>
						  	<li><a href="shiftinsertion.php">ادخال الوردية </a></li>
						  	<li><a href="overnightinsertion.php">ادخال النوباتجية </a></li>
						  	<li><a href="sickleavesinsertion.php">ادخال المرضى </a></li>
							<li><a href="timesheet.php">مراجعة الحـــصر</a></li>
	
						</ul>
					</div>
					<div class="dropdown">
						<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">المـــرتب
						<span class="caret"></span></button>
						<ul class="dropdown-menu dropdown-menu-right">
							<li><a href="wages.php">مـرتب 24 </a></li>
							<li><a href="#">منحـــة 10</a></li>
							<li><a href="#">مـجمع</a></li>
						</ul>
					</div>

					<div class="dropdown">
						<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">  الاستقطاعات
						<span class="caret"></span></button>
						<ul class="dropdown-menu dropdown-menu-right">
							<li class="dropdown-header">ادخالات الاستقطاعات</li>
							<li><a href="deductions.php"> استقطاعات أخرى</a></li>
							<!-- <li><a href="#">علاج أسر</a></li> -->
							<li><a href="sanctions.php">جزاءات</a></li>
							<li class="dropdown-header">الاستقطاعات من الرصيد</li>
							<li><a href="deductiontype.php">أوجه الاستقطاع</a></li>
							<li><a href="deductionfromcredit.php">الاستقطاع من الرصيد</a></li>
							<li><a href="insertDedfromcredit.php">ادخال الاستقطاع من الرصيد</a></li>
							<li><a href="uploadDedfromcredit.php"> excel ادخال الاستقطاع من الرصيد</a></li>
							
							
						</ul>

					</div>
					<div class="dropdown">
						<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">  الاستحقاقات
						<span class="caret"></span></button>
						<ul class="dropdown-menu dropdown-menu-right">
							<li><a href="benefitsreview.php">إستحقاقات</a></li>
							<li><a href="benefits.php">ادخال الإستحقاق</a></li>
						</ul>
					</div>
					<!-- <a href="timesheet.php"  class="btn btn-primary dropdown-toggle">الحـــصر</a> -->
					<a href="#"  class="btn btn-primary dropdown-toggle">خــــروج</a>

			</ul>
		</div>
	</nav>