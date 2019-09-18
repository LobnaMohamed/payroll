<?php 
	include 'header.php';
	include 'functions.php';
?>
	<div class="container">
		
		<div class='page-header pagetitle col-sm-10 col-sm-offset-1'>ادخال الاستقطاعات</div>
		<form class="navbar-form row"  id="deductioninsertion" method="POST" action="fetch.php">


			<div class="form-group add-on ">
                <!-- <label for = "searchDateFrom">التاريخ :</label>
                <input class="form-control" name="searchDateFrom" id="searchDateFrom" type="date" /> -->
				<label for = "searchDateFrom">التاريخ :</label>
                <input class="form-control" name="searchDateFrom" id="searchDateFrom" type="date" />
				<label for = "search">رقم القيد:</label>
				<input class="form-control" placeholder=" ابحث رقم قيد" name="search" id="search" type="text"> 
                <label for = "searchTo"> إلى:</label>
                <input class="form-control" placeholder="الى رقم قيد" name="searchTo" id="searchTo" type="text"> 
			</div> 			
		<!-- </form>
	    <form class="form-horizontal row" id=updateDeductionsForm method="POST" >  -->
			<div class= " form-row align-items-center">
			<div class="col-auto">
	    	<table id="deductions" class="table table-striped table-bordered table-responsive table-condensed ">		
				<thead>
					<tr>
						<th>رقم القيد</th>
                        <th>الاسم</th>
						<!-- <th>التــاريخ</th>  -->
                        <th>إستقطاع أخر</th>
                        <!-- <th>تأمينات</th> -->
						<th>موبايل</th>
						<th>اتصالات انترنت</th>
						<th>كارت بريميوم</th> 
						<th>مدة سابقة</th> 
				    </tr>		
				</thead>
				<tbody id="Deductionsbody" >
				
					

				</tbody>
			</table>
			</div>
			</div>
			<div>
				<input type="submit" name="updateDeductions" value="إدخـــــــال" class="btn btn-primary col-sm-2 col-sm-offset-5">
			</div>			
		 </form>		
	</div> 
	<?php	include 'footer.php'; ?>