<?php 
    include 'header.php'; 
    require 'functions.php';
?>

<div class="container">	
    <div class='page-header pagetitle col-sm-10 col-sm-offset-1'>انواع الاستقطاع من الرصيد</div>
    <div class="syndicate-container row">
    
			<?php getDeductionTypes(); ?>
		
    </div>  


</div>
	<?php include 'footer.php'; ?>
