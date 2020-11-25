<?php 

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
					<form class="navbar-form row" role="search" id="searchEmp" method="POST">
						<div class=" col-md-2">
							<label>
								عدد العاملين:
								<?php  getEmpCount() ?>
							</label>							
						</div>
						<div  class="col-md-2">
							<button type="button" class="btn btn-primary" data-toggle="modal"data-target="#addEmpModal">
								<label> إضافة موظف جديد</label><i class='fa fa-plus-circle'></i>
							</button>
							
							
						</div>
						<div class="form-group add-on col-md-8">
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
									<th>تعديل</th>
									<th>ملف الموظف الحالى</th>
									<th>تاريخ الموظف </th>								
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
						<form method="POST" id="addEmpForm" action="insert.php">
							<div class="form-group col-md-4">
								<label for= "addgender">النوع</label>
								<select class="form-control" id="addgender" name="addgender">
									<option selected disabled hidden style='display: none' ></option>
										<?php  
										 echo"<option selected value='ذكر'> ذكر</option>"; 
										  echo"<option value='أنثى'>أنثى</option>"; 	
										?>
								</select>
								<label for= "addDOB">تاريخ الميلاد</label>
					    		<input type="date" class="form-control" id="addDOB" name="addDOB">
								<label for= "addmaritalstatus">الحالة الاجتماعية</label>
								<select class="form-control" id="addmaritalstatus" name="addmaritalstatus" required>
									<option selected disabled hidden style='display: none' value=''></option>
										<?php  	get_marital_status(); ?>
								</select>
								<label for= "adddesc_job">الوظيفة الحالية</label>
					    		<input type="text" class="form-control" id="adddesc_job" name="adddesc_job">
								<input type="hidden" name="employee_id" id="employee_id">  
								<label for= "addshift">نهارى/ورادى</label>
								<select class="form-control" id="addshift" name="addshift" required>
									<option selected disabled hidden style='display: none' ></option>
										<?php  
										 	echo"<option value='نهارى'>نهارى</option>"; 
										  echo"<option value='ورادى'>ورادى</option>"; 	
										?>
								</select>	 
							</div>	 
							<div class="form-group col-md-4">
								<label for= "addempName">اسم الموظف</label>
								<input type="text" class="form-control" id="addempName" name="addempName" required>
								<label for= "addhireDate">تاريخ التعيين</label>
								<input type="date" class="form-control" id="addhireDate" name="addhireDate" required>

								<label for= "addlevel">المستوى</label>
								<select class="form-control" id="addlevel" name="addlevel" required >
									<option selected disabled hidden style='display: none' value=''></option>
										<?php  	getLevel();   ?>
								</select>
								<label for= "addjob">الوظيفة</label>
								<select class="form-control" id="addjob" name="addjob" required>
									<option selected disabled hidden style='display: none' value=''></option>
										<?php  	getJob();   ?>
								</select>
								<!-- <label for= "addspecialization"> بدل التخصص</label>
					    		<input type="text" class="form-control" id="addspecialization" name="addspecialization"> -->
								<label for= "addeducation">المؤهل</label>
								<input type="text" class="form-control" id="addeducation" name="addeducation" >
							</div>
							<div class="form-group col-md-4">
								<label for= "addempCode">رقم قيد الموظف</label>
					    		<input type="number" class="form-control" id="addempCode" name="addempCode" required>
								<label for= "addcontractType">نوع العقد</label>
					    		<select class="form-control" id="addcontractType" name="addcontractType" required>
									<option selected disabled hidden style='display: none' value=''></option>
									<?php  	getContract();   ?>
								</select>	
								<label for= "addbasicsalary">المرتب الاساسى</label>
					    		<input  class="form-control" id="addbasicsalary" name="addbasicsalary" required>
									
								<label for= "addsyndicate">النقابة</label>
								<select class="form-control" id="addsyndicate" name="addsyndicate">
									<!-- <option selected disabled hidden style='display: none' value= '0'></option> -->
										<?php  	getsyndicate();   ?>
								</select>
								<label for= "addrepresentation"> بدل التمثيل</label>
					    		<input type="text" class="form-control" id="addrepresentation" name="addrepresentation">
								<label for= "addWorkAllowanceNature">بدل الطبيعة</label>
					    		<input type="text" class="form-control" id="addWorkAllowanceNature" name="addWorkAllowanceNature">
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
											<input type="hidden" id="MScurrentValue" name="MScurrentValue">											
											
											<label for= "MSDate">تاريخ الحالة الاجتماعية</label>
											<input type="date" class="form-control" id="MSDate" name="MSDate">
											<input type="hidden" id="MSDatecurrentValue" name="MSDatecurrentValue">											
											
											<label for= "syndicateEdit">النقابة</label>
											<select class="form-control" id="syndicateEdit" name="syndicateEdit">
												<option selected disabled hidden style='display: none' value=''></option>
													<?php  	getsyndicate();   ?>
											</select>
											<input type="hidden" id="syndicatecurrentValue"  name="syndicatecurrentValue">											
											
										</div>
										<div class="form-group col-md-4 ">
											<label for= "empNameEdit">اسم الموظف</label>
											<input type="text" class="form-control" id="empNameEdit" name="empNameEdit" >
											<input type="hidden" id="empNamecurrentValue" name="empNamecurrentValue">											
											
											<label for= "genderEdit">النوع</label>
											<select class="form-control" id="genderEdit" name="genderEdit">
												<option selected disabled hidden style='display: none' ></option>
													<?php  
														echo"<option value='ذكر'> ذكر</option>"; 
														echo"<option value='أنثى'>أنثى</option>"; 	
													?>
											</select>
											<input type="hidden" id="gendercurrentValue" name="gendercurrentValue">											
											
											<label for= "educationEdit">المؤهل</label>
											<input type="text" class="form-control" id="educationEdit" name="educationEdit" >
											<input type="hidden" id="educationcurrentValue" name="educationcurrentValue">											
												

										</div>
									</div>							
									<div class="tab-pane" id="tab1">
										<div class="form-group col-md-4 col-md-offset-4">
											<label for= "contractDate">التاريخ</label>
											<input type="date" class="form-control" id="contractDate" name="contractDate">
											<input type="hidden" id="contractDatecurrentValue" name="contractDatecurrentValue">											
											
											<label for= "empCodeEdit">رقم قيد الموظف</label>
											<input type="number" class="form-control" id="empCodeEdit" name="empCodeEdit">
											<input type="hidden" id="empCodecurrentValue" name="empCodecurrentValue" >											
											
											<label for= "contractTypeEdit">نوع العقد</label>
											<select class="form-control" id="contractTypeEdit" name="contractTypeEdit">
												<option selected disabled hidden style='display: none' value=''></option>
													<?php  	getContract();   ?>
											</select>	
											<input type="hidden" id="contractTypecurrentValue" name="contractTypecurrentValue">											
											
											<input type ="hidden" name="employee_idEdit" id="employee_idEdit">  

										</div>
									</div>
									<div class="tab-pane" id="tab2">
										<div class="form-group col-md-4 col-md-offset-4">
											<label for= "levelDate">التاريخ</label>
											<input type="date" class="form-control" id="levelDate" name="levelDate">
											<input type="hidden" id="levelDatecurrentValue" name="levelDatecurrentValue">											
											
											<label for= "levelEdit">المستوى</label>
											<select class="form-control" id="levelEdit" name="levelEdit" >
												<option selected disabled hidden style='display: none' value=''></option>
													<?php  	getLevel();   ?>
											</select>
											<input type="hidden" id="levelcurrentValue" name="levelcurrentValue">											
											
										</div>
									</div>
									<div class="tab-pane" id="tab3">
										<div class="form-group col-md-4 col-md-offset-4">
										<label for= "jobDate">التاريخ</label>
										<input type="date" class="form-control" id="jobDate" name="jobDate">
										<input type="hidden" id="jobDatecurrentValue" name="jobDatecurrentValue">											
										
										<label for= "jobEdit">الوظيفة</label>
											<select class="form-control" id="jobEdit" name="jobEdit">
												<option selected disabled hidden style='display: none' value=''></option>
													<?php  	getJob();   ?>
											</select>
											<input type="hidden" id="jobcurrentValue" name="jobcurrentValue">											


											<!-- <label for= "shiftEdit">نهارى/ورادى</label>
											<input type="text" class="form-control" id="shiftEdit" name="shiftEdit"> -->

											<label for= "shiftEdit">نهارى/ورادى</label>
											<select class="form-control" id="shiftEdit" name="shiftEdit">
												<option selected disabled hidden style='display: none' ></option>
													<?php  
														echo"<option value='نهارى'>نهارى</option>"; 
														echo"<option value='ورادى'>ورادى</option>"; 	
													?>
											</select>
											<input type="hidden" id="shiftcurrentValue" name="shiftcurrentValue">
											<label for= "desc_jobEdit">الوظيفة الحالية</label>
											<input type="text" class="form-control" id="desc_jobEdit" name="desc_jobEdit">
											<input type="hidden" id="descjobcurrentValue" name="descjobcurrentValue">											
											
										</div>
									</div>
									<div class="tab-pane" id="tab4">
										<div class="form-group col-md-4 col-md-offset-4">	
											<label for= "basicSalaryDate">التاريخ</label>
											<input type="date" class="form-control" id="basicSalaryDate" name="basicSalaryDate">
											<input type="hidden" id="basicSalaryDatecurrentValue" name="basicSalaryDatecurrentValue">											
																						
											<label for= "basicsalaryEdit">المرتب الاساسى</label>
											<input  class="form-control" id="basicsalaryEdit" name="basicsalaryEdit">
											<input type="hidden" id="basicSalarycurrentValue" name="basicSalarycurrentValue">											
											
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

		<!-- check emp history -->
		<div id="checkEmpHistoryModal" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h3 class="modal-title text-center">  تاريخ الموظف </h3>
					</div>
					<div class="modal-body row">
						<form class="navbar-form row " method="POST" id="checkEmpHistoryForm" name="checkEmpHistoryForm" action = "fetch.php">
						<div class="col-sm-6 col-sm-offset-2">
							<label for="historyDate">التاريخ</label>
							<input type ="date" name="historyDate" class="form-control " id ="historyDate" />
						</div>
						
						</form>
						<table class="table table-bordered table-responsive">
							<tbody>
								<tr>
									<th >رقم القيد</th>
									<th>الاسم</th>
									<th>تاريخ الميلاد</th>
									<th>تاريخ التعيين</th>
								</tr>
								<tr>
									<td id="historyEmp_code"></td>
									<td id="historyEmp_name"></td>
									<td id="historyEmp_DOB"></td>
									<td id="historyEmp_hireDate"></td>
								</tr>
								<tr>
									<th>نوع العقد</th>
									<th>المستوى الوظيفى</th>
									<th>الحالة الاجتماعية</th>
									<th>نهارى/ورادى</th>
								</tr>
								<tr>
									<td id="historyEmp_contract"></td>
									<td id="historyEmp_level"></td>
									<td id="historyEmp_MS"></td>
									<td id="historyEmp_shift"></td>
								</tr>
								<tr>
									<th>النقابة</th>
									<th>الوظيفة</th>
									<th>المرتب الاساسى</th>
								</tr>
								<tr>
									<td id="historyEmp_syndicate"></td>
									<td id="historyEmp_job"></td>
									<td id="historyEmp_salary"></td>

								</tr>
							</tbody>
						</table>
					</div>
					<div class="modal-footer">	
					</div>
				</div>
			</div>
		</div>	

	</div>		
	<?php include 'footer.php'; ?>