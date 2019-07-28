<?php 
	include 'header.php';
	include 'functions.php';
?>
	<div class="container">
		
		<div class='page-header pagetitle col-sm-10 col-sm-offset-1'>الاستقطاعات</div>
		<form class="navbar-form row"  id="familyinsurance_insertion" method="POST" action="fetch.php">
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
	    <form class="form-horizontal row" id=updatefamilyinsurance_Form method="POST" >  -->
			
	    	<table id="familyinsurance" class="table table-striped table-bordered table-responsive">		
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
				<tbody id="familyinsurance_sbody">

				</tbody>
			</table>
			<div>
				<input type="submit" name="updatefamilyinsurance_s" value="إدخـــــــال" class="btn btn-info col-sm-2 col-sm-offset-5">
			</div>			
		 </form>		
	</div> 
	<?php	include 'footer.php'; ?>