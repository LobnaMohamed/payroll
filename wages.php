<?php include 'header.php'; ?>

<div class="container">
    <header class="row text-center">
    	<img class= "col-sm-2" src="images/amoc2.png">
  	    <h1 class="col-sm-4 col-sm-offset-2 ">مرتب 24</h1>	    
    </header>	  
    <form  method="POST" action="#" >
        <div class="form-group  row">
            <div class="col-md-2">
                <label for="emplevel">المستوى</label>
			    <select class="form-control" id="emplevel" name="emplevel">
			    	<!-- <option selected disabled hidden style='display: none' value=''></option> -->
		   		    
				</select>
            </div>
            <div class="col-md-2">
                <label for="empcontract">نوع العقد</label>
			    <select class="form-control" id="empcontract" name="empcontract">
			    	<!-- <option selected disabled hidden style='display: none' value=''></option> -->
		   		    
				</select>
            </div>
            <div class="col-md-2">
                <label for="empMaritalStatus">الحالة الاجتماعية</label>
			    <select class="form-control" id="empMaritalStatus" name="empMaritalStatus">
			    	<!-- <option selected disabled hidden style='display: none' value=''></option> -->
    
				</select>
            </div>
            <div class="col-md-2">
                <label for="empgender" >النـــوع</label>
	    		<input type="text" class="form-control" id="empgender" name="empgender" >
            </div>
            <div class="col-md-3">
                <label for="empname" >الاســـــم</label>
	    		<input type="text" class="form-control" id="empname" name="empname" >
            </div>
            <div class="col-md-1">
                <label for="empcode">رقم القيد</label>
		    	<input type="number" class="form-control" id="empcode" name="empcode">
		    	<input hidden type="text" id="empID" name="empID"/>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="empeducation" >المؤهل الدراسى</label>
	    		<input type="text" class="form-control" id="empeducation" name="empeducation" >
            </div>
            <div class="col-md-3">
                <label for="empjob" >الوظيفة</label>
	    		<input type="text" class="form-control" id="empjob" name="empjob" >
            </div>
            <div class="col-md-2">
                <label for="empmainSalary" >المرتب الأساسى</label>
	    		<input type="number" class="form-control" id="empmainSalary" name="empmainSalary" >
            </div>
        </div>
    </form>
</div>
	<?php include 'footer.php'; ?>
