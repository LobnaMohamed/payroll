<?php include 'header.php'; 
      include 'functions.php';
?>

<div class="container">
    <header class="row text-center">
        <div class='page-header pagetitle col-sm-10 col-sm-offset-1'>مرتب 24</div>   
    </header>	  
    <form class="navbar-form row" id="Salary" method="GET">
        <div class="form-group add-on ">
            <label for = "searchEmp">رقم القيد / الاسم :</label>
            <input class="form-control" placeholder="ابحث.." name="searchEmp" id="searchEmp" type="text">
            <label for = "searchDateFrom">التاريخ :</label>
            <input class="form-control" name="searchDateFrom" id="searchDateFrom" type="date">
            <!-- <div class="input-group-btn">
                <button class="btn btn-primary" type="submit">calculate salary</button>
            </div> -->
        </div>
    </form>
    <table id="empData" class="table table-striped table-bordered">
            <thead >
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
            <?php getWagesTotals(); ?>
        </tbody>
    </table>
</div>
	<?php include 'footer.php'; ?>
