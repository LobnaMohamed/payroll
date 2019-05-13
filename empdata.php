<?php 
	// session_start();
	// if(isset($_SESSION['Username'])){
	// 	//echo "Welcome" . $_SESSION['Username'];
	// }else{
	// 	header('Location: index.php');//redirect
	// 	exit();
	// }
	include 'header.php';
	require 'functions.php';      
?>
	<div class="container">
	    <header class="row text-center">
	    	<!-- <img class= "col-lg-2 logo" src="images/amoc2.png"> -->
				<div class='page-header pagetitle col-sm-10 col-sm-offset-1'>بيانات العاملين</div>  
	    </header>
			<div class="empdata-container row">
				<div class="table-responsive row">
					<form class="navbar-form row" role="search" id="searchEmp" method="GET">
						<div class="col-md-2">
							عدد العاملين:
							<?php  getEmpCount() ?>
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
									<th colspan=3><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addEmpModal"><i class='fa fa-plus-circle'></button></th>
								
								</tr>
							</thead>
						<tbody id="empDatabody">
							<?php getAllEmp(); ?>
						</tbody>
					</table>
					<div id="endOfEmpData"></div>	
				</div>	
			</div>  
		<!-- add Modal -->
		<div id="addEmpModal" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg">
				<!-- Modal content-->
				<div class="modal-content ">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"> إضافة عامل جديد </h4>
					</div>
					<div class="modal-body row">
						<form method="POST" id="addEmpForm" action="fetch.php">
							<div class="form-group col-md-4">
								<label for= "addgender">النوع</label>
								<select class="form-control" id="addgender" name="addgender">
									<option selected disabled hidden style='display: none' ></option>
										<?php  
										 	echo"<option value='ذكر'> ذكر</option>"; 
										  echo"<option value='أنثى'>أنثى</option>"; 	
										?>
								</select>
								<label for= "addmaritalstatus">الحالة الاجتماعية</label>
								<select class="form-control" id="addmaritalstatus" name="addmaritalstatus">
									<option selected disabled hidden style='display: none' value=''></option>
										<?php  	get_marital_status(); ?>
								</select>
								<label for= "adddesc_job">الوظيفة الحالية</label>
					    	<input type="text" class="form-control" id="adddesc_job" name="adddesc_job">
								<input type="hidden" name="employee_id" id="employee_id">  
								<label for= "addshift">نهارى/ورادى</label>
								<select class="form-control" id="addshift" name="addshift">
									<option selected disabled hidden style='display: none' ></option>
										<?php  
										 	echo"<option value='نهارى'>نهارى</option>"; 
										  echo"<option value='ورادى'>ورادى</option>"; 	
										?>
								</select>	 
							</div>	 
							<div class="form-group col-md-4">
								<label for= "addempName">اسم الموظف</label>
								<input type="text" class="form-control" id="addempName" name="addempName" >

								<label for= "addlevel">المستوى</label>
								<select class="form-control" id="addlevel" name="addlevel" >
									<option selected disabled hidden style='display: none' value=''></option>
										<?php  	getLevel();   ?>
								</select>
								<label for= "addjob">الوظيفة</label>
								<select class="form-control" id="addjob" name="addjob">
									<option selected disabled hidden style='display: none' value=''></option>
										<?php  	getJob();   ?>
								</select>
								<label for= "addeducation">المؤهل</label>
								<input type="text" class="form-control" id="addeducation" name="addeducation" >
							</div>
							<div class="form-group col-md-4">
								<label for= "addempCode">رقم قيد الموظف</label>
					    	<input type="number" class="form-control" id="addempCode" name="addempCode">
								<label for= "addcontractType">نوع العقد</label>
					    	<select class="form-control" id="addcontractType" name="addcontractType">
							   	<option selected disabled hidden style='display: none' value=''></option>
						   	    <?php  	getContract();   ?>
								</select>	
								<label for= "addbasicsalary">المرتب الاساسى</label>
					    	<input type="text" class="form-control" id="addbasicsalary" name="addbasicsalary">
									
								<label for= "addsyndicate">النقابة</label>
								<select class="form-control" id="addsyndicate" name="addsyndicate">
									<option selected disabled hidden style='display: none' value=''></option>
										<?php  	getsyndicate();   ?>
								</select>
							</div>
							<div class="form-group col-md-3 col-md-offset-4 ">
								<input type="submit" name="insertEmp" class="btn btn-success" value="حفظ">
							</div>	
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- Edit Modal -->
		<div id="editEmpModal" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h3 class="modal-title text-center"> تعديل البيانات الموظف </h3>
					</div>
					<div class="modal-body row">
						<form method="POST" id="editEmpForm" name="editEmpForm" action = "fetch.php">
							<div class="tabbable"> <!-- Only required for left/right tabs -->
								<ul class="nav nav-tabs nav-justified">
									<li class="nav-item"><a href="#tab5" data-toggle="tab">بيانات أساسية</a></li>
									<li class="nav-item"><a href="#tab1" data-toggle="tab">العقد</a></li>
									<li class="nav-item"><a href="#tab2" data-toggle="tab">المستوى</a></li>
									<li class="nav-item"><a href="#tab3" data-toggle="tab">الوظيفة</a></li>
									<li class="nav-item"><a href="#tab4" data-toggle="tab">المرتب</a></li>
								</ul>
								<div class="tab-content">	
									<div class="tab-pane" id="tab5">
										
										<div class="form-group col-md-4 col-md-offset-1 ">
											<label for= "maritalstatusEdit">الحالة الاجتماعية</label>
											<select class="form-control" id="maritalstatusEdit" name="maritalstatusEdit">
												<option selected disabled hidden style='display: none' value=''></option>
													<?php  	get_marital_status(); ?>
											</select>
											<label for= "MSDate">تاريخ الحالة الاجتماعية</label>
											<input type="date" class="form-control" id="MSDate" name="MSDate">
											<label for= "syndicateEdit">النقابة</label>
											<select class="form-control" id="syndicateEdit" name="syndicateEdit">
												<option selected disabled hidden style='display: none' value=''></option>
													<?php  	getsyndicate();   ?>
											</select>
										</div>
										<div class="form-group col-md-4 ">
											<label for= "empNameEdit">اسم الموظف</label>
											<input type="text" class="form-control" id="empNameEdit" name="empNameEdit" >
											<label for= "genderEdit">النوع</label>
											<select class="form-control" id="genderEdit" name="genderEdit">
												<option selected disabled hidden style='display: none' ></option>
													<?php  
														echo"<option value='ذكر'> ذكر</option>"; 
														echo"<option value='أنثى'>أنثى</option>"; 	
													?>
											</select>
											<label for= "educationEdit">المؤهل</label>
											<input type="text" class="form-control" id="educationEdit" name="educationEdit" >	

										</div>
									</div>							
									<div class="tab-pane" id="tab1">
										<div class="form-group col-md-4 col-md-offset-4">
											<label for= "contractDate">التاريخ</label>
											<input type="date" class="form-control" id="contractDate" name="contractDate">
											<label for= "empCodeEdit">رقم قيد الموظف</label>
											<input type="number" class="form-control" id="empCodeEdit" name="empCodeEdit">
											<label for= "contractTypeEdit">نوع العقد</label>
											<select class="form-control" id="contractTypeEdit" name="contractTypeEdit">
												<option selected disabled hidden style='display: none' value=''></option>
													<?php  	getContract();   ?>
											</select>	
											<input type ="hidden" name="employee_idEdit" id="employee_idEdit">  

										</div>
									</div>
									<div class="tab-pane" id="tab2">
										<div class="form-group col-md-4 col-md-offset-4">
											<label for= "levelDate">التاريخ</label>
											<input type="date" class="form-control" id="levelDate" name="levelDate">
											<label for= "levelEdit">المستوى</label>
											<select class="form-control" id="levelEdit" name="levelEdit" >
												<option selected disabled hidden style='display: none' value=''></option>
													<?php  	getLevel();   ?>
											</select>
										</div>
									</div>
									<div class="tab-pane" id="tab3">
										<div class="form-group col-md-4 col-md-offset-4">
										<label for= "jobDate">التاريخ</label>
										<input type="date" class="form-control" id="jobDate" name="jobDate">
										<label for= "jobEdit">الوظيفة</label>
											<select class="form-control" id="jobEdit" name="jobEdit">
												<option selected disabled hidden style='display: none' value=''></option>
													<?php  	getJob();   ?>
											</select>
											<label for= "shiftEdit">نهارى/ورادى</label>
											<input type="text" class="form-control" id="shiftEdit" name="shiftEdit">
											<label for= "desc_jobEdit">الوظيفة الحالية</label>
											<input type="text" class="form-control" id="desc_jobEdit" name="desc_jobEdit">
										</div>
									</div>
									<div class="tab-pane" id="tab4">
										<div class="form-group col-md-4 col-md-offset-4">	
											<label for= "basicSalaryDate">التاريخ</label>
											<input type="date" class="form-control" id="basicSalaryDate" name="basicSalaryDate">											
											<label for= "basicsalaryEdit">المرتب الاساسى</label>
											<input type="text" class="form-control" id="basicsalaryEdit" name="basicsalaryEdit">
										</div>
									</div>
								</div>
								
							</div>	
							<div class="form-group col-md-3 col-md-offset-4 ">
								<input type="submit" name="UpdateEmp" class="btn btn-success" value="حفظ" >
							</div>
						</form>
					</div>
					<div class="modal-footer">	
					</div>
				</div>
			</div>
		</div>

		<!-- view data modal -->
		<div id="viewcurrentEmpModal" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg">
				<!-- Modal content-->
				<div class="modal-content ">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h3 class="modal-title pagetitle text-center">ملف الموظف الحالي </h3>
					</div>
					<div class="modal-body row">
						<!-- <input type="hidden" name="employee_id" id="employee_id">   -->
						<table class="table table-bordered table-responsive">
							<tbody>
								<tr>
									<th >رقم القيد</th>
									<th>الاسم</th>
									<th>تاريخ الميلاد</th>
									<th>تاريخ التعيين</th>
								</tr>
								<tr>
									<td id="currentProfileEmp_code"></td>
									<td id="currentProfileEmp_name"></td>
									<td id="currentProfileEmp_DOB"></td>
									<td id="currentProfileEmp_hireDate"></td>
								</tr>
								<tr>
									<th>نوع العقد</th>
									<th>المستوى الوظيفى</th>
									<th>الحالة الاجتماعية</th>
									<th>نهارى/ورادى</th>
								</tr>
								<tr>
									<td id="currentProfileEmp_contract"></td>
									<td id="currentProfileEmp_level"></td>
									<td id="currentProfileEmp_MS"></td>
									<td id="currentProfileEmp_shift"></td>
								</tr>
								<tr>
									<th>النقابة</th>
									<th>الوظيفة</th>
									<th>المرتب الاساسى</th>
								</tr>
								<tr>
									<td id="currentProfileEmp_syndicate"></td>
									<td id="currentProfileEmp_job"></td>
									<td id="currentProfileEmp_salary"></td>

								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

	</div>		
	<?php include 'footer.php'; ?>