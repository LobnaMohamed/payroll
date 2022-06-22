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
				<div class='page-header pagetitle col-sm-10 col-sm-offset-1'> الترقيات </div>
	    </header>
			<div class="empdata-container row">
				<!-- <div class="table-responsive row"> -->
					<form class="navbar-form row " role="search" id="searchEmp" method="POST" action="fetch.php"
							enctype="multipart/form-data" onsubmit="return confirm('!سيتم التحديث  ..هل انت متأكد؟');">
						<!-- <div class="row form-group"> -->
						<!-- <div class=" col-md-2">
							<label>
								عدد العاملين:
								<?php //getEmpCount() ?>
							</label>
						</div> -->
						<div class="col-sm-6 form-group">
							<div class="col-sm-5">
								<input name="result_file" type="file">
							</div>
							<div class="col-sm-7">
								<input type="submit" name="upload_deligationsexcel" value="تحديث البيانات"
										id="upload_excel" class="btn btn-primary btn-rounded">

							</div>
						</div>
						<div class="col-sm-6 form-group">

							<!-- <div class="form-group"> -->
								<label for = "search">رقم القيد / الاسم :</label>
								<input class="form-control" placeholder="ابحث.." name="search" id="search" type="text">
								<label for="searchDateFrom">تاريخ الترقيات:</label>
								<input class="form-control"  name="searchDateFrom" id="searchDateFrom" type="date" required>

								<!-- <div class="input-group-btn">
									<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
								</div> -->
								<!-- </div> -->
							<!-- </div> -->
						</div>


						<button id="scroll_down" class="btn btn-lg btn-default form-control" type="button"><i class='fa fa-2x fa-angle-double-down '></i></button>
						<button id="scroll_up" class="btn btn-lg btn-default form-control hide" type="button"><i class='fa fa-2x fa-angle-double-up '></i></button>

					
					<table id="empData" class="table table-striped table-bordered  table-responsive">
							<thead >
								<tr>
									<th>رقم القيد</th>
									<th>الاسم</th>
									<th>التاريخ</th>
                                    <th>الــوظيفــــة الحاليـــة</th>
                                    <th>الوظيفة المنتدب عليها</th>
                                    <th>مستوى الوظيفة المنتدب عليها </th>
                                    <th>حافز الخبرة بعد التعديل</th>
									<th>بدل التخصص بعد التعديل</th>
                                    <th>بدل التمثيل</th>
                                    <th>حافز الإنتاج </th>

								</tr>
							</thead>
						<tbody id="empDatabody">
							
						</tbody>
					</table>
					<div id="endOfEmpData"></div>
                    </form>
				<!-- </div> -->
			</div>
	</div>
	<?php include 'footer.php';?>


