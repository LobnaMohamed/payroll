<?php 
	include 'header.php';
	include 'functions.php';
?>
	<div class="container">
		<form class="navbar-form row" role="search" id="searchEmp" method="POST" action="searchAjax.php">
			<div class="form-group add-on ">
                <label for = "searchDateFrom">التاريخ :</label>
                <input class="form-control" name="searchDateFrom" id="searchDateFrom" type="date" />
				<label for = "search">رقم القيد:</label>
				<input class="form-control" placeholder=" ابحث رقم قيد" name="search" id="search" type="text"> 
                <label for = "searchTo"> إلى:</label>
                <input class="form-control" placeholder="الى رقم قيد" name="searchTo" id="searchTo" type="text"> 
			</div> 			
		</form>

		<!-- form to show pending vacations and confirm them -->
	    <form class="form-horizontal row" method="POST" action=""> 
	    	<table id="empData" class="table table-striped table-bordered table-responsive">		
				<thead>
					<tr>
						<th>رقم القيد</th>
                        <th>الاسم</th>
						<th>التاريخ</th>                        
                        <th>إستقطاع أخر</th>
						<th> موبايل</th>
						<th>اتصالات انترنت</th>
						<th>كارت بريميوم</th>
                        
				    </tr>		
				</thead>
				<tbody id="Deductionsbody">
					<td></td>
                    <td></td>
					<td></td>  
					<td>
						<input type='number' class='form-control' name='otherDeductionText' >
					</td>  
					<td>
						<input type='number' class='form-control' name='mobilText' >
					</td>
					<td>
						<input type='number' class='form-control' name='etisalatNetText' >
					</td>
					<td>
						<input type='number' class='form-control' name='perimiumCardText' >
					</td>
				</tbody>
			</table>
			<div>
				<input type="submit" name="updateOtherDeduction" value="إعتمــــاد" class="btn btn-success col-sm-2 col-sm-offset-5">
			</div>			
		 </form>		
	</div> 
	<?php	include 'footer.php'; ?>