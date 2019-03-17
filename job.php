<?php 
    include 'header.php'; 
    require 'functions.php';
?>

<div class="container">	
    <div class='page-header pagetitle col-sm-10 col-sm-offset-1'>الوظائـــف</div>
    <div class="jobs-container row">
    
			<?php getJob(); ?>
		
    </div>  
    <!-- add modal -->
    <div id="addjobModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body row">
                    <form method="POST" id="addjobForm" action="insert.php">	
                        <div class="form-group col-md-12 ">
                            <label for= "job">الوظيفة:</label>
                            <input type="text" class="form-control" id="job" name="job">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" name="insertjob" class="btn btn-block btn-lg" value="حفظ">
                        </div>	
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editjobModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body row">
                    <form method="POST" id="editjobForm" action="insert.php">	
                        <div class="form-group col-md-12">
                            <input type="hidden" name="job_id" id="job_id"> 
                            <label for= "jobEdit">الوظيفة:</label>
                            <input type="text" class="form-control" id="jobEdit" name="jobEdit">
                            
                        </div>

                        <div class="form-group col-md-12">
                            <input type="submit" name="updatejob" class="btn btn-block btn-lg" value="حفظ">
                        </div>	
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
	<?php include 'footer.php'; ?>
