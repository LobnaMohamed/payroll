<?php 
    include 'header.php'; 
    require 'functions.php';
?>

<div class="container">	
    <div class='page-header pagetitle col-sm-10 col-sm-offset-1'>المستـــــوى</div>
    <div class="levels-container row">
    
			<?php getLevel(); ?>
		
    </div>  
    <!-- add modal -->
    <div id="addLevelModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body row">
                    <form method="POST" id="addLevelForm" action="insert.php">
                        <div class="form-group col-md-6">
                            <label for= "hafezpercent">الحافز :</label>
                            <input type="text" class="form-control" id="hafezpercent" name="hafezpercent">
                        </div>	
                        <div class="form-group col-md-6 ">
                            <label for= "level">المستوى</label>
                            <input type="text" class="form-control" id="level" name="level">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" name="insertLevel" class="btn btn-block btn-lg" value="حفظ">
                        </div>	
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editLevelModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body row">
                    <form method="POST" id="editLevelForm" action="insert.php">	
                        <div class="form-group col-md-6">
                            <label for= "hafezpercentEdit">الحافز :</label>
                            <input  class="form-control" id="hafezpercentEdit" name="hafezpercentEdit">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="hidden" name="level_id" id="level_id"> 
                            <label for= "levelEdit">المستوى :</label>
                            <input type="text" class="form-control" id="levelEdit" name="levelEdit">
                            
                        </div>

                        <div class="form-group col-md-12">
                            <input type="submit" name="updateLevel" class="btn btn-block btn-lg" value="حفظ">
                        </div>	
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
	<?php include 'footer.php'; ?>
