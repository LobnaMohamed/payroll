<?php 
	include 'header.php';
	include 'functions.php';
?>
	<div class="container">
		
		<div class='page-header pagetitle col-sm-10 col-sm-offset-1'>تسجيل استقطاع من رصيد </div>
		
        <form id="deductionFromCreditUpload" method="POST" action="fetch.php" enctype="multipart/form-data">
            <div class="row">


                <div class="col-sm-12">
                    <label for="searchDateFrom">تاريخ الحصر:</label>
                    <input class="form-control"  name="searchDateFrom" id="searchDateFrom" type="date">
                   
                        <label for="trips">الرحلات</label>
                        <input name="trips_file" class="form-control" type="file" id="trips"><br>
                        <label for="trips">الادوية</label>
                        <input name="meds_file" class="form-control" type="file" id="meds">
                        <label for="trips">معارض</label>
                        <input name="Exhibition_file" class="form-control" type="file" id="Exhibition">

                        
                        <input type="submit" name="upload_excel" value="upload" 
                        class=" form-control btn btn-primary btn-rounded">
                  
                
                </div>
                <!-- <div class="col-sm-2">
                    <label for="searchDateFrom">تاريخ الحصر:</label>
                    <input class="form-control"  name="searchDateFrom" id="searchDateFrom" type="date">
                    <input type="submit" name="upload_excel" value="upload" class="btn btn-primary btn-rounded">
                </div> -->
            </div>               
        
        </form>
	</div> 
	<?php	include 'footer.php'; ?>