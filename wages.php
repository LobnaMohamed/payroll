<?php include 'header.php'; ?>

<div class="container">
    <header class="row text-center">
        <div class='page-header pagetitle col-sm-10 col-sm-offset-1'>مرتب 24</div>   
    </header>	  
    <form class="navbar-form row" id="Salary" method="POST" action="fetch.php">
        <div class="form-group add-on col-md-10">
            <label for = "search">رقم القيد / الاسم :</label>
            <!-- <input class="form-control" placeholder="ابحث.." name="search" id="search" type="text"> -->
            <div class="input-group-btn">
                <button class="btn btn-primary" type="submit">calculate salary</button>
            </div>
        </div>
    </form>
    <form  method="POST" action="#" >
        <div class="form-group  row">
            <div class="col-md-3">
                <label for="empname" >الاســـــم</label>
	    		<input type="text" class="form-control" id="empname" name="empname" >
            </div>
            <div class="col-md-1">
                <label for="empcode">رقم القيد</label>
		    	<input type="number" class="form-control" id="empcode" name="empcode">
		    	<input hidden type="text" id="empID" name="empID"/>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-2">
                <label for="empmainSalary" >المرتب الأساسى</label>
	    		<input type="number" class="form-control" id="empmainSalary" name="empmainSalary" >
            </div>
        </div>
    </form>
    <table id="empData" class="table table-striped table-bordered">
            <thead >
                <tr>
                    <th>رقم القيد</th>
                    <th>الاسم</th>
                    <th colspan=3><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addEmpModal"><i class='fa fa-plus-circle'></button></th>
                
                </tr>
            </thead>
        <tbody id="empDatabody">
            <?php getAllEmp(); ?>
        </tbody>
    </table>
</div>
	<?php include 'footer.php'; ?>
