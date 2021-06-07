<?php 
    include 'header.php'; 
    require 'functions.php';
    require 'timesheetFunctions.php';
    require 'mainDataFunctions.php';
    require 'salaryFunctions.php';
   
?>
<div class="container">	
    <div class='page-header pagetitle col-sm-10 col-sm-offset-1'> ادخال الحـــصر</div>
    
    <!-- <div class="timesheet-container"> -->
       
        <form class="navbar-form " role="search" id="timesheetinsertion" method="POST" action="fetch.php" 
                enctype="multipart/form-data" onsubmit="return confirm('سيتم اضافة الحصر..هل انت متأكد؟');">
            <div class="row form-group">
                <div class="col-sm-5">
                   
                    <div class="col-sm-2">
                        <input name="result_file" type="file">
                    </div>
                    <div class="col-sm-3">
                        <!-- <button type="submit" name="upload_excel" class="btn btn-primary btn-rounded">Upload Excel</button> -->
                        <input type="submit" name="upload_excel" value="اضافة الحصر" id="upload_excel" class="btn btn-primary btn-rounded">
                    </div>
                </div>
                <div class="col-sm-7 ">
                   
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
                            <th class="col-xs-1">الاسم</th>
                            <th class="col-xs-1">الحضـور</th>
                            <th class="col-xs-1">الانقطاع</th>

                            <th class="col-xs-1">عارضة</th>
                            <th class="col-xs-1">مرضى</th>
                            <th class="col-xs-1">بالخصم</th>
                            <th class="col-xs-1">السنوى</th>

                            <th class="col-xs-1">التصنيع</th>
                            <th class="col-xs-1">تقييم الاداء</th>
                            <th >ملاحظات</th>

                        </tr>
                    </thead>
                    <tbody id="timesheetbody">
                    </tbody>
                </table>
                <div>
                    <input type="submit" name="insertTimesheet" value="إدخـــــــال" class="btn btn-primary col-sm-2 col-sm-offset-5 insertTimesheet">    
                </div>
            <!-- </div> -->
        </form>
        
    <!-- </div> -->
</div>

<?php include 'footer.php'; ?>
