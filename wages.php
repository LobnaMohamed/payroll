<?php include 'header.php'; 
      include 'functions.php';
?>
<div class="container">
    <header class="row text-center">
        <div class='page-header pagetitle col-sm-10 col-sm-offset-1'>مرتب 24</div>  
            <!-- <input class="form-control" name="salaryDescription" id="salaryDescription" type="text">  -->
    </header>	  
    <form class="navbar-form row" id="searchEmp"  method="POST">
        <div class="form-group add-on ">
            <label for = "search">رقم القيد :</label>
            <input class="form-control" placeholder="ابحث.." name="search" id="search" type="text">
            <label for = "searchDateFrom">التاريخ :</label>
            <input class="form-control" name="searchDateFrom" id="searchDateFrom" type="date" />

            <!-- <input class="btn btn-primary form-control" type="submit" name="calculateSalary24" value="calculate salary" /> -->
        </div>
    </form>
    <hr>
    <table id="empData" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>رقم القيد</th>
                <th>الاسم</th>
                <th>إجمالى الاستحقاقات</th>
                <th>إجمالى الاستقطاعات</th>
                <th>الصافى</th>
                <th>التفاصيل</th>
            </tr>
        </thead>
        <tbody id="wagesDatabody">
        </tbody>
    </table>
        <!-- view data modal -->
    <div id="WagesDetailsModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <!-- Modal content-->
            <div class="modal-content ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <!-- <h5 class="modal-title pagetitle text-center">المرتب 24 </h5> -->
                </div>
                <div class="modal-body row WagesDetailsModalbody ">
                    <!-- <input type="hidden" name="employee_id" id="employee_id">   -->
                    <!-- <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="salarymail.php" allowfullscreen></iframe>
                    </div> -->
                   
                </div>
            </div>
        </div>
    </div>
</div>
	<?php include 'footer.php'; ?>
