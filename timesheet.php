<?php 
    include 'header.php'; 
    require 'functions.php';
?>
<div class="container">	
    <div class='page-header pagetitle col-sm-10 col-sm-offset-1'>الحـــصر</div>
    <!-- <div class='page-header pagetitle col-sm-10 col-sm-offset-1'>الحـــصر</div> -->
    <form class="navbar-form row" role="search" id="searchEmp" method="POST">
        <div class="form-group add-on">
            <label for="timesheetDate">تاريخ الحصر:</label>
            <input class="form-control"  name="timesheetDate" id="timesheetDate" type="date">
            <label for = "search">رقم القيد / الاسم :</label>
            <input class="form-control" placeholder="ابحث.." name="search" id="search" type="text">  
        </div>
    </form>
    <table id="timesheet" class="table table-striped table-bordered table-responsive">
        <thead >
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
                <th>وردية</th>
                <th>نوباتجية</th>
                <th>ملاحظات</th>
                <!-- <th>تعديل</th> -->
            </tr>
        </thead>
        <tbody id="timesheetbody">
            <?php // getTimesheet(); ?>
        </tbody>
    </table>


</div>
	<?php include 'footer.php'; ?>
