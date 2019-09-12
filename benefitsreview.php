<?php 
require 'functions.php';
include 'header.php';
 //calculatebenefits();
?>
	<div class="container">
		
		<div class='page-header pagetitle col-sm-10 col-sm-offset-1'>مراجعة الاستحقاقات</div>
		<form class="navbar-form row"  id="benefitinsertion" method="POST" action="fetch.php">
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
	    <form class="form-horizontal row" id=updatebenefitsForm method="POST" >  -->
			
	    	<table id="benefits" class="table table-striped table-bordered table-responsive table-condensed ">		
				<thead>
					<tr>
						<th>رقم القيد</th>
                        <th>الاسم</th>
                        <th> أجر الحضور</th>
                        <th>بدل طبيعة</th>
                        <th>بدل تخصص</th>
                        <th>بدل تصنيع</th>
						<th>م.اجتماعية</th>
						<th>تمثيل </th>
						<th> بدل مهنى</th> 
						<th> خبرة</th>
                        <th>علاوات خاصة</th>
                        <th>نوباتجية</th>
                        <th>منحة عيد العمال</th> 
                        <th>وجبات نقدية</th>
                        <th>حافز</th>
                        <th>وردية</th>
                        <th>استحقاق</th>
                        <th>حافز اضافى</th>
 
				    </tr>		
				</thead>
				<tbody id="benefitsbody">

				</tbody>
			</table>
			<div>
				<!-- <input type="submit" name="updatebenefits" value="إدخـــــــال" class="btn btn-info col-sm-2 col-sm-offset-5"> -->
			</div>			
		 </form>		
	</div> 
	<?php	include 'footer.php'; ?>