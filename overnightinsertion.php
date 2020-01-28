<?php 
    include 'header.php'; 
    require 'functions.php';
    require_once 'phpexcel/PHPExcel/IOFactory.php';
?>
<div class="container">	
    <div class='page-header pagetitle col-sm-10 col-sm-offset-1'> ادخال  أيام النوباتجية</div>
    
    <div class="timesheet-container">
       
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
                     <!-- </div> -->
                </div>

            </div>
            

            <!-- <div class=" table  "> -->
                <!-- </form>
                <form class="form-group row" id=timesheetinsertionForm method="POST" action="fetch.php"> -->
                
                <table id="timesheet" class="table table-striped table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th class="col-xs-1">رقم القيد</th>
                            <th class="col-xs-3">الاسم</th>

                            <th class="col-xs-1">نوباتجية</th>
                            <th class="col-xs-2">ملاحظات</th>

                        </tr>
                    </thead>
                    <tbody id="timesheetbody">
                    </tbody>
                </table>
                <div>
                    <input type="submit" name="insertovernight" value="إدخـــــــال" class="btn btn-primary col-sm-2 col-sm-offset-5 insertTimesheet">    
                </div>
            <!-- </div> -->
        </form>
        
    </div>
</div>
	<?php include 'footer.php'; ?>
