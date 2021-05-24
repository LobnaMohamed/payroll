<?php
    //---------------get timesheet function------------------------
	function getTimesheet(){
		$output="";	
		$con = connect();
		$sql= '';		
		if(!empty($_POST['dateFrom'])){
			//payroll_new database
			// $sql= "select t.*,e.currentCode,e.empName,empt.*
			// 		from timesheets t inner join empTimesheet empt on t.ID = empt.TS_id 
			// 			inner join employee e on empt.emp_id = e.ID
			// 		and month(t.sheetDate)= month('".$_POST['dateFrom']."')
			// 		and year(t.sheetDate)= year('".$_POST['dateFrom']."')";

			$sql=	"select e.currentCode,e.empName, t.*,empt.presence_days,empt.deduction_days,empt.absence_days,empt.annual_days,empt.casual_days,
						empt.emp_id,empt.TS_id,	empt.manufacturing_days,empt.evaluationPercent,	empt.sickLeave_Days ,empsh.shift_days,
						empov.overnight_days,empt.notes as timesheetNotes,empsk.notes as sicknotes,empsh.notes as shiftnotes,empov.notes as ovnotes
					from  timesheets t inner join empTimesheet empt on t.ID = empt.TS_id 
							left join employee e on empt.emp_id = e.ID 
							left join emp_sickleaves empsk on t.ID = empsk.TS_id and empt.emp_id = empsk.emp_id
 							left join emp_shift empsh on t.ID = empsh.TS_id and empt.emp_id = empsh.emp_id
 							left join emp_overnight empov on t.ID = empov.TS_id and empt.emp_id = empov.emp_id
  					where  month(t.sheetDate)= month('".$_POST['dateFrom']."')
				  			and year(t.sheetDate)= year('".$_POST['dateFrom']."')";
		}
		if(!empty($_POST['search'])){
			$sql .= " and (e.currentCode like '%". $_POST['search'] ."%' OR e.empName like '%". $_POST['search'] ."%')";	
		}
		
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		if(! $result ){
			$output = "
			<tr>
			<td colspan='13' class='alert alert-warning'> 
			<strong>لا يوجد حصر أيام الحضور بهذا التاريخ.. لادخال الحصر اضغط هنا</strong><a href='timesheetinsertion.php'>here</a>
			</td></tr>";
			// empty($row['timesheetNotes']) ? '': $row['timesheetNotes'] ."<br>" .
			// 		empty($row['shiftnotes']) ? '' : $row['shiftnotes'] ."<br>" .
			// 		empty($row['ovnotes']) ? '': $row['ovnotes'] ."<br>" .
			// 		empty($row['sicknotes']) ? '' : $row['sicknotes'] ."<br>".
		}else{
			foreach($result as $row){
				//$output .= "<tr><td>".  $row['sheetDate']. "</td></tr>";
				$output .=
				"<tr>
					<td>".  $row['currentCode']. "</td>
					<td>".  $row['empName']. "</td>
					<td>".  $row['presence_days']. "</td>
					<td>".  $row['absence_days']. "</td>
					<td>".  $row['casual_days']. "</td>
					<td>".  $row['sickLeave_Days']. "</td>
					<td>".  $row['deduction_days']. "</td>
					<td>".  $row['annual_days']. "</td>
					<td>".  $row['manufacturing_days']. "</td>
					<td>".  $row['evaluationPercent']. "</td>
					<td>".  $row['shift_days']. "</td>
					<td>".  $row['overnight_days']. "</td>
					<td>".  $row['timesheetNotes'] ."<br>". $row['shiftnotes']."<br>".$row['ovnotes']."<br>". $row['sicknotes']. "</td>
					<td style='display:none;'  class='timesheet_ID'>" .  $row['TS_id']."</td>
					<td><a class='btn btn-sm edittimsesheetData'  id=".$row['emp_id'].">
					<i class='fa fa-edit fa-lg' data-toggle='modal' data-target='#edittimsesheetModal'></i>
					</a></td>
				</tr>";
			}
		}

		echo $output;
	}
	//---------------get insert timesheet function------------------------
	function getinsertTimesheet(){
		$output="";	
		$con = connect();
		$sql= '';		
		// print_r($_POST);
		if(!empty($_POST['dateFrom'])){	
			$sql = "select  e.empName,e.currentCode,e.ID
					from	employee e
					where e.ID not in (select empt.emp_id
										from timesheets t inner join empTimesheet empt on t.ID = empt.TS_id 
										where month(t.sheetDate)= month( '".$_POST['dateFrom']."')
										and year(t.sheetDate)= year('".$_POST['dateFrom']."'))";
		}
		if(!empty($_POST['search'])){
			$sql .= " and (e.currentCode like '%". $_POST['search'] ."%' OR e.empName like '%". $_POST['search'] ."%')";	
		}
		
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		if( $result ){
			foreach($result as $row){
				$empindex = $row['ID'];
				$output .= "<tr>
					<td>".  $row['currentCode']. "</td>
					<td>".  $row['empName']. "</td>
					
					<input name='emp_id' type='hidden' value=".$row['ID'].">
					<td>
						<input class='form-control transparent-input' name='presence_days[".$row['ID']."]' value=30  style='width: 100%'>
					</td> 
					<td>
						<input class='form-control transparent-input' name='sickLeave_days[".$row['ID']."]' value=0 style='width: 100%'>
					</td>  
					<td>
						<input class='form-control transparent-input' name='deduction_days[".$row['ID']."]' value=0 style='width: 100%'>
					</td>
					<td>
						<input class='form-control transparent-input' name='absence_days[".$row['ID']."]' value=0 style='width: 100%'>
					</td> 
					<td>
						<input class='form-control transparent-input' name='annual_days[".$row['ID']."]' value=0 style='width: 100%'>
					</td>
					<td>
						<input class='form-control transparent-input' name='casual_days[".$row['ID']."]' value=0 style='width: 100%'>
					</td>
					<td>
						<input class='form-control transparent-input' name='manufacturing_days[".$row['ID']."]' value=0 style='width: 100%'>
					</td>
					<td>
						<input class='form-control transparent-input' name='evaluationPercent[".$row['ID']."]' value=1 style='width: 100%'>
					</td>
					<td>
						<input class='form-control transparent-input' name='notes[".$row['ID']."]' style='width: 100%'>
					</td>
					     
				</tr>";
			}
			
		}else{
			$output = "
			<tr>
			<td colspan='12' class='alert alert-warning'> 
			<strong><i class='fa fa-exclamation-triangle'></i>
			تم ادخال حصر لهذا الشهر  من قبل..للتعديل اضغط هنا</strong>
			<a href='timesheet.php'>here</a>
			</td></tr>";
		}

		echo $output;
	}

	//---------------get overnight function نوباتجية------------------------
	function getinsertovernightDays(){
		$output="";	
		$con = connect();
		$sql= '';		
		
		if(!empty($_POST['dateFrom'])){	
			$sql = "select  e.empName,e.currentCode,e.ID
					from	employee e
					where e.ID not in (select empt.emp_id
										from timesheets t inner join emp_overnight empt on t.ID = empt.TS_id 
										where month(t.sheetDate)= month( '".$_POST['dateFrom']."')
										and year(t.sheetDate)= year('".$_POST['dateFrom']."'))";
		}
		if(!empty($_POST['search'])){
			$sql .= " and (e.currentCode like '%". $_POST['search'] ."%' OR e.empName like '%". $_POST['search'] ."%')";	
		}
		
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		if( $result ){
			foreach($result as $row){
				$empindex = $row['ID'];
				$output .= "<tr>
					<td>".  $row['currentCode']. "</td>
					<td>".  $row['empName']. "</td>
					
					<input name='emp_id' type='hidden' value=".$row['ID'].">
					<td>
						<input class='form-control' name='overnight_days[".$row['ID']."]' value=0 style='width: 100%'>
					</td>
					<td>
						<input class='form-control' name='overnight_deserveddays[".$row['ID']."]' value=0 style='width: 100%'>
					</td>
					<td>
						<input class='form-control' name='notes[".$row['ID']."]' style='width: 100%'>
					</td>
					     
				</tr>";
			}
			
		}else{
			$output = "
			<tr>
			<td colspan='12' class='alert alert-warning'> 
			<strong><i class='fa fa-exclamation-triangle'></i>
			تم ادخال نوباتجية لهذا الشهر  من قبل..للتعديل اضغط هنا</strong>
			<a href='timesheet.php'>here</a>
			</td></tr>";
		}

		echo $output;
	}
	//---------------get shift function ورادى------------------------
	function getinsertshiftDays(){
		$output="";	
		$con = connect();
		$sql= '';		
		
		if(!empty($_POST['dateFrom'])){	
			$sql = "select  e.empName,e.currentCode,e.ID
					from	employee e
					where e.ID not in (select empt.emp_id
										from timesheets t inner join emp_shift empt on t.ID = empt.TS_id 
										where month(t.sheetDate)= month( '".$_POST['dateFrom']."')
										and year(t.sheetDate)= year('".$_POST['dateFrom']."'))";
		}
		if(!empty($_POST['search'])){
			$sql .= " and (e.currentCode like '%". $_POST['search'] ."%' OR e.empName like '%". $_POST['search'] ."%')";	
		}
		
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		if( $result ){
			foreach($result as $row){
				$empindex = $row['ID'];
				$output .= "<tr>
					<td>".  $row['currentCode']. "</td>
					<td>".  $row['empName']. "</td>
					
					<input name='emp_id' type='hidden' value=".$row['ID'].">
					
					<td>
						<input class='form-control' name='shift_days[".$row['ID']."]' value=0 style='width: 100%'>
					</td>
					<td>
						<input class='form-control' name='cashperday[".$row['ID']."]' value=0 style='width: 100%'>
					</td>
					<td>
						<input class='form-control' name='total[".$row['ID']."]' value=0 style='width: 100%'>
					</td>
					<td>
						<input class='form-control' name='notes[".$row['ID']."]' style='width: 100%'>
					</td>
							
				</tr>";
			}
			
		}else{
			$output = "
			<tr>
			<td colspan='12' class='alert alert-warning'> 
			<strong><i class='fa fa-exclamation-triangle'></i>
			تم ادخال أيام الورادى لهذا الشهر  من قبل..للتعديل اضغط هنا</strong>
			<a href='timesheet.php'>here</a>
			</td></tr>";
		}

		echo $output;
	}
	//---------------get sickleaves function ------------------------
	function getsickLeavesDays(){
		$output="";	
		$con = connect();
		$sql= '';		
		
		if(!empty($_POST['dateFrom'])){	
			$sql = "select  e.empName,e.currentCode,e.ID
					from	employee e
					where e.ID not in (select empt.emp_id
										from timesheets t inner join emp_sickLeaves empt on t.ID = empt.TS_id 
										where month(t.sheetDate)= month( '".$_POST['dateFrom']."')
										and year(t.sheetDate)= year('".$_POST['dateFrom']."'))";
		}
		if(!empty($_POST['search'])){
			$sql .= " and (e.currentCode like '%". $_POST['search'] ."%' OR e.empName like '%". $_POST['search'] ."%')";	
		}
		
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		if( $result ){
			foreach($result as $row){
				// $empindex = $row['ID'];
				$output .= "<tr>
					<td>".  $row['currentCode']. "</td>
					<td>".  $row['empName']. "</td>
					
					<input name='emp_id' type='hidden' value=".$row['ID'].">
					
					<td>
						<input class='form-control' name='sick_leavesDays[".$row['ID']."]' value=0 style='width: 100%'>
					</td>
					<td>
						<input class='form-control' type = 'date' name='startDate[".$row['ID']."]' value=0 style='width: 100%'>
					</td>
					<td>
						<input class='form-control' type = 'date' name='endDate[".$row['ID']."]' value=0 style='width: 100%'>
					</td>
					<td>
						<input class='form-control' type = 'checkbox' name='continious[".$row['ID']."]' style='width: 100%' >
					</td>

				</tr>";
			}
				// 	<td>
				// 	<input class='form-control' name='real_sickLeaves[".$row['ID']."]' value=0 style='width: 100%'>
				// </td>
		}else{
			$output = "
			<tr>
			<td colspan='12' class='alert alert-warning'> 
			<strong><i class='fa fa-exclamation-triangle'></i>
			تم ادخال أيام المرضى لهذا الشهر  من قبل..للتعديل اضغط هنا</strong>
			<a href='timesheet.php'>here</a>
			</td></tr>";
		}

		echo $output;
	}

	//===================insert  timesheet================
	//======================================================
	/*
	This function is to check for the timesheet id and if it doesnt exist it will 
	insert timesheet date and return the inserted id in a variable called lastID
	*/
	function getTimesheetID($con){
		$checkDate_sql = "select distinct ID from timesheets where month(sheetDate) =month('" . $_POST['searchDateFrom'] ."') 
																	and year(sheetDate)= year('".$_POST['searchDateFrom']."')";
		$timesheetDate =$_POST['searchDateFrom'];
		//echo $timesheetDate;
		$stmt = $con->prepare($checkDate_sql);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		if(! $result){
			$timesheetsql = "insert into timesheets(sheetDate) values('$timesheetDate')";
			$stmt = $con->prepare($timesheetsql);
			$stmt->execute();
	
			$getlastTSID_sql = "select max(ID) from timesheets";
			
			$stmt = $con->prepare($getlastTSID_sql);
			$stmt->execute();
			$lastID = $stmt->fetchColumn();
			//echo "last id :" . $lastID;
		}else{
			// if timesheet already exist get its ID and insert for remaining emp the timesheet
			$getlastTSID_sql = "select ID  from timesheets where month(sheetDate) = month( '$timesheetDate')
														and year(sheetDate)= year('".$_POST['searchDateFrom']."') ";
			$stmt = $con->prepare($getlastTSID_sql);
			$stmt->execute();
			$lastID = $stmt->fetchColumn();
			//echo "last id :" . $lastID;


		}
		return $lastID;			
	}
	
	function insertTimesheet(){
		$con = connect();
		$lastID = getTimesheetID($con);
		//---------------timesheet INSERTION---------------------
		//----------------either through file upload---------------
		//----------------or insertion one by one------------------
		//--------first option through insertion one by one-------
		if(isset($_POST["insertTimesheet"])){
			foreach ($_POST['presence_days'] as $empID => $value) {
				$sickLeave = $_POST['sickLeave_days'][$empID];
				$deduction = $_POST['deduction_days'][$empID];
				$absence = $_POST['absence_days'][$empID];
				$annual = $_POST['annual_days'][$empID];
				$casual = $_POST['casual_days'][$empID];
				$manufacturing = $_POST['manufacturing_days'][$empID];
				$evaluation = $_POST['evaluationPercent'][$empID]/100;

				// $overnight = $_POST['overnight_days'][$empID];
				// $shift = $_POST['shift_days'][$empID];
				$notes = $_POST['notes'][$empID];
				// echo "<br>";
				$sql = "insert into empTimesheet(TS_id,emp_id,presence_days,sickLeave_days,deduction_days,absence_days,annual_days,
								casual_days,manufacturing_days,evaluationPercent,notes) 
						values ('$lastID','$empID','$value','$sickLeave','$deduction','$absence','$annual',
								'$casual','$manufacturing',$evaluation,'$notes')";
				$stmt = $con->prepare($sql);
				$stmt->execute();
				//check if ts_id already exists in salary:
				$sql_check = "select TS_id from salary where TS_id =$lastID and emp_id =$empID ";
				$stmt = $con->prepare($sql_check);
				$stmt->execute();
				// echo "<br>";
				$result = $stmt->fetchColumn();
				// echo "result = " . $result;
				if(! $result){
	
					$sql = "insert into salary(TS_id,emp_id)values ('$lastID','$empID')";
					// echo $sql;
					$stmt = $con->prepare($sql);
					 $stmt->execute();
				}
			}
		}
		//--------second option through upload--------------------
		elseif(isset($_POST['upload_excel'])){
			//check if file is choosen and date is specified============================================= 
			if(! empty($_POST['searchDateFrom']) && is_uploaded_file($_FILES['result_file']['tmp_name'])){
				if($_FILES["result_file"]["name"] != ''){
					$allowed_extension = array('xls', 'csv', 'xlsx');
					$file_array = explode(".", $_FILES["result_file"]["name"]);
					$file_extension = end($file_array);

					if(in_array($file_extension, $allowed_extension)){
						$file_name = time() . '.' . $file_extension;
						move_uploaded_file($_FILES['result_file']['tmp_name'], $file_name);
						$file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
						$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

						$spreadsheet = $reader->load($file_name);

						unlink($file_name);

						$data = $spreadsheet->getActiveSheet()->toArray();
						$count = count($data);
						$sql="";
						for($row =1; $row < $count ; $row ++){
							
							$getEmpID_sql ="select id from employee where currentCode = " . $data[$row][0] ."";
							$stmt = $con->prepare($getEmpID_sql);
							$stmt->execute();
							//$stmt->bindParam(':Agree', $answer, PDO::PARAM_INT);
							$empID = $stmt->fetchColumn();
							//echo $empID;
							
							if($empID){															
								$employeetimesheet= "( $lastID,	$empID," .$data[$row][2]."," .$data[$row][3]."," .$data[$row][4]."," .$data[$row][5].",
										" .$data[$row][6]."," .$data[$row][7]."," .$data[$row][8]."," .$data[$row][9].",'" .$data[$row][10]."'),";
								$sql.= $employeetimesheet;
							}					
							else{
								//echo "emp not found";
							}
						}
					
						$insert_sql = 'INSERT INTO emptimesheet(TS_id,emp_id,presence_days,absence_days,casual_days,sickLeave_days,
										deduction_days,annual_days, manufacturing_days,evaluationPercent,notes)
										VALUES '. trim($sql,",");
						echo $insert_sql ;
						$statement = $con->prepare($insert_sql);
						 $statement->execute();
						$message = '<div class="alert alert-success">Data Imported Successfully</div>';

					}else{
						$message = '<div class="alert alert-danger">Only .xls .csv or .xlsx file allowed</div>';
					}
				}else{
					$message = '<div class="alert alert-danger">Please Select File</div>';
				}

				echo $message;
			}			
		}else{
			echo "you have to select date and choose file";
		}
		//echo "done insertion";
	}
	//====================insert overnight days======================
	function insertovernightDays(){
		$con = connect();
		$lastID = getTimesheetID($con);
		//---------------timesheet INSERTION---------------------
		//----------------either through file upload---------------
		//----------------or insertion one by one------------------
		//--------first option through insertion one by one-------
		if(isset($_POST["insertovernight"])){
			foreach ($_POST['overnight_days'] as $empID => $value) {
				
				$overnight = $_POST['overnight_days'][$empID];
				if($overnight >0 ){
					$overnightdeserveddays = $_POST['overnight_deserveddays'][$empID];
					$notes = $_POST['notes'][$empID]!=null ? $_POST['notes'][$empID]:null ;
	
					echo $notes;
					// $sql = "insert into empTimesheet(TS_id,emp_id,overnight_days,notes) 
					// 		values ('$lastID','$empID','$overnight','$notes')";
	
					// $sql ="UPDATE empTimesheet
					// 		set overnight_days = '$overnight'
					// 		WHERE TS_id = '$lastID'
					// 		and	  emp_id = '$empID'"; 
					$sql = "insert into emp_overnight values($lastID,$empID,$overnight,$overnightdeserveddays,'$notes')";
					echo $sql;
					$stmt = $con->prepare($sql);
					$stmt->execute();
					//check if ts_id already exists in salary:
					// $sql_check = "select TS_id from salary where TS_id ='$lastID'";
					// $stmt = $con->prepare($sql_check);
					// $stmt->execute();
					// $result = $stmt->fetchColumn();
					// if(! $result){
		
					// 	$sql = "insert into salary(TS_id,emp_id)values('$lastID','$empID')";
					// 	$stmt = $con->prepare($sql);
					// 	$stmt->execute();
					// }
				}


			}

		}
		//--------second option through upload--------------------
		elseif(isset($_POST['upload_overnightexcel'])){
			//check if date was choosen
			//check if file is choosen and date is specified============================================= 
			if(! empty($_POST['searchDateFrom']) && is_uploaded_file($_FILES['result_file']['tmp_name'])){
				if($_FILES["result_file"]["name"] != ''){
					$allowed_extension = array('xls', 'csv', 'xlsx');
					$file_array = explode(".", $_FILES["result_file"]["name"]);
					$file_extension = end($file_array);

					if(in_array($file_extension, $allowed_extension)){
						$file_name = time() . '.' . $file_extension;
						move_uploaded_file($_FILES['result_file']['tmp_name'], $file_name);
						$file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
						$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

						$spreadsheet = $reader->load($file_name);

						unlink($file_name);
						
						  $data = $spreadsheet->getActiveSheet()->toArray();
						  
						//  $cellValue = $spreadsheet->getActiveSheet()->getCell('D2')->getOldCalculatedValue() ;
						//  echo $cellValue;
						// $nullValue = null, $calculateFormulas = true, $formatData = true, $returnCellRef = false
						$count = count($data);
						// echo $count;
						for($row =1; $row < $count ; $row ++){
							$getEmpID_sql ="select id from employee where currentCode = " . $data[$row][0] ."";
							$stmt = $con->prepare($getEmpID_sql);
							$stmt->execute();
							$empID = $stmt->fetchColumn();
							
							if($empID){
								//echo $empID;
								$insertovernight_sql = "INSERT INTO emp_overnight(TS_id,emp_id,overnight_days,overnight_deserveddays,notes) 
												values( $lastID,$empID," .$data[$row][2]."," .$data[$row][3].",'" .$data[$row][4]."')";
								// echo $insertovernight_sql . "<br>";

								$statement = $con->prepare($insertovernight_sql);
								$statement->execute();
							}else{

								//echo "emp not found";
							}
							

						}
						
						$message = '<div class="alert alert-success">Data Imported Successfully</div>';

					}else{
						$message = '<div class="alert alert-danger">Only .xls .csv or .xlsx file allowed</div>';
					}
				}else{
					$message = '<div class="alert alert-danger">Please Select File</div>';
				}

				echo $message;
			}else{
				echo "you have to select date and choose file";
			}

		}
		//echo "done insertion";
	}
	//====================insert shift days===========================
	function insertshiftDays(){
		$con = connect();
		$lastID = getTimesheetID($con);
		//---------------timesheet INSERTION---------------------
		//----------------either through file upload---------------
		//----------------or insertion one by one------------------
		//--------first option through insertion one by one-------
		if(isset($_POST["insertshift"])){
			
			foreach ($_POST['shift_days'] as $empID => $value) {
				$shift = $_POST['shift_days'][$empID];
				if($shift >0 ){
					$cashperday = $_POST['cashperday'][$empID];
					$total = $_POST['total'][$empID];
					$notes = $_POST['notes'][$empID]!=null ? $_POST['notes'][$empID]:null ;
	
	
					// $sql = "insert into empTimesheet(TS_id,emp_id,overnight_days,notes) 
					// 		values ('$lastID','$empID','$overnight','$notes')";
	
					// $sql ="UPDATE empTimesheet
					// 		set shift_days = '$shift'
					// 		WHERE TS_id = '$lastID'
					// 		and	  emp_id = '$empID'"; 
					//echo $sql;
					$sql = "insert into emp_shift values($lastID,$empID,$shift,$cashperday,$total,'$notes')";
					$stmt = $con->prepare($sql);
					$stmt->execute();
				}

			}

		}
		//--------second option through upload--------------------
		elseif(isset($_POST['upload_shiftexcel'])){
			//check if date was choosen
			if(! empty($_POST['searchDateFrom']) && is_uploaded_file($_FILES['result_file']['tmp_name'])){
				if($_FILES["result_file"]["name"] != ''){
					$allowed_extension = array('xls', 'csv', 'xlsx');
					$file_array = explode(".", $_FILES["result_file"]["name"]);
					$file_extension = end($file_array);

					if(in_array($file_extension, $allowed_extension)){
						$file_name = time() . '.' . $file_extension;
						move_uploaded_file($_FILES['result_file']['tmp_name'], $file_name);
						$file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
						$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

						$spreadsheet = $reader->load($file_name);

						unlink($file_name);
						
						$data = $spreadsheet->getActiveSheet()->toArray();
		
						$count = count($data);
						$sql="";
						for($row =1; $row < $count ; $row ++){
							$getEmpID_sql ="select id from employee where currentCode = " . $data[$row][0] ."";
							$stmt = $con->prepare($getEmpID_sql);
							$stmt->execute();
							$empID = $stmt->fetchColumn();
							
							if($empID){
								$employee_shifttimesheet= "($lastID,$empID," .$data[$row][2]."," .$data[$row][3]."," .$data[$row][4].",'" .$data[$row][5]."'),";
								$sql.= $employee_shifttimesheet;
								
								
								// echo $insertovernight_sql . "<br>";


							}else{

								//echo "emp not found";
							}
							

						}
						$insertshift_sql = 'INSERT INTO emp_shift(TS_id,emp_id,shift_days,cashperday,total,notes) 
											VALUES '. trim($sql,",");
						$statement = $con->prepare($insertshift_sql);

						$statement->execute();





						$message = '<div class="alert alert-success">Data Imported Successfully</div>';

					}else{
						$message = '<div class="alert alert-danger">Only .xls .csv or .xlsx file allowed</div>';
					}
				}else{
					$message = '<div class="alert alert-danger">Please Select File</div>';
				}

				echo $message;
			}else{
				echo "you have to select date and choose file";
			}

		}
		//echo "done insertion";
	}
	//====================insert shift days===========================
	function insertsickleavesDays(){
		$con = connect();
		$lastID = getTimesheetID($con);
		//---------------timesheet INSERTION---------------------
		//----------------either through file upload---------------
		//----------------or insertion one by one------------------
		//--------first option through insertion one by one-------
		if(isset($_POST["insertsickleaves"])){
			echo "<pre>";
			print_r($_POST);
			echo "</pre>";

			foreach ($_POST['sick_leavesDays'] as $empID => $value) {
				$sick_leavesDays = $_POST['sick_leavesDays'][$empID];
				if($sick_leavesDays >0 ){
					$startDate = $_POST['startDate'][$empID];
					$endDate = $_POST['endDate'][$empID];
					// $continious = $_POST['continious'][$empID];
					$startimestamp = strtotime($startDate);
					$endtimestamp = strtotime($endDate);
					$continious = (isset($_POST['continious'][$empID])) ? 1 : 0;
					$newstartdate_month = date("m", $startimestamp);
					$newenddate_month = date("m", $endtimestamp);
					$newstartdate_year = date("Y", $startimestamp);
					$newenddate_year = date("Y", $endtimestamp);
					$datediff = $endtimestamp - $startimestamp;
	
					$days =  round($datediff / (60 * 60 * 24)) +1;
					echo "days : " . $days;
					echo"<br>";
					// if days > 10 and sick leaves are continous (true)
					//echo $continious;
					echo"<br>";
					
					if( $days > 10 && $continious == 1 ){ 
						$real_sickLeaves = $sick_leavesDays/4;
					}else{
						$real_sickLeaves = $sick_leavesDays;
					}
					$sql = "insert into emp_sickLeaves(TS_id,emp_id,sick_leavesDays,startDate,endDate,continious,real_sickLeaves)
							 values($lastID,$empID,$sick_leavesDays,'$startDate','$endDate',$continious,$real_sickLeaves)";
					$stmt = $con->prepare($sql);
					echo $sql;
				    $stmt->execute();
				}

			}

		}
		//--------second option through upload--------------------
		elseif(isset($_POST['upload_sickleavesexcel'])){
			//check if date was choosen
			if(! empty($_POST['searchDateFrom']) && is_uploaded_file($_FILES['result_file']['tmp_name'])){
				// echo "set";
				//checkif file is choosen
				$con=connect();
				$file_info = $_FILES["result_file"]["name"];
				$file_directory = "uploads/";
				//$new_file_name = date("dmY").".". $file_info["extension"];
				$new_file_name = date("d-m-Y")."_".$file_info;
				move_uploaded_file($_FILES["result_file"]["tmp_name"], $file_directory . $new_file_name);
				$file_type	= PHPExcel_IOFactory::identify($file_directory . $new_file_name);
				$objReader	= PHPExcel_IOFactory::createReader($file_type);
				$objPHPExcel = $objReader->load($file_directory . $new_file_name);
				$sheetData	= $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
				$highestRow = $objPHPExcel->getActiveSheet()->getHighestRow(); 

				$highestColumn = $objPHPExcel->getActiveSheet()->getHighestColumn();
				$headers = array_shift($sheetData);
				// $sheetData =  $objPHPExcel->getActiveSheet()->rangeToArray(
				// 	'A2:' . $highestColumn . $highestRow,
				// 	TRUE,TRUE,TRUE
				// );
				// echo "<pre>";

				// print_r($headers);
				// echo "</pre>";
				// echo "---------------------------------- <br>";
	
				foreach ($sheetData as $row){
					// echo "row :<br>";
					// echo "<pre>";

					// print_r($row);
					// echo "</pre>";
					// // echo $value;
					// echo "---------------------------------- <br>";
					
					if(!empty($row['A'])){
	
						$sql = 'SELECT ID FROM employee WHERE currentCode = '.$row['A'].'';
						echo $sql;
						$stmt = $con->prepare($sql);
						$stmt->execute();
						$result = $stmt->fetchColumn();
						echo $result;
						if( $result){
							// $sql = "insert into empTimesheet(emp_id,TS_id,shift_days,notes) 
							// values ($result,$lastID,".$row['C'].",".$row['F'].")";
							// $sql ="UPDATE empTimesheet
							// 		set shift_days = ".$row['C']."
							// 		WHERE TS_id = '$lastID'
							// 		and	  emp_id = '$result'"; 
							$sql = "insert into emp_sickLeaves(TS_id,emp_id,sick_leavesDays,startDate,endDate,continious,real_sickLeaves)
							values($lastID,$empID,$sick_leavesDays,'$startDate','$endDate',$continious,$real_sickLeaves)";
							// $sql = "insert into emp_shift values($lastID,$result,$shift,$notes)";
							//echo $sql;
							
							$stmt = $con->prepare($sql);
							$stmt->execute();
						}
						
					}
		
				}
				$updatemsg = "File Successfully Imported!";
				$updatemsgtype = 1;
			
			}else{
				echo "you have to select date and choose file";
			}

		}
		//echo "done insertion";
	}
	//---------------edit timesheet for one employee-----------
	function editTimesheet(){
		// echo "<pre>";
		// print_r($_POST);
		// echo "</pre>";
		
		$empID =$_POST['emp_id'];
		$sheetID = $_POST['sheetID'];
		// $presenceDaysEdit = $_POST['presenceDaysEdit'];
		// $deductionDaysEdit = $_POST['deductionDaysEdit'];
		// $absenceDaysEdit=$_POST['absenceDaysEdit'];
		// $sickLeaveDaysEdit =$_POST['sickLeaveDaysEdit'];
		// $manufacturingDaysEdit = $_POST['manufacturingDaysEdit'];
		// $overnightDaysEdit = $_POST['overnightDaysEdit'];
		// $shiftDaysEdit = $_POST['shiftDaysEdit'];
		// $annualDaysEdit = $_POST['annualDaysEdit'];
		// $casualDaysEdit = $_POST['casualDaysEdit'];
		// $notesEdit = $_POST['notesEdit'];
		
		
		$sql = "UPDATE empTimesheet
				SET 
					presence_days = " . $_POST['presenceDaysEdit'] .",
					sickLeave_days = " . $_POST['sickLeaveDaysEdit'] .",
					deduction_days = " . $_POST['deductionDaysEdit'] .",
					absence_days = " . $_POST['absenceDaysEdit'] .",
					annual_days =  " . $_POST['annualDaysEdit'] .",
					casual_days =  " . $_POST['casualDaysEdit'] .",
					manufacturing_days = " . $_POST['manufacturingDaysEdit'] .",
					overnight_days = " . $_POST['overnightDaysEdit'] .",
					shift_days = " . $_POST['shiftDaysEdit'] .",
					notes = '" . $_POST['notesEdit'] . "'
				WHERE TS_id =" . $_POST['sheetID']."
						 and emp_id =" .$_POST['emp_id'] ."";
				//ECHO $sql;
				
		$con = connect();
		$stmt = $con->prepare($sql);
	
		$stmt->execute();
		//echo json_encode(array("response"=>"done")) ;
       

	}