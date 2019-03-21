<?php 
    include 'header.php'; 
    require 'functions.php';
?>

<div class="container">	
    <div class='page-header pagetitle col-sm-10 col-sm-offset-1'>الوظائـــف</div>
    <div class="timesheet-container row">
    
			<?php gettimesheet(); ?>
		
    </div>  
    <!-- add modal -->
    <div id="addtimesheetModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body row">
                    <form method="POST" id="addtimesheetForm" action="insert.php">	
                        <div class="form-group col-md-12 ">
                            <label for= "timesheet">الوظيفة:</label>
                            <input type="text" class="form-control" id="timesheet" name="timesheet">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" name="inserttimesheet" class="btn btn-block btn-lg" value="حفظ">
                        </div>	
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="edittimesheetModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body row">
                    <form method="POST" id="edittimesheetForm" action="insert.php">	
                        <div class="form-group col-md-12">
                            <input type="hidden" name="timesheet_id" id="timesheet_id"> 
                            <label for= "timesheetEdit">الوظيفة:</label>
                            <input type="text" class="form-control" id="timesheetEdit" name="timesheetEdit">
                            
                        </div>

                        <div class="form-group col-md-12">
                            <input type="submit" name="updatetimesheet" class="btn btn-block btn-lg" value="حفظ">
                        </div>	
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
	<?php include 'footer.php'; ?>
