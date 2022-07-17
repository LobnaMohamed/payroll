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
				<div class='page-header pagetitle col-sm-10 col-sm-offset-1'> استقطاعات </div>
	    </header>
			<div class="empdata-container row">
				<!-- <div class="table-responsive row"> -->
					<form class="navbar-form row " role="search" id="searchEmp" method="POST" action="fetch.php"
							enctype="multipart/form-data" onsubmit="return confirm('!سيتم التحديث  ..هل انت متأكد؟');">

						<div class="col-sm-6 form-group">
							<div class="col-sm-5">
								<input name="result_file" type="file">
							</div>
							<div class="col-sm-7">
								<input type="submit" name="upload_deductionsexcel" value="اضافة الاستقطاعات"
										id="upload_excel" class="btn btn-primary btn-rounded">

							</div>
						</div>
						<div class="col-sm-6 form-group">
                            <label for = "search">رقم القيد / الاسم :</label>
                            <input class="form-control" placeholder="ابحث.." name="search" id="search" type="text">
                            <label for="searchDateFrom">التاريخ :</label>
                            <input class="form-control"  name="searchDateFrom" id="searchDateFrom" type="date" required>
						</div>


						<button id="scroll_down" class="btn btn-lg btn-default form-control" type="button"><i class='fa fa-2x fa-angle-double-down '></i></button>
						<button id="scroll_up" class="btn btn-lg btn-default form-control hide" type="button"><i class='fa fa-2x fa-angle-double-up '></i></button>

					
					<table id="empData" class="table table-striped table-bordered  table-responsive">
							<thead >
								<tr>
									<th>رقم القيد</th>
									<th>الاسم</th>
									<th>التاريخ</th>
                                    <th>مدة سابقة</th>
                                    <th>كارت بريميوم</th>
                                    <th>علاج الأسر</th>
                                    <th>استقطاع أخر</th>
									<th>ن.بترول</th>
                                    <th>جزاءات</th>
                                    <th>موبايل</th>
                                    <th>نظام زمالة</th>
                                    <th>صندوق خدمات عاملين</th>
                                    <th>جنيهات مرحله</th>
                                    <th>التأمينات</th>
                                    <th>معاش تكميلى</th>
                                    <th>الضريبة</th>
                                    <th>اتصالات</th>
                                    <th>رحلة العمرة</th>
                                    <th>بنك القاهرة</th>
                                    <th>فودافون</th>
								</tr>
							</thead>
						<tbody id="deductionsbody">
							
						</tbody>
					</table>
					<!-- <div id="endOfEmpData"></div> -->
                    </form>
				<!-- </div> -->
			</div>
	</div>
	<?php include 'footer.php';?>


