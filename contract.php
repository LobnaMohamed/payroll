<?php 
    include 'header.php'; 
    require 'functions.php';
?>

<div class="container">	
    <div class='page-header pagetitle col-sm-10 col-sm-offset-1'>أنــــواع العقد </div>
    <div class="contracts-container row">
    
			<?php getContract(); ?>
		
    </div>  
    <!-- add modal -->
    <div id="addcontractModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body row">
                    <form method="POST" id="addcontractForm" action="insert.php">	
                        <div class="form-group col-md-12 ">
                            <label for= "contract">نوع العقد:</label>
                            <input type="text" class="form-control" id="contract" name="contract">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" name="insertcontract" class="btn btn-block btn-lg" value="حفظ">
                        </div>	
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editcontractModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body row">
                    <form method="POST" id="editcontractForm" action="fetch.php">	
                        <div class="form-group col-md-12">
                            <input type="hidden" name="contract_id" id="contract_id"> 
                            <label for= "contractEdit">نوع العقد:</label>
                            <input type="text" class="form-control" id="contractEdit" name="contractEdit">
                            
                        </div>

                        <div class="form-group col-md-12">
                            <input type="submit" name="updatecontract" class="btn btn-block btn-lg" value="حفظ">
                        </div>	
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
	<?php include 'footer.php'; ?>
