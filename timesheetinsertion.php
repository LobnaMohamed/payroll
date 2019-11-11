<?php 
    include 'header.php'; 
    require 'functions.php';
?>
<div class="container">	
    <div class='page-header pagetitle col-sm-10 col-sm-offset-1'> ادخال الحـــصر</div>
    
    <div class="timesheet-container">
       
        <form class="navbar-form " role="search" id="timesheetinsertion" method="POST" action="fetch.php">
            <div class="form-group">
                <label for="searchDateFrom">تاريخ الحصر:</label>
                <input class="form-control"  name="searchDateFrom" id="searchDateFrom" type="date">
                <label for = "search">رقم القيد / الاسم :</label>
                <input class="form-control" placeholder="ابحث.." name="search" id="search" type="text">  
            </div>
            <div class=" table table-responsive ">
                <!-- </form>
                <form class="form-group row" id=timesheetinsertionForm method="POST" action="fetch.php"> -->
                
                <table id="timesheet" class="table table-striped table-bordered ">
                    <thead>
                        <tr>
                            <th>رقم القيد</th>
                            <th>الاسم</th>
                            <th>الحضـور</th>
                            <th>الانقطاع</th>
                            <th>عارضة</th>
                            <th>مرضى</th>
                            <th>بالخصم</th>
                            <th>السنوى</th>
                            <th>التصنيع</th>
                            <th>تقييم الاداء</th>
                            <th>وردية</th>
                            <th>نوباتجية</th>
                            <th>ملاحظات</th>

                        </tr>
                    </thead>
                    <tbody id="timesheetbody">
                    </tbody>
                </table>
                <div>
                    <input type="submit" name="insertTimesheet" value="إدخـــــــال" class="btn btn-primary col-sm-2 col-sm-offset-5 insertTimesheet">    
                </div>
            </div>
        </form>
        
    </div>
</div>
	<?php include 'footer.php'; ?>
