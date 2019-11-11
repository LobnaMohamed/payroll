<?php 
    include 'header.php'; 
    require 'functions.php';
?>
<div class="container">	
    <div class='page-header pagetitle col-sm-10 col-sm-offset-1'>الحـــصر</div>
    <!-- <div class='page-header pagetitle col-sm-10 col-sm-offset-1'>الحـــصر</div> -->
    <form class="navbar-form row" role="search" id="searchEmp" method="POST">
        <div class="form-group add-on">
            <label for="searchDateFrom">تاريخ الحصر:</label>
            <input class="form-control"  name="searchDateFrom" id="searchDateFrom" type="date">
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
                <th>تقييم الأداء</th>

                <th>وردية</th>
                <th>نوباتجية</th>
                <th>ملاحظات</th>
                <th>تعديل</th>
            </tr>
        </thead>
        <tbody id="timesheetbody">
        </tbody>
    </table>
    <!-- Edit Modal -->
    <div id="edittimsesheetModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title text-center"> تعديل أيام الحضور :</h2>
                </div>


                <div class="modal-body row">
                    <form method="POST" id="editTimesheetForm" name="editTimesheetForm" action = "fetch.php">
                        <div class="form-group  col-md-12"> 
                            <label  for= "emp_currentCode" > رقم القيد</label>
                            <input class="form-control-plaintext" id="emp_currentCode" disabled>
                            <label for= "empName"> الاســم</label>
                            <input id="empName" disabled>
                            <label for= "sheetDate"> تاريخ الحصر</label>
                            <input id="sheetDate" disabled>
                        </div>
                        
                        <div class="form-group col-md-4"> 
                            <label for= "deductionDaysEdit"> الخصم</label>
                            <input class="form-control" id="deductionDaysEdit" name="deductionDaysEdit">
                            <label for= "absenceDaysEdit"> الانقطاع</label>
                            <input class="form-control" id="absenceDaysEdit" name="absenceDaysEdit">
                            <label for= "sickLeaveDaysEdit"> مرضى</label>
                            <input class="form-control" id="sickLeaveDaysEdit" name="sickLeaveDaysEdit">
                        </div>	
                        <div class="form-group col-md-4">
                            <input class="form-control" type="hidden" id="sheetID" name="sheetID" >
                        
                            <label for= "manufacturingDaysEdit"> التصنيع</label>
                            <input class="form-control" id="manufacturingDaysEdit" name="manufacturingDaysEdit">
                            <label for= "overnightDaysEdit"> ايام نوباتجية</label>
                            <input class="form-control" id="overnightDaysEdit" name="overnightDaysEdit">
                            <label for= "shiftDaysEdit"> ايام الوردية</label>
                            <input class="form-control" id="shiftDaysEdit" name="shiftDaysEdit">
                        </div>
                        <div class="form-group col-md-4">
                            <input class="form-control" type="hidden" id="emp_id" name="emp_id" >
                            <label for= "presenceDaysEdit"> الحضـور</label>
                            <input class="form-control" id="presenceDaysEdit" name="presenceDaysEdit" type="number">
                            <label for= "annualDaysEdit">سنوى</label>
                            <input class="form-control" id="annualDaysEdit" name="annualDaysEdit">
                            <label for= "casualDaysEdit"> عارضة</label>
                            <input class="form-control" id="casualDaysEdit" name="casualDaysEdit">
                            <label for= "evaluationEdit"> تقييم الاداء</label>
                            <input class="form-control" id="evaluationEdit" name="evaluationEdit">
                        </div>
                        <div  class="form-group col-md-12 ">
                            <label for= "notesEdit"> ملاحظات</label>
                            <input class="form-control" id="notesEdit" name="notesEdit">
                            
                        </div>  
                        <div class="form-group col-md-3 col-md-offset-4 ">
                            <input type="submit" name="UpdateTimesheet" class="btn btn-success" id ="UpdateTimesheet"  value="حفـــــظ" >
                        </div>
                    </form>
                </div>
                <div class="modal-footer">	
                </div>
            </div>
        </div>
    </div>

</div>
	<?php include 'footer.php'; ?>
