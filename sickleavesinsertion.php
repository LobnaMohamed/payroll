<?php 
    include 'header.php'; 
    require 'functions.php';
?>
<div class="container">	
    <div class='page-header pagetitle col-sm-10 col-sm-offset-1'> ادخال أيام المــرضى</div>
    
    <!-- <div class="timesheet-container"> -->
    <!-- <form class="navbar-form"  id="" method="POST" action="fetch.php">
			<div class="row add-on ">
                <div class='col-sm-9 form-group'>
                    <label for="sick_leavesDays"> عدد الايام:</label>
                    <input class='form-control' name='sick_leavesDays' id = "sick_leavesDays" value='0' style='width: 100%'>
                    
                    <label for="startDate">تاريخ :</label>
                    <input class='form-control' type = 'date' name='startDate'  style='width: 100%'>

                    <label for="endDate">تاريخ :</label>
                    <input class='form-control' type = 'date' name='endDate' style='width: 100%'>

                    <label for="continious">متصل</label>
                    <input class='form-control' type = 'checkbox' name='continious' style='width: 100%' >
					<label for = "getEmpForDed">رقم القيد:</label>
					<select class="form-control" name="getEmpForDed" id="getEmpForDed">
						<?php //getEmpDropDown(); ?>
					</select>
				</div>
					
			</div>

			<hr>
				<div class="col-sm-12 ">
					<button class ="btn btn-primary btn-lg col-sm-2 col-sm-offset-5 " 
					type="Submit" name="submitDedFromCredit" >حـــــفظ<i class="fa fa-save fa-fw save-icon"></i></button>			
				</div>	

		</form> -->
        <form class="navbar-form " role="search" id="timesheetinsertion" method="POST" action="fetch.php" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-6">
                   
                    <div class="col-sm-4">
                        <input name="result_file" type="file">
                    </div>
                    <div class="col-sm-2">
                        <!-- <button type="submit" name="upload_excel" class="btn btn-primary btn-rounded">Upload Excel</button> -->
                        <input type="submit" name="upload_excel" value="upload" class="btn btn-primary btn-rounded">
                   
                    </div>
                </div>
                <div class="col-sm-6">
                   
                        <label for="searchDateFrom">تاريخ الحصر:</label>
                        <input class="form-control"  name="searchDateFrom" id="searchDateFrom" type="date">
                        <label for = "search">رقم القيد / الاسم :</label>
                        <input class="form-control" placeholder="ابحث.." name="search" id="search" type="text">  
                     
                </div>

            </div>
            <table id="timesheet" class="table table-striped table-bordered table-responsive">
                <thead>
                    <tr>
                        <th class="col-xs-1">رقم القيد</th>
                        <th class="col-xs-1">الاسم</th>
                        <th class="col-xs-1">عدد الايام</th>
                        <th class="col-xs-1">من</th>
                        <th class="col-xs-1">إلى</th>
                        
                        <th class="col-xs-1">متصل </th>
                        <!-- <th class="col-xs-1">عدد ايام الخصم</th> -->
                        <!-- <th class="col-xs-1">قيمة الخصم</th> -->

                    </tr>
                </thead>
                <tbody id="sickleavesbody">
                </tbody>
            </table>
            <div>
                <input type="submit" name="insertsickleaves" value="إدخـــــــال" class="btn btn-primary col-sm-2 col-sm-offset-5 insertTimesheet">    
            </div>
            
        </form>


        <hr>

    <!-- </div> -->
</div>
	<?php include 'footer.php'; ?>
