<?php include 'header.php'; 
      include 'functions.php';
?>
<div class="container">
    <header class="row text-center">
        <div class='page-header pagetitle col-sm-10 col-sm-offset-1'>مرتب 24</div>   
    </header>	  
    <form class="navbar-form row" id="SalaryCalculation" method="POST">
        <div class="form-group add-on ">
            <label for = "search">رقم القيد :</label>
            <input class="form-control" placeholder="ابحث.." name="search" id="search" type="text">
            <label for = "searchDateFrom">التاريخ :</label>
            <input class="form-control" name="searchDateFrom" id="searchDateFrom" type="date" value=<?php echo date("Y-m-24",strtotime("first day of last month")); ?>>
            <button class="btn btn-primary" type="submit" name="calculateSalary24">calculate salary</button>
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
            <?php getWagesTotals(); ?>
        </tbody>
    </table>
</div>
	<?php include 'footer.php'; ?>
