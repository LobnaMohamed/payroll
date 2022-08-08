<?php
    // timesheet file
    // session_start();
    // if(isset($_SESSION['navigationDate'])){
	// 	echo "Welcome" . $_SESSION['navigationDate'];
	// 	//exit();
	// }else{
    //     echo "no";
    // }


session_start();
if(isset($_POST['navigationDate']) && isset($_POST['timesheetinsertBtn'])){
    $_SESSION['navigationDate'] = $_POST['navigationDate'];
    //echo "yes";
    if(isset($_POST['timesheetinsertBtn'])){
        header('Location: timesheetinsertion.php');//redirect
    }
    elseif(isset($_POST['shiftinsertBtn'])){
        header('Location: shiftinsertion.php');//redirect
    } 
    elseif(isset($_POST['overnightinsertBtn'])){
        header('Location: overnightinsertion.php');//redirect
    }
    elseif(isset($_POST['timesheetRevisionBtn'])){
        header('Location: timesheet.php');//redirect
    }
    elseif(isset($_POST['sickleavesinsertBtn'])){
        header('Location: sickleavesinsertion.php');//redirect
    }
}else{
    echo "fail";
}

include 'header.php';
     
     
?>
<div class="container">

	<div class="page-header text-center">
        <h1>deductions 24th</h1>
    </div>
    <form  method="POST" action ="<?php echo $_SERVER['PHP_SELF'] ?>" id="navigation">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <div class="input-group">
                    <span class="input-group-addon">التاريخ</span>
                    <input type="date" class="form-control" id="navigationDate" name="navigationDate">
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        <div class= "row">
            <div class="col-sm-2">
                <label ></label>
                <button type="submit" name ="timesheetinsertBtn" class="btn btn-default form-control">
                <a href="timesheetinsertion.php">ادخال الحــصر </a>
                    
                </button>
            </div>
            <div class="col-sm-2">
                <label ></label>
                <button  type="submit" name ="shiftinsertBtn"  class="btn btn-default form-control">
                    <a href="shiftinsertion.php">ادخال الوردية </a>
                </button>
            </div>
            <div class="col-sm-2">
                <label ></label>
                <button type="submit" name ="overnightinsertBtn" class="btn btn-default form-control">
                    <a href="overnightinsertion.php">ادخال النوباتجية </a>
                </button>
            </div>
            <div class="col-sm-2">
                <label ></label>
                <button type="submit" name ="sickleavesinsertBtn" class="btn btn-default form-control">
                    <a href="sickleavesinsertion.php">ادخال المرضى </a>
                </button>
            </div>
            <div class="col-sm-2">
                <label ></label>
                <button type="submit" name ="timesheetRevisionBtn"class="btn btn-default form-control">
                    <a href="timesheet.php">مراجعة الحـــصر</a>
                </button>
            </div>
        </div>
       
        <div class= "row">
            <div class="col-sm-2">
                <label ></label>
                <button type="button" class="btn btn-default form-control">
                <a href="timesheetinsertion.php">ادخال  جميع الاستقطاعات </a>
                </button>
            </div>
            <div class="col-sm-2">
                <label ></label>
                <button type="button" class="btn btn-default form-control">
                    <a href="shiftinsertion.php">ادخال استقطاع  </a>
                </button>
            </div>
            <div class="col-sm-2">
                <label ></label>
                <button type="button" class="btn btn-default form-control">
                    <a href="overnightinsertion.php">مراجعة الاستقطاعات</a>
                </button>
            </div>
        </div>
        <div class= "row">
            <div class="col-sm-2">
                <label ></label>
                <button type="button" class="btn btn-default form-control">
                <a href="timesheetinsertion.php">ادخال الاستحقاقات </a>
                </button>
            </div>
            <div class="col-sm-2">
                <label ></label>
                <button type="button" class="btn btn-default form-control">
                    <a href="shiftinsertion.php"> مراجعةالاستحقاقات</a>
                </button>
            </div>
        </div>
       

    </form>
</div>
	<?php include 'footer.php';?>
