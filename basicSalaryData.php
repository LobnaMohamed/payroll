<?php 

	include 'header.php';
	require 'functions.php';
	require 'timesheetFunctions.php';
    require 'mainDataFunctions.php';
    require 'salaryFunctions.php';
    require 'empFunctions.php'; 
?>
	<div class="container">
	    <header class="row text-center">
	    	<!-- <img class= "col-lg-2 logo" src="images/amoc2.png"> -->
				<div class='page-header pagetitle col-sm-10 col-sm-offset-1'>بيانات الأجر الأساسى</div>  
	    </header>
			<div class="empdata-container row">
				<div class="table-responsive row">
					<form class="navbar-form row" role="search" id="searchEmp" method="POST">
						<div class=" col-md-2">
							<label>
								عدد العاملين:
								<?php  getEmpCount() ?>
							</label>							
						</div>
						<div class="form-group add-on col-md-10">
							<label for = "search">رقم القيد / الاسم :</label>
							<input class="form-control" placeholder="ابحث.." name="search" id="search" type="text">
							<!-- <div class="input-group-btn">
								<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
							</div> -->
						</div>
						<button id="scroll_down" class="btn btn-lg btn-default form-control" type="button"><i class='fa fa-2x fa-angle-double-down '></i></button>
						<button id="scroll_up" class="btn btn-lg btn-default form-control hide" type="button"><i class='fa fa-2x fa-angle-double-up '></i></button>
						
					</form>
					<table id="empData" class="table table-striped table-bordered">
							<thead >
								<tr>
									<th>رقم القيد</th>
									<th>الاسم</th>
									<th>المرتب الأساسى</th>							
								</tr>
							</thead>
						<tbody id="empDatabody">
							<?php getAllBasicSalary(); ?>
						</tbody>
					</table>
					<div id="endOfEmpData"></div>	
				</div>	
			</div>  
	</div>		
	<?php include 'footer.php'; ?>