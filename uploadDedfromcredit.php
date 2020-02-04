<?php 
	include 'header.php';
	include 'functions.php';
?>
	<div class="container">
		
		<div class='page-header pagetitle col-sm-10 col-sm-offset-1'>تسجيل استقطاع من رصيد </div>
		
        <form id="deductionFromCreditUpload" method="POST" action="fetch.php" enctype="multipart/form-data">
            <div class="row">
                <div class="row col-sm-10 col-sm-offset-1">
                    <div class='col-sm-6'>
                        <label for = "deductionFromCreditType">نوع الاستقطاع :</label>
                        <select class="form-control">
                            <?php getDeductionTypes(); ?>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="searchDateFrom">تاريخ الحصر:</label>
                        <input class="form-control"  name="searchDateFrom" id="searchDateFrom" type="date">
                    </div>
                    
                    <div class='col-sm-12'>

                        <div class="col-sm-6">
                            <input type="submit" name="upload_excel" value="upload" 
                            class=" form-control btn btn-primary btn-rounded">
                        </div>   
                        <div class="col-sm-6">
                            <input name="deduction_file" type="file" class="form-control" title="يمكنك تحميل ملفات excel">    
                        </div>         
                        
                    </div>
                </div>
            </div>               
            <hr>
            <div class="row" id="submitted">

            </div>
        </form>
	</div> 
	<?php	include 'footer.php'; ?>