<?php 
	include 'header.php';
	include 'functions.php';
?>
	<div class="container">
		
		<div class='page-header pagetitle col-sm-10 col-sm-offset-1'>تسجيل استقطاع من رصيد </div>
		
		<form class="navbar-form "  id="deductionFromCreditinsertion" method="POST" action="fetch.php">
			<div class="form-group row add-on ">
				<div class='col-sm-3'>
					<button type='button' class="btn  btn-lg btn-primary" data-toggle="modal"
							data-target="#viewdedFromCreditModal" >استقطاعات منتهية</button>
				</div>
				<div class='col-sm-3 '>
					<button type='button' class="btn btn-lg btn-success editdedFromCredit " data-toggle="modal"
						data-target="#editdedFromCreditModal" >استقطاعات جارية</button>
				</div>

				<div class='col-sm-6 '>
					<label for = "getEmpForDed">رقم القيد:</label>
					<select class="form-control" name="getEmpForDed" id="getEmpForDed">
						<?php getEmpDropDown(); ?>
					</select>
				</div>
			</div>

			<hr>
			<?php  deductionItems(); ?>
				<!-- <hr> -->

			<!-- <div class = "row "> -->
				<div class="col-sm-12 ">
					<button class ="btn btn-primary btn-lg col-sm-2 col-sm-offset-5 " 
					type="Submit" name="submitDedFromCredit" >حـــــفظ<i class="fa fa-save fa-fw save-icon"></i></button>			
				</div>	

		</form>
			<!-- Edit Modal -->
			<div id="editdedFromCreditModal" class="modal fade" role="dialog">
				<div class="modal-dialog modal-lg">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h3 class="modal-title ">استقطاعات جارية لـ <span> emp name </span> رقم قيد <span> emp id </span> </h3>
						</div>
						<div class="modal-body row">
							<form method="POST" id="editdedFromCreditForm" name="editdedFromCreditForm" action = "fetch.php">
								<table class="table table-bordered table-responsive">
									<tbody>
										<tr>											
											<th>نوع الاستقطاع</th>
											<th>تاريخ الاستقطاع</th>
											<th>المبلغ</th>
											<th>ينتهى فى</th>
											<th>تسديد المبلغ </th>
										</tr>

									</tbody>
								</table>
								<div class="form-group col-md-3 col-md-offset-4 ">
									<input type="submit" name="UpdateDedFromCredit" class="btn btn-lg btn-success" value="حفظ" >
								</div>
							</form>
						</div>
						<div class="modal-footer">	
						</div>
					</div>
				</div>
			</div>
			<!-- view data modal -->
			<div id="viewdedFromCreditModal" class="modal fade" role="dialog">
				<div class="modal-dialog modal-lg">
					<!-- Modal content-->
					<div class="modal-content ">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h3 class="modal-title "> استقطاعات منتهية لـ <span> emp name </span> رقم قيد <span> emp id </span> </h3>
						</div>
						<div class="modal-body row">
							<!-- <input type="hidden" name="employee_id" id="employee_id">   -->
							<table class="table table-bordered table-responsive">
								<tbody>
									<tr>
										<th>نوع الاستقطاع</th>
										<th>تاريخ الاستقطاع</th>
										<th>المبلغ</th>
										<th>تاريخ الانتهاء</th>
									</tr>
									<tr>
										<td id=""></td>
										<td id=""></td>
										<td id=""></td>
										<td id=""></td>
										

									</tr>

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
	</div> 
	<?php	include 'footer.php'; ?>