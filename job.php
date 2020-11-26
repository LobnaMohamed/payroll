<?php 
    include 'header.php'; 
    require 'functions.php';
?>

<div class="container">	
    <div class='page-header pagetitle col-sm-10 col-sm-offset-1'>الوظائـــف</div>
    <div class="job-container row">
        <table id="jobData" class="table table-striped table-bordered">
            <thead >
                <tr>
                    <th>االوظيفة </th>
                    <th>بدل خبرة</th>
                    <th>بدل التخصص</th>
                    <th>بدل التمثيل</th>
                    <th><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addjobModal">
                        <i class='fa fa-plus-circle'></button></th>
                </tr>
            </thead>
            <tbody id="jobbody">
                <?php getJob(); ?>
            </tbody>
        </table>
			<?php //getJob(); ?>
		
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
                        <div class="form-group col-md-6 ">
                            <label for= "addlevel">المستوى</label>
								<select class="form-control" id="addlevel" name="addlevel" required >
									<option selected disabled hidden style='display: none' value=''></option>
										<?php  	getLevel();   ?>
								</select>
                        </div>	
                        <div class="form-group col-md-6 ">
                            <label for= "job">الوظيفة:</label>
                            <input type="text" class="form-control" id="job" name="job">
                        </div>

                        <div class="form-group col-md-4">
                            <label for= "representationAdd">بدل التمثيل:</label>
                            <input  class="form-control" id="representationAdd" name="representationAdd">
                            
                        </div>
                        <div class="form-group col-md-4">
                            <label for= "experienceAdd">بدل الخبرة:</label>
                            <input  class="form-control" id="experienceAdd" name="experienceAdd">
                        </div>
                        <div class="form-group col-md-4">
                        
                            <label for= "specializationAdd">بدل التخصص:</label>
                            <input  class="form-control" id="specializationAdd" name="specializationAdd"> 
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
                        <div class="form-group col-md-4">
                            <label for= "representationEdit">بدل التمثيل:</label>
                            <input  class="form-control" id="representationEdit" name="representationEdit">
                            
                        </div>
                        <div class="form-group col-md-4">
                            <label for= "experienceEdit">بدل الخبرة:</label>
                            <input  class="form-control" id="experienceEdit" name="experienceEdit">
                        </div>
                        <div class="form-group col-md-4">
                        
                            <label for= "specializationEdit">بدل التخصص:</label>
                            <input  class="form-control" id="specializationEdit" name="specializationEdit"> 
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
