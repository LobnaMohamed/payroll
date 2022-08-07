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
					<form class="navbar-form row " role="search" id="allDeductions" method="POST" action="fetch.php"
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
							<label for="searchDateFrom">التاريخ :</label>
                            <input class="form-control"  name="searchDateFrom" id="searchDateFrom" type="date" required>
                            <label for = "search">رقم القيد / الاسم :</label>
                            <input class="form-control" placeholder="ابحث.." name="search" id="search" type="text">

						</div>


						<button id="scroll_down" class="btn btn-lg btn-default form-control" type="button"><i class='fa fa-2x fa-angle-double-down '></i></button>
						<button id="scroll_up" class="btn btn-lg btn-default form-control hide" type="button"><i class='fa fa-2x fa-angle-double-up '></i></button>

					</form>
					<table id="empData" class="table table-striped table-bordered  table-responsive">
						<thead >
							<tr>
								<th>رقم القيد</th>
								<th>الاسم</th>
								<th>مدة سابقة</th>
								<th>كارت بريميوم</th>
								<th>علاج الأسر</th>
								<th>استقطاع أخر</th>
								<th>ن.بترول</th>
								<th>جزاءات</th>
								<th>موبايل</th>
								<th>نظام زمالة</th>
								<th>صندوق خدمات عاملين</th>
								<!-- <th>جنيهات مرحله</th> -->
								<th>التأمينات</th>
								<th>معاش تكميلى</th>
								<th>الضريبة</th>
								<th>اتصالات</th>
								<th>رحلة العمرة</th>
								<th>بنك القاهرة</th>
								<th>فودافون</th>
								<th>اجمالى</th>
								<th>تعديل</th>
							</tr>
						</thead>
						<tbody id="deductionsbody">
								<!-- <php getAllDeductions(); ?> -->
						</tbody>
					</table>
								<!-- <div id="endOfEmpData"></div> -->
                    
							<!-- </div> -->

				<!-- Edit Modal -->
				<div id="editdeductionsModal" class="modal fade" role="dialog">
				<div class="modal-dialog modal-lg">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h2 class="modal-title text-center"> تعديل  الاستقطاعات </h2>
						</div>
						<div class="modal-body row">
							<form method="POST" id="editdeductionsForm" name="editdeductionsForm" action = "fetch.php">
								<div class="form-group  col-md-12">
									<label  for= "emp_currentCode" > رقم القيد</label>
									<input class="form-control-plaintext" id="emp_currentCode" disabled>
									<label for= "empName"> الاســم</label>
									<input id="empName" disabled>
									<label for= "sheetDate"> التاريخ </label>
									<input id="sheetDate" disabled>
									<input class="form-control" type="hidden" id="emp_id" name="emp_id" >
									<input class="form-control" type="hidden" id="sheetID" name="sheetID" >


								</div>

								<div class="form-group col-md-3">
									<label for= "pastPeriodEdit"> مدة سابقة</label>
									<input class="form-control" id="pastPeriodEdit" name="pastPeriodEdit">
									<label for= "perimiumEdit"> كارت بريميوم</label>
									<input class="form-control" id="perimiumEdit" name="perimiumEdit">
									<label for= "familyInsuranceEdit"> علاج الأسر</label>
									<input class="form-control" id="familyInsuranceEdit" name="familyInsuranceEdit">
									<label for= "otherDeductionEdit"> استقطاع أخر</label>
									<input class="form-control" id="otherDeductionEdit" name="otherDeductionEdit">
								</div>
								<div class="form-group col-md-3">
									<label for= "petroluemSyndicateEdit"> ن.بترول</label>
									<input class="form-control" id="petroluemSyndicateEdit" name="petroluemSyndicateEdit">
									<label for= "sanctionEdit">جزاءات</label>
									<input class="form-control" id="sanctionEdit" name="sanctionEdit">
									<label for= "mobilEdit">موبايل</label>
									<input class="form-control" id="mobilEdit" name="mobilEdit">
									<label for= "zamalaEdit"> نظام زمالة</label>
									<input class="form-control" id="zamalaEdit" name="zamalaEdit">
								</div>
								<div class="form-group col-md-3">
									<label for= "empServiceFundEdit"> صندوق خدمات عاملين</label>
									<input class="form-control" id="empServiceFundEdit" name="empServiceFundEdit" type="number">
									<label for= "socialInsurancesEdit">التأمينات</label>
									<input class="form-control" id="socialInsurancesEdit" name="socialInsurancesEdit">
									<label for= "supplemntaryPensionEdit"> معاش تكميلى</label>
									<input class="form-control" id="supplemntaryPensionEdit" name="supplemntaryPensionEdit">
									<label for= "taxEdit">الضريبة</label>
									<input class="form-control" id="taxEdit" name="taxEdit">
								</div>
								<div class="form-group col-md-3">
									<label for= "etisalatEdit"> اتصالات</label>
									<input class="form-control" id="etisalatEdit" name="etisalatEdit" type="number">
									<label for= "omraEdit">رحلة العمرة</label>
									<input class="form-control" id="omraEdit" name="omraEdit">
									<label for= "cairoBankEdit"> بنك القاهرة</label>
									<input class="form-control" id="cairoBankEdit" name="cairoBankEdit">
									<label for= "vodafoneEdit">فودافون</label>
									<input class="form-control" id="vodafoneEdit" name="vodafoneEdit">
								</div>
								<div class="form-group col-md-6  col-md-offset-3">
									<label for= "totalDeductionsEdit">الاجمالى</label>
									<input class="form-control" id="totalDeductionsEdit" name="totalDeductionsEdit">
								</div>

								<div class="form-group col-md-3 col-md-offset-4 ">
									<input type="button" name="UpdateDeductions" class="btn btn-success" id ="UpdateDeductions"  value="حفـــــظ" >
								</div>
							</form>
						</div>
						<div class="modal-footer">
						</div>
					</div>
				</div>
			</div>

			</div>
	</div>
	<?php include 'footer.php';?>


