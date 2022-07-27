<?php
    include 'header.php';
    require 'functions.php';
    require 'empFunctions.php';
    require 'timesheetFunctions.php';
    require 'mainDataFunctions.php';
    require 'salaryFunctions.php';
?>
<div class="container">	
    <div class='page-header pagetitle col-sm-10 col-sm-offset-1'>انواع الاستقطاع</div>
    <div class="deductionType-container row"><?php getDeductionTypes(); ?></div> 
    
    <!-- add modal -->
    <div id="adddeductionTypeModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body row">
                <form method="POST" id="adddeductionTypeForm" action="insert.php">
                    <div class="form-group col-md-6 ">
                        <label for= "deductionCategory">تصنيف الاستقطاع:</label>
                        <select class="form-control" id="deductionCategory" name="deductionCategory">
                        <?php  
                            echo"<option selected value=1>استقطاع من رصيد</option>";	
                            echo"<option  value=2>استقطاع</option>"; 
						?>
                        </select>
                    </div>	
                    <div class="form-group col-md-6 ">
                        <label for= "deductionType">الاستقطاع:</label>
                        <input type="text" class="form-control" id="deductionType" name="deductionType">
                    </div>
                    <div class="form-group col-md-12">
                        <input type="submit" name="insertdeductionType" class="btn btn-block btn-lg" value="حفظ">
                    </div>	
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- Edit Modal -->
    <div id="editdeductionTypeModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body row">
                    <form method="POST" id="editdeductionTypeForm" action="fetch.php">	
                        <div class="form-group col-md-6">
                            
                            <label for= "deductionTypeAmountEdit">تصنيف الاستقطاع:</label>
                            <input type="text" class="form-control" id="deductionTypeAmountEdit" name="deductionTypeAmountEdit"> 
                       
                        </div>
                        <div class="form-group col-md-6">
                            <input type="hidden" name="deductionType_id" id="deductionType_id"> 
                            <label for= "deductionTypeEdit">الاستقطاع:</label>
                            <input type="text" class="form-control" id="deductionTypeEdit" name="deductionTypeEdit"> 
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" name="updatedeductionType" class="btn btn-block btn-lg" value="حفظ">
                        </div>	
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
