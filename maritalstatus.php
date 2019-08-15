<?php 
    // session_start();
    // if (isset($_SESSION['Username'])) {
    //     //echo "Welcome" . $_SESSION['Username'];
    // } else {
    //     header('Location: index.php');//redirect
    //     exit();
    // }
    include 'header.php';
    require 'functions.php';
?>
	<div class="container">
		<div class='page-header pagetitle col-sm-10 col-sm-offset-1'>الحـــالة الاجتماعية</div>
		<div class="MaritalStatus-container row">
			<?php get_marital_status(); ?>
		</div>
		<!-- add Modal -->
		<div id="addMaritalStatusModal" class="modal fade" role="dialog">
			<div class="modal-dialog modal-md">
				<!-- Modal content-->
				<div class="modal-content ">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body row">
						<form method="POST" id="addMaritalStatusForm" action="insert.php">
                            <div class="form-group col-md-4">
                                <label for= "medInsurance">علاج أسر :</label>
                                <input type="text" class="form-control" id="medInsurance" name="medInsurance">
                            </div>	
                            <div class="form-group col-md-4 ">
                                <label for= "amount">م.إجتماعية :</label>
                                <input type="text" class="form-control" id="amount" name="amount">
                            </div>
							<div class="form-group col-md-4">
								<label for= "MaritalStatus"> الحالة الاجتماعية:</label>
								<input type="text" class="form-control" id="MaritalStatus" name="MaritalStatus">
							</div>
							<div class="form-group col-md-12">
								<input type="submit" name="insertMaritalStatus" class="btn btn-block btn-lg" value="حفظ">
							</div>	
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- Edit Modal -->
		<div id="editMaritalStatusModal" class="modal fade" role="dialog">
			<div class="modal-dialog modal-md">
				<!-- Modal content-->
				<div class="modal-content ">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body row">
						<form method="POST" id="editMaritalStatusForm" action="fetch.php">	
                            <div class="form-group col-md-4">
                                <label for= "medInsuranceEdit">علاج أسر :</label>
                                <input type="text" class="form-control" id="medInsuranceEdit" name="medInsuranceEdit">
                            </div>
                            <div class="form-group col-md-4">
                                <label for= "amountEdit">م.إجتماعية :</label>
                                <input type="text" class="form-control" id="amountEdit" name="amountEdit">
                            </div>
							<div class="form-group col-md-4">
							    <input type="hidden" name="MaritalStatus_id" id="MaritalStatus_id"> 
								<label for= "MaritalStatusEdit"> الحالة الاجتماعية:</label>
								<input type="text" class="form-control" id="MaritalStatusEdit" name="MaritalStatusEdit">
							</div>
							<div class="form-group col-md-12">
								<input type="submit" name="updateMaritalStatus" class="btn btn-block btn-lg" value="حفظ">
							</div>	
						</form>
					</div>
				</div>
			</div>
		</div>				
	</div>			
	<?php include 'footer.php'; ?>