<?php 
	include 'header.php';
	include 'functions.php';
?>
	<div class="container">
		
		<div class='page-header pagetitle col-sm-10 col-sm-offset-1'>تسجيل استقطاع من رصيد </div>
		
		<form class="navbar-form row"  id="deductionFromCreditinsertion" method="POST" action="fetch.php">
			<div class="form-group add-on ">

				<label for = "getEmpForDed">رقم القيد:</label>
				<select class="form-control" name="getEmpForDed" id="getEmpForDed">
					<?php getEmpDropDown(); ?>
				</select>
			</div>
				<hr>
                <?php  deductionItems(); ?>
				<!-- <hr> -->
			
			<!-- <div class = "row "> -->
				<div class="col-sm-12 ">
					<button class ="btn btn-primary btn-lg col-sm-2 col-sm-offset-5 " 
					type="Submit" name="submitDedFromCredit" >حـــــفظ<i class="fa fa-save fa-fw save-icon"></i></button>			
				</div>	

		</form>

	</div> 
	<?php	include 'footer.php'; ?>