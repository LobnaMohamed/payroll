<?php 
    include 'header.php'; 
    require 'functions.php';
?>

<div class="container">	
    <div class='page-header pagetitle col-sm-10 col-sm-offset-1'>الوظائـــف</div>
    <div class="syndicate-container row">
    
			<?php getsyndicate(); ?>
		
    </div>  
    <!-- add modal -->
    <div id="addsyndicateModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body row">
                    <form method="POST" id="addsyndicateForm" action="insert.php">	
                        <div class="form-group col-md-12 ">
                            <label for= "syndicate">الوظيفة:</label>
                            <input type="text" class="form-control" id="syndicate" name="syndicate">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" name="insertsyndicate" class="btn btn-block btn-lg" value="حفظ">
                        </div>	
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editsyndicateModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body row">
                    <form method="POST" id="editsyndicateForm" action="insert.php">	
                        <div class="form-group col-md-12">
                            <input type="hidden" name="syndicate_id" id="syndicate_id"> 
                            <label for= "syndicateEdit">الوظيفة:</label>
                            <input type="text" class="form-control" id="syndicateEdit" name="syndicateEdit">
                            
                        </div>

                        <div class="form-group col-md-12">
                            <input type="submit" name="updatesyndicate" class="btn btn-block btn-lg" value="حفظ">
                        </div>	
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
	<?php include 'footer.php'; ?>
