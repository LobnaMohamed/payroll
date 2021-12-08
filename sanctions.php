<?php 
	include 'header.php';
	include 'functions.php';
	include 'empFunctions.php';
	include 'timesheetFunctions.php';
	include 'mainDataFunctions.php';
	include 'salaryFunctions.php';
?>
	<div class="container">
		
		<div class='page-header pagetitle col-sm-10 col-sm-offset-1'>الجزاءات</div>
		<form class="navbar-form row"  id="sanctionsinsertion" method="POST" action="fetch.php">
			<div class="form-group add-on ">
				<label for = "searchDateFrom">التاريخ :</label>
				<input class="form-control" name="searchDateFrom" id="searchDateFrom" type="date" />
				<label for = "search">رقم القيد:</label>
				<input class="form-control" placeholder=" ابحث رقم قيد" name="search" id="search" type="text"> 
                <label for = "searchTo"> إلى:</label>
                <input class="form-control" placeholder="الى رقم قيد" name="searchTo" id="searchTo" type="text"> 
			</div> 			
				
	    	<table id="sanctions" class="table table-striped table-bordered table-responsive">		
				<thead>
					<tr>
						<th>رقم القيد</th>
                        <th>الاسم</th>
						<!-- <th>التاريخ</th>   -->
                        <th>المرتب الاساسى</th>  						
                        <th>أيام جزاءات</th>         
                        <th>قيمة الجزاءات</th>
						<th>ملاحظات</th>
                        <!-- <th>تعديل</th>	 -->
                        <!-- <th>حذف</th>	 -->
				    </tr>		
				</thead>
				<tbody id="sanctionsbody">

				</tbody>
			</table>
			<div>
				<input type="submit" name="updatesanctions" value="إدخـــــــال" class="btn btn-primary col-sm-2 col-sm-offset-5">
			</div>			
		</form>		
	</div> 
	<?php	include 'footer.php'; ?>