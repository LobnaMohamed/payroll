<?php
include 'header.php';
?>
<div class="container">
    <!-- <header class="row text-center">
		<img class= "logo col-sm-1" src="images/amoc2.png">
  	    <h1 class="col-sm-4 col-sm-offset-2 ">نموذج الاجـــــازة</h1>
    </header> -->
	<div class="page-header text-center">
        <h1>salary 24th</h1>
    </div>
    <form  method="POST" action="add.php" id="navigation">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <div class="input-group">
                    <span class="input-group-addon">التاريخ</span>
                    <input type="date" class="form-control" id="navigationDate" name="navigationDate">
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->

        <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default">Left</button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default">Middle</button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default">Right</button>
            </div>
        </div>

        <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default">Left</button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default">Middle</button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default">Right</button>
            </div>
            </div>

    </form>
</div>
	<?php include 'footer.php';?>
