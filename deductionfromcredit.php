<?php 
	include 'header.php';
	include 'functions.php';
?>
	<div class="container">
		
		<div class='page-header pagetitle col-sm-10 col-sm-offset-1'>الاستقطاعات من الرصيد </div>
		<form class="navbar-form row"  id="deductionFromCreditinsertion" method="POST" action="fetch.php">
			<div class="form-group add-on ">

				<label for = "deductionFromCreditDate">التاريخ :</label>
                <input class="form-control" name="deductionFromCreditDate" id="deductionFromCreditDate" type="date" />
				<label for = "searchEmp">رقم القيد:</label>
				<input class="form-control" placeholder=" ابحث رقم قيد" name="searchEmp" id="searchEmp" type="text"> 
                <label for = "deductionFromCreditType">نوع الاستقطاع :</label>
                <select class="form-control">
                    <?php  getDeductionTypes() ; ?>
                </select>
			</div> 			
		</form>

			<div class= "table-responsive">
                <table id="Deductionfromcredit" class="table table-striped table-bordered  table-condensed ">		
                    <thead>
                        <tr>
                            <th>رقم القيد</th>
                            <th>الاسم</th>
                            <th>تــاريخ تسجيل الاستقطاع</th> 
                            <th>نوع الاستقطاع</th>
                            <th>المبلغ</th>
                            <!-- <th>القسط</th>
                            <th>المتبقى </th>  -->
                            <th>ينتهى فى</th>
                            <th>تعديل</th> 
                            
                        </tr>		
                    </thead>
                    <tbody id="Deductionfromcreditbody">
                        <?php getCreditDeductions(); ?>
                    </tbody>
                </table>
			</div>		
	</div> 
	<?php	include 'footer.php'; ?>