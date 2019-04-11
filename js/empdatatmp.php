<!-- <form method="POST" id="editEmpForm" name="editEmpForm" action="fetch.php">
							<div class="form-group col-md-4">
								<label for= "genderEdit">النوع</label>
								<select class="form-control" id="genderEdit" name="genderEdit">
									<option selected disabled hidden style='display: none' ></option>
                                    <?php  
										 	echo"<option value='ذكر'> ذكر</option>"; 
										  echo"<option value='أنثى'>أنثى</option>"; 
											
										?>
								</select>
								<label for= "maritalstatusEdit">الحالة الاجتماعية</label>
								<select class="form-control" id="maritalstatusEdit" name="maritalstatusEdit">
									<option selected disabled hidden style='display: none' value=''></option>
										<?php  	get_marital_status(); ?>
								</select>
								<label for= "desc_jobEdit">الوظيفة الحالية</label>
					    	<input type="text" class="form-control" id="desc_jobEdit" name="desc_jobEdit">
								<input type="hidden" name="employee_id" id="employee_id">  
								<label for= "shiftEdit">نهارى/ورادى</label>
								<input type="text" class="form-control" id="shiftEdit" name="shiftEdit">
									 
							</div>	 
							<div class="form-group col-md-4">
								<label for= "empNameEdit">اسم الموظف</label>
								<input type="text" class="form-control" id="empNameEdit" name="empNameEdit" >

								<label for= "levelEdit">المستوى</label>
								<select class="form-control" id="levelEdit" name="levelEdit" >
									<option selected disabled hidden style='display: none' value=''></option>
										<?php  	getLevel();   ?>
								</select>
								<label for= "jobEdit">الوظيفة</label>
								<select class="form-control" id="jobEdit" name="jobEdit">
									<option selected disabled hidden style='display: none' value=''></option>
										<?php  	getJob();   ?>
								</select>
								<label for= "educationEdit">المؤهل</label>
								<input type="text" class="form-control" id="educationEdit" name="educationEdit" >
							</div>
							<div class="form-group col-md-4">
								<label for= "empCodeEdit">رقم قيد الموظف</label>
					    		<input type="number" class="form-control" id="empCodeEdit" name="empCodeEdit">
									<label for= "contractTypeEdit">نوع العقد</label>
					    		<select class="form-control" id="contractTypeEdit" name="contractTypeEdit">
							    	<option selected disabled hidden style='display: none' value=''></option>
						   		    <?php  	getContract();   ?>
									</select>	
									<label for= "basicsalaryEdit">المرتب الاساسى</label>
					    		<input type="text" class="form-control" id="basicsalaryEdit" name="basicsalaryEdit">
									
									<label for= "syndicateEdit">النقابة</label>
									<select class="form-control" id="syndicateEdit" name="syndicateEdit">
										<option selected disabled hidden style='display: none' value=''></option>
											<?php  	getsyndicate();   ?>
									</select>
							</div>
							<div class="form-group col-md-3 col-md-offset-4 ">
								<input type="submit" name="UpdateEmp" class="btn btn-success" value="حفظ" >
							</div>	
						</form> -->