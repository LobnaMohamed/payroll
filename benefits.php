<?php 
	include 'header.php';
	include 'functions.php';
?>
	<div class="container">
		
		<div class='page-header pagetitle col-sm-10 col-sm-offset-1'>ادخال الاستحقاقات</div>
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
			
	    	<table id="benefits" class="table table-striped table-bordered table-responsive">		
				<thead>
					<tr>
						<th>رقم القيد</th>
                        <th>الاسم</th>
						
                        <th>استحقاق</th>
                    
						<th>علاوات خاصة</th>
				    </tr>		
				</thead>
				<tbody id="benefitsbody">

				</tbody>
			</table>
			<div>
				<input type="submit" name="updatebenefits" value="إدخـــــــال" class="btn btn-primary col-sm-2 col-sm-offset-5">
			</div>			
		 </form>		
	</div> 
	<?php	include 'footer.php'; ?>