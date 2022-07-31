<?php
//check for timesheet id in salary table:
function checkForTSID_inSalary($con){
    
    $TS_ID = getTimesheetID($con);
    $checkDateinSalary_sql = "select distinct TS_id from salary where TS_id = $TS_ID";
    $stmt = $con->prepare($checkDateinSalary_sql);
	$stmt->execute();
    $result = $stmt->fetchColumn();
    if($result){
        return true;
    }else {
        //insert ts_id in salary table if not found:
       // $insertDateIDinSalary_sql = "insert into salary (TS_ID)values( $TS_ID)";

        return false;
    }
}
//-----------------------------------------
//--------getdeductions category------------------
function getDeductionTypesCategory(){
    $con = connect();
    $sql= "SELECT deductionTypeID,deductionCategory FROM deductiontypes" ;
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
        foreach($result as $row){
            echo "<option value=" .$row['deductionTypeID'].">" . $row['deductionCategory'] . "</option>";
        }

}
//---------------get deduction types---------------------------
function getDeductionTypes(){
    $page =  basename($_SERVER['REQUEST_URI']);
    $output="";
    $con = connect();
    $sql = "select * from deductionTypes ";

    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    if($page == 'deductiontype.php'){
        foreach($result as $row){
            echo '<button  class="btn btn-lg managements editdeductionTypesData well well-sm col-sm-10 col-sm-offset-1" data-toggle="modal" 
            data-target="#editdeductionTypeModal" id="'.$row['deductionTypeID'].'">'. $row['deductionType'] .'</button>';
        }
        echo "<div class='btn  btn-lg managements well well-sm col-sm-10 col-sm-offset-1' data-toggle='modal' 
            data-target='#adddeductionTypeModal'><i class='fa fa-plus-circle'></i></div>";
    }elseif($page == 'deductionfromcredit.php' || $page == 'uploadDedfromcredit.php'){
        echo "<option value=0 >all</option>";

        foreach($result as $row){
            
            echo "<option value=" .$row['deductionTypeID'].">" . $row['deductionType'] . "</option>";
        }
    }
    

    //echo $output;
}
//---------------show benefits-----------------------
function showbenefits(){
    $sql = "";
    $output ="";
    $con = connect();
    //check if there are any values in salary for that date:
    $sql = "select ID
            from timesheets
            where month(sheetDate) = month('".$_POST['dateFrom']."')
                and year(sheetDate)=year('".$_POST['dateFrom']."')";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $timesheetID = $stmt->fetchColumn();
    if($timesheetID){
        //there is timesheet with this date
        //check salary table

        $sql= "select e.currentCode,e.empName,empt.emp_id ,empt.TS_id,s.attendancePay,s.natureOfworkAllowance,s.laborDayGrant,
                    s.socialAid,s.representation,s.occupationalAllowance,s.experience,s.specialBonus,s.overnightShift,
                    s.tiffinAllowance,s.incentive,s.additionalIncentive,s.shift,s.specializationAllowance,s.manufacturingAllowance,s.otherDues
                from employee e inner join empTimesheet empt
                    on e.ID = empt.emp_id inner join salary s 
                    on empt.emp_id = s.emp_id and empt.TS_id = s.TS_id
                where empt.TS_id =  $timesheetID";
        if(!empty($_POST['search'])){
            $sql .= " and (e.currentCode like '%". $_POST['search'] ."%' OR e.empName like '%". $_POST['search'] ."%')";	
        }
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if($result){
            foreach($result as $row){
                $empindex = $row['emp_id'];
                $tsindex = $row['TS_id'];
                
                $output .= "<tr>
                <td>".  $row['currentCode']. "</td>
                <td>".  $row['empName']. "</td>
                <input name='emp_id' type='hidden' value=".$row['emp_id'].">
                <input name='tsID' type='hidden' value=".$row['TS_id'].">
                <td>".  $row['attendancePay']. "</td>
                <td>".  $row['natureOfworkAllowance']. "</td>
                <td>".  $row['specializationAllowance']. "</td>
                <td>".  $row['manufacturingAllowance']. "</td>
                <td>".  $row['socialAid']. "</td>
                <td>".  $row['representation']. "</td>
                <td>".  $row['occupationalAllowance']. "</td>
                
                <td>".  $row['experience']. "</td>
                <td>".  $row['specialBonus']. "</td>
                <td>".  $row['overnightShift']. "</td>
                <td>".  $row['laborDayGrant']. "</td>
                <td>".  $row['tiffinAllowance']. "</td>
                <td>".  $row['incentive']. "</td>
                
                <td>".  $row['shift']. "</td>
                <td>".  $row['otherDues']. "</td>
                <td>".  $row['additionalIncentive']. "</td>

                </tr>";
                

            }
        }
    }else{
        $output = "
        <tr>
        <td colspan='13' class='alert alert-warning'> 
        <strong>لا يوجد حصر أيام الحضور بهذا التاريخ.. </strong>
        </td></tr>";
    }

    
    echo $output;

}
//---------------get other deductions--------------------
function getDeductions(){
    $sql = "";
    $output ="";
    $con = connect();
    //check if there are any values in salary for that date:
    $sql = "select ID
            from timesheets
            where sheetDate = '".$_POST['dateFrom']."'";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $timesheetID = $stmt->fetchColumn();
    if(! $timesheetID){
        // if no timesheet date insert new one
        $insertSql = "insert into timesheets(sheetDate)values('".$_POST['dateFrom']."') ";
        $stmt = $con->prepare($insertSql);
        $stmt->execute();
        $getlastTSID_sql = "select max(ID) from timesheets";
        
        $stmt = $con->prepare($getlastTSID_sql);
        $stmt->execute();
        $timesheetID = $stmt->fetchColumn();
        // $insertTimesheetinSalary = "insert into salary(TS_id)values('$timesheetID')";
        //---------------timesheet ID INSERTION in salary table---------------------
        $sql="select ID from employee";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        
        foreach ($result as $row) {

            $sql = "insert into salary(TS_id,emp_id) 
                    values ($timesheetID,". $row['ID'].")";
            //echo $sql;
            $stmt = $con->prepare($sql);
            $stmt->execute();

            //}
            //  print "}\n";
        }

    }
        //if($timesheetID){
        //there is timesheet with this date
        //check salary table

        $sql= "select e.currentCode,e.empName,t.ID,s.otherDeduction,s.mobil,s.TS_id,s.emp_id,
                s.perimiumCard,s.pastPeriod,s.etisalatNet,s.socialInsurances
                from employee e  inner join salary s 
                    on e.ID = s.emp_id inner join timesheets t 
                    on s.TS_id = t.ID 
                where s.TS_id =  $timesheetID";
        if(!empty($_POST['search'])){ 
            $sql .= " and (e.currentCode like '%". $_POST['search'] ."%' OR e.empName like '%". $_POST['search'] ."%')";	
        }
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if($result){
            // 	<td>
            // 	<input type='number' class='form-control' name='socialInsurancesText[$tsindex][$empindex]' value=".$row['socialInsurances'].">
            // </td> 
            foreach($result as $row){
                $empindex = $row['emp_id'];
                $tsindex = $row['TS_id'];
                
                $output .= "<tr>
                <td>".  $row['currentCode']. "</td>
                <td>".  $row['empName']. "</td>
                <input name='emp_id' type='hidden' value=".$row['emp_id'].">
                <input name='tsID' type='hidden' value=".$row['TS_id'].">
                <td>
                    <input type='number' class='form-control mb-2' name='otherDeductionText[$tsindex][$empindex]' value=".$row['otherDeduction'].">
                </td> 

                <td>
                    <input type='number' class='form-control mb-2' name='mobilText[$tsindex][$empindex]' value=".$row['mobil'].">
                </td>
                <td>
                    <input type='number' class='form-control mb-2' name='etisalatNetText[$tsindex][$empindex]'  value=".$row['etisalatNet'].">
                </td>
                <td>
                    <input type='number' class='form-control mb-2' name='perimiumCardText[$tsindex][$empindex]'  value=".$row['perimiumCard'].">
                </td>
                <td>
                    <input type='number' class='form-control mb-2' name='pastPeriodText[$tsindex][$empindex]'  value=".$row['pastPeriod'].">
                </td>
                </tr>";
            }
        }
    //}
    else{
        
        $sql= "select e.ID,e.currentCode,e.empName from employee e";
        if(!empty($_POST['search'])){ 
            $sql .= " where (e.currentCode like '%". $_POST['search'] ."%' OR e.empName like '%". $_POST['search'] ."%')";	
        }
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        // $output = "
        // <tr>
        // <td colspan='13' class='alert alert-warning'> 
        // <strong>لا يوجد حصر أيام الحضور بهذا التاريخ.. </strong>
        // </td></tr>";
        foreach($result as $row){
            $empindex = $row['ID'];
            $output .= "<tr>
            <td>".  $row['currentCode']. "</td>
            <td>".  $row['empName']. "</td>
            <input name='emp_id' type='hidden' value=".$row['ID'].">
            <input name='tsID' type='hidden' value= '$timesheetID'>
            <td>
                <input type='number' class='form-control' name='otherDeductionText[$timesheetID][$empindex]' >
            </td> 

            <td>
                <input type='number' class='form-control' name='mobilText[$timesheetID][$empindex]' >
            </td>
            <td>
                <input type='number' class='form-control' name='etisalatNetText[$timesheetID][$empindex]' >
            </td>
            <td>
                <input type='number' class='form-control' name='perimiumCardText[$timesheetID][$empindex]'>
            </td>
            <td>
                <input type='number' class='form-control' name='pastPeriodText[$timesheetID][$empindex]' >
            </td>
            </tr>";
        }
    }

    
    echo $output;
}

/**************************
******************
// get all deductions data-------
********************
**********/
function getAllDeductions(){
    $output="";	
    $con = connect();
    $sql= '';	
    $getTSID_sql = "select ID  from timesheets where month(sheetDate) = month('".$_POST['dateFrom']."')
												and year(sheetDate)= year('".$_POST['dateFrom']."') ";
    $stmt = $con->prepare($getTSID_sql);
    $stmt->execute();
    $TS_ID = $stmt->fetchColumn();
    if($TS_ID>0){
        $sql="SELECT TS_id, emp_id,salaryDescription,pastPeriod,perimiumCard,familyHealthInsurance, 
            otherDeduction,petroleumSyndicate,sanctions,mobil,loan,zamala,empServiceFund, 
            socialInsurances, supplementaryPension, tax, etisalatNet,omra,cairoBank,vodafone, 
            totalDeductions,currentCode,empName
            FROM salary inner join employee on  salary.emp_id = employee.ID
            WHERE TS_id =".$TS_ID."
            and employee.is_deleted=0";
        if(!empty($_POST['search'])){
            $sql .= " and (employee.currentCode like '%". $_POST['search'] ."%' OR employee.empName like '%". $_POST['search'] ."%')";	
        }
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if($result ){
            foreach($result as $row){
                //$output .= "<tr><td>".  $row['sheetDate']. "</td></tr>";
                $output .=
                "<tr>
                    <td>".  $row['currentCode']. "</td>
                    <td>".  $row['empName']. "</td>
                    <td>".  $row['pastPeriod']. "</td>
                    <td>".  $row['perimiumCard']. "</td>
                    <td>".  $row['familyHealthInsurance']. "</td>
                    <td>".  $row['otherDeduction']. "</td>
                    <td>".  $row['petroleumSyndicate']. "</td>
                    <td>".  $row['sanctions']. "</td>
                    <td>".  $row['mobil']. "</td>
                    <td>".  $row['zamala']. "</td>
                    <td>".  $row['empServiceFund']. "</td>
                    <td>".  $row['socialInsurances']. "</td>
                    <td>".  $row['supplementaryPension']. "</td>
                    <td>".  $row['tax']. "</td>
                    <td>".  $row['etisalatNet']. "</td>
                    <td>".  $row['omra']. "</td>
                    <td>".  $row['cairoBank']. "</td>
                    <td>".  $row['vodafone']. "</td>
                    <td>".  $row['totalDeductions']. "</td>
    
                    <td style='display:none;'  class='timesheet_ID'>" .  $row['TS_id']."</td>
                    <td><a class='btn btn-sm editdeductionsData'  id=".$row['emp_id'].">
                    <i class='fa fa-edit fa-lg' data-toggle='modal' data-target='#editdeductionsModal'></i>
                    </a></td>
                </tr>";
            }
        }
    }else{
        $output = "
        <tr>
        <td colspan='20' class='alert alert-warning'> 
        <strong>لا يوجد استقطاعات بهذا التاريخ..</strong><a href='timesheetinsertion.php'>here</a>
        </td></tr>";
    }


    echo $output;

}
//---------------get deductions from credit--------------------------
function getCreditDeductions(){
    $output ="";
    $con = connect();
    //check if there are any values in salary for that date:
    $sql = "select cd.*,e.currentCode,e.empName,dt.deductionType,cd.endDate
            from employee e inner join creditDeductions cd on e.ID = cd.emp_id
                            inner join deductionTypes dt 
                            on cd.deductionType_id = dt.deductionTypeID ";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    // $timesheetID = $stmt->fetchColumn();
    foreach ($result as $row) {
        $output .= "<tr>
        <td>".  $row['currentCode']. "</td>
        <td>".  $row['empName']. "</td>
        <input name='emp_id' type='hidden' value=".$row['emp_id'].">
        <input name='dedID' type='hidden' value=".$row['deductionType_id'].">
        <td>".$row['deductionDate']."</td> 
        <td>".$row['deductionType']."</td> 

        <td>".$row['totalAmount']."</td> 
        <td>".$row['endDate']."</td> 

        <td> <button  class='btn  btn-sm managements editManagementData ' data-toggle='modal'
         data-target='#editManagementModal' id=''>edit</button></td>
        
        </tr>";
    }

    echo $output;
}
//---------------get CURRENT deductions from credit in modal--------------------------
function getCurrentCreditDeductionsForEmp(){
    $output ="";
    $con = connect();
    // $sql = "select cd.deductionType_id,cd.emp_id,cd.totalAmount,e.currentCode,e.empName,dt.deductionType,
    // 			cd.deductionDate,cd.endDate
    // 		from employee e inner join creditDeductions cd on e.ID = cd.emp_id
    // 						inner join deductionTypes dt on cd.deductionType_id = dt.deductionTypeID 
    // 						inner join creditDedInstallments cdi on cdi.creditDed_id = cd.ID
    // 		where  cd.emp_id = " . $_POST['editDed_EmpID'] . "
    // 		and  month(GETDATE()) < month(endDate)";

            $sql = "select cd.deductionType_id,cd.emp_id,cd.totalAmount,e.currentCode,e.empName,dt.deductionType,
                        cd.endDate,cdi.remainingValue
                    from employee e inner join creditDeductions cd on e.ID = cd.emp_id
                            inner join deductionTypes dt on cd.deductionType_id = dt.deductionTypeID 
                            inner join creditDedInstallments cdi on cdi.creditDed_id = cd.ID
                    where  cd.emp_id = " . $_POST['editDed_EmpID'] . "
                        and  GETDATE() < endDate
                        and  month(cdi.installmentDate) = month(GETDATE())
                        and year(cdi.installmentDate) = year(GETDATE())";
            // select cd.deductionType_id,cd.emp_id,cd.totalAmount,e.currentCode,e.empName,dt.deductionType,
            // 	cdi.*
            // 	from employee e inner join creditDeductions cd on e.ID = cd.emp_id
            // inner join deductionTypes dt on cd.deductionType_id = dt.deductionTypeID 
            // inner join creditDedInstallments cdi on cdi.creditDed_id = cd.ID
            // where  cd.emp_id = 2
        
            
            // and  month(cdi.installmentDate) = month(GETDATE())
            // and year(cdi.installmentDate) = year(GETDATE())
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    if($result){
        foreach ($result as $row) {
            $output .= "<tr>
            <input name='emp_id' type='hidden' value=".$row['emp_id'].">
            <input name='dedID' type='hidden' value=".$row['deductionType_id'].">
            <td>".$row['deductionType']."</td> 
            <td>".$row['remainingValue']."</td> 
            <td>".$row['endDate']."</td> 
            <td> <button  class='btn  btn-sm' data-toggle='modal'
                data-target='#editManagementModal' id='payDeduction'>pay</button></td>
            
            </tr>";
        }

        echo json_encode( array("tableOutput" => $output,
                                "empCode" => $row['currentCode'],
                                "empName" => $row['empName']));

    }else{
        $sql = "select TOP 1 currentCode,empName
                from employee
                where  ID = " . $_POST['editDed_EmpID'] . "";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        $output = "<td colspan='5'>لا يوجـــد استقطاعات جارية </td> ";
        echo json_encode( array("tableOutput" => $output,
                                "empCode" => $result['currentCode'],
                                "empName" => $result['empName']));
    }
    
}
//---------------get ENDED deductions from credit in modal--------------------------
function getEndedCreditDeductionsForEmp(){
    $output ="";
    $con = connect();

    $sql = "select cd.deductionType_id,cd.emp_id,cd.totalAmount,e.currentCode,e.empName,dt.deductionType,
                cd.deductionDate,cd.endDate
            from employee e inner join creditDeductions cd on e.ID = cd.emp_id
                            inner join deductionTypes dt 
                            on cd.deductionType_id = dt.deductionTypeID 							
            where  cd.emp_id = " . $_POST['endedDed_EmpID'] . "
                    and  month(GETDATE()) > month(endDate)";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    if($result){
        foreach ($result as $row) {
            $output .= "<tr>
            <input name='emp_id' type='hidden' value=".$row['emp_id'].">
            <input name='dedID' type='hidden' value=".$row['deductionType_id'].">
            <td>".$row['deductionType']."</td> 
            <td>".$row['deductionDate']."</td> 
            <td>".$row['totalAmount']."</td> 
            <td>".$row['endDate']."</td> 
            </tr>";
        }

        echo json_encode( array("tableOutput" => $output,
                                "empCode" => $row['currentCode'],
                                "empName" => $row['empName']));
    }else{
        $sql = "select TOP 1 currentCode,empName
                from employee 
                where  ID = " . $_POST['endedDed_EmpID'] . "";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        $output = "<td colspan='4'>لا يوجـــد استقطاعات منتهية </td> ";
        echo json_encode( array("tableOutput" => $output,
                                "empCode" => $result['currentCode'],
                                "empName" => $result['empName']));
    }
    
}
//---------------get deduction items in a form---------
function deductionItems(){
    $sql = "";
    $output ="<div class='row card'>";
    $con = connect();
    //check if there are any values in salary for that date:
    $sql = "select * from deductionTypes";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    // $timesheetID = $stmt->fetchColumn();
    foreach ($result as $row) {                
        $output .=
            "<div class='col-sm-6 '>
                <fieldset class='form-group '>
                    <div class='label'><legend >".$row['deductionType']."</legend></div>
                    
                    <label  for='dedDate'>تاريخ التسجيل:</label>
                    <input class='form-control'  type ='date' id='dedDate[".$row['deductionTypeID']."]' 
                    name='dedDate[".$row['deductionTypeID']."]' >
                
                
                    <label  for='dedAmount'>المبلغ:</label>
                    <input class='form-control formControlWidth'  id='dedAmount[".$row['deductionTypeID']."]' 
                    name='dedAmount[".$row['deductionTypeID']."]' placeholder='ادخل القيمة الكلية..'>
                        
                    ";
                    if($row['deductionTypeID'] != 5){//medicines
                        $output .="
                            <br><label  for='dedmonthsNo'>عدد الشهور:</label>
                            <input class='form-control formControlWidth'  id='dedmonthsNo[".$row['deductionTypeID']."]' 
                            name='dedmonthsNo[".$row['deductionTypeID']."]' placeholder='ادخل عدد الشهور ..'>";
                    }
        $output .=	
                    "<input type='hidden'  id=".$row['deductionTypeID']." name=".$row['deductionTypeID']." >
                </fieldset>
            </div>";
    }
    $output .= "</div>";
    echo $output;
}
//---------------insert deductions from credit-------------------
function insertDedFromCredit(){
    //print_r($_POST);
    $con = connect();
    $empID = $_POST['getEmpForDed'];
    
    $add_installment ="insert into creditDedInstallments (creditDed_id,
                        installmentDate,monthlyValue,remainingValue) values ";
    // $update_installment = "update creditdedIndtallments
    // 					 set ";					
    //divide deductions according to rules:
    //ranges of deductions for medicines:
    $r1 = range(0, 500);
    $r2 = range(501, 1000);
    $r3 = range(1001, 2000);
    $r4 = range(2001, 4000);
    $r5 = range(4001, 5000);
    //---------------deduction from credit insertion ---------------------
    foreach ($_POST['dedDate'] as $DedTypeID => $datevalue) {
        
        if($_POST['dedAmount'][$DedTypeID] != 0){
            if($DedTypeID == 5){ //ادوية
                $add_deduction = "insert into creditDeductions(emp_id,deductionType_id,
                                    deductionDate,totalAmount) output INSERTED.ID values($empID,$DedTypeID,'$datevalue',
                                    ".$_POST['dedAmount'][$DedTypeID].")";
                echo $add_deduction;
                $stmt = $con->prepare($add_deduction);
                $stmt->execute();	
                $insertedID = $stmt->fetchcolumn();
                
                echo( $insertedID);
                $checkSql = "	select max(ID) as ID,endDate
                                from creditDeductions 			
                                where  emp_id = $empID and deductionType_id =$DedTypeID
                                and endDate >=  '$datevalue'
                                group by endDate ";
                $stmt = $con->prepare($checkSql);
                $stmt->execute();
                $result = $stmt->fetchAll();
                
                if($result){
                    foreach ($result as $row){
                        print_r($row);
                        // if there are any current deductions of meds:
                        //get the remaining value and update accordingly	
                        $getRemainingAmount = "select remainingValue
                                                from creditDedInstallments 
                                                where creditDed_id =".$row['ID']." and installmentDate =  DATEADD(month, -1, '$datevalue')";
                        $stmt = $con->prepare($getRemainingAmount);
                        $stmt->execute();
                        $remainingAmount_result = $stmt->fetchcolumn();
                        //echo $getRemainingAmount ;
                        $remainingAmount = $remainingAmount_result + $_POST['dedAmount'][$DedTypeID]; //new remaining amount 
                        //for update:
                        while( $remainingAmount > 0){
                            switch ($remainingAmount) {
                                case in_array($remainingAmount, $r1) :
                                    $monthAmount = 50;
                                    break;
                                case in_array($remainingAmount, $r2):
                                    $monthAmount = 100;
                                    break;
                                case in_array($remainingAmount, $r3):
                                    $monthAmount = 150;
                                    break;
                                case in_array($remainingAmount, $r4):
                                    $monthAmount = 200;
                                    break;
                                case in_array($remainingAmount, $r5):
                                    $monthAmount = 400;
                                    break;
                                case ($remainingAmount > 5000) :
                                    $monthAmount = 500;
                                    break;
        
                            }
                            if($datevalue <= $row['endDate']){
                                $remainingAmount =$remainingAmount - $monthAmount ;
                                $updateInstallment = "update creditDedInstallments
                                                        set	monthlyValue = $monthAmount,
                                                            remainingValue = $remainingAmount
                                                        where creditDed_id =".$row['ID']."	and installmentDate =  '$datevalue'";
                                echo 	$updateInstallment;			
                                $stmt = $con->prepare($updateInstallment);
                                $stmt->execute();
                            }else{
                                $remainingAmount =$remainingAmount - $monthAmount ;
                                $add_installment .=	"( $insertedID,'$datevalue',$monthAmount,$remainingAmount),";
                            }
                            
        
                            
                            $datevalue = date('Y-m-d', strtotime("+1 months", strtotime($datevalue)));
                        }
                        
                    }
                }

                else{
                    echo "no history meds";
                    $remainingAmount =  $_POST['dedAmount'][$DedTypeID];
                    while( $remainingAmount > 0){
                
                        switch ($remainingAmount) {
                            case in_array($remainingAmount, $r1) :
                                $monthAmount = 50;
                                break;
                            case in_array($remainingAmount, $r2):
                                $monthAmount = 100;
                                break;
                            case in_array($remainingAmount, $r3):
                                $monthAmount = 150;
                                break;
                            case in_array($remainingAmount, $r4):
                                $monthAmount = 200;
                                break;
                            case in_array($remainingAmount, $r5):
                                $monthAmount = 400;
                                break;
                            case ($remainingAmount > 5000) :
                                $monthAmount = 500;
                                break;
    
                        }

                        $remainingAmount =$remainingAmount - $monthAmount ;
                        
                        $add_installment .=	"( $insertedID,'$datevalue',$monthAmount,$remainingAmount),";
                        $datevalue = date('Y-m-d', strtotime("+1 months", strtotime($datevalue)));
                        

                    }
                }
                
                $trimmed_add_installment =  rtrim($add_installment,",");	
                echo $trimmed_add_installment;
                $stmt = $con->prepare($trimmed_add_installment);
                $stmt->execute();
                //$endDateinsertedID = $stmt->fetchcolumn();
                //get last deduction to calculate end date and insert it into table
                $sql="select max(installmentDate) from creditDedInstallments where creditDed_id=$insertedID ";
                $stmt = $con->prepare($sql);
                $stmt->execute();
                $endDate = $stmt->fetchColumn();
                $addendDate = "update creditDeductions 
                                set endDate = '$endDate'
                                where ID =$insertedID ";
                $stmt = $con->prepare($addendDate);
                $stmt->execute();


            }else{ //باقى الاستقطاعات حسب عدد الشهور
                $endDate = date('Y-m-d', strtotime("+ ".($_POST['dedmonthsNo'][$DedTypeID]-1)." months", strtotime($datevalue)));
                //echo $endDate; 
                $add_deduction = "insert into creditDeductions(emp_id,deductionType_id,
                                    deductionDate,totalAmount,months,endDate) output INSERTED.ID values($empID,$DedTypeID,'$datevalue',
                                    ".$_POST['dedAmount'][$DedTypeID].",".$_POST['dedmonthsNo'][$DedTypeID].",'$endDate')";
                                    //echo $add_deduction;
                $stmt = $con->prepare($add_deduction);
                $stmt->execute();
                $insertedID = $stmt->fetchcolumn();
                
                echo( $insertedID);
                //----get quotient of division------------
                
                $quotientAmount =  intval($_POST['dedAmount'][$DedTypeID] / $_POST['dedmonthsNo'][$DedTypeID]);
                $remainderAmount = fmod($_POST['dedAmount'][$DedTypeID] ,$_POST['dedmonthsNo'][$DedTypeID]);
                // echo "quotient". $quotientAmount ;
                // echo "<br>";
                // echo "remainderAmount". $remainderAmount;
                // echo "<br>";
                //------------first month will deduct quotient value plus remainder---------------
                
                $firstMonthAmount = $quotientAmount + $remainderAmount ; //اول قسط
                $remainingAmount = $_POST['dedAmount'][$DedTypeID]  - $firstMonthAmount;
                // echo "firstMonthAmount". $firstMonthAmount;
                // echo "<br>";
                // echo "remainingAmount". $remainingAmount;
                
                //------------add first month in sql statement---------------------
                $add_installment .="($insertedID,'$datevalue',$firstMonthAmount,$remainingAmount),";
                
                $datevalue = date('Y-m-d', strtotime("+1 months", strtotime($datevalue)));
                
                while( $remainingAmount > 0){
                    $remainingAmount = $remainingAmount - $quotientAmount ;
                    $add_installment .="( $insertedID,'$datevalue',$quotientAmount,$remainingAmount),";
                    
                    $datevalue = date('Y-m-d', strtotime("+1 months", strtotime($datevalue)));
                     echo "<br>";
                    
                    // echo "quotient". $quotientAmount ;
                    // echo "<br>";
                    // echo "remainingAmount". $remainingAmount;
                    
                    
                }
                    echo"<br>";
                
                $trimmed_add_installment =  rtrim($add_installment,",");	
                echo "out of scope";
                echo $trimmed_add_installment;
                $stmt = $con->prepare($trimmed_add_installment);
                $stmt->execute();
            }

        }
    }
        
}	
//---------------UPLOAD deductions from credit-------------------
function uploadDedFromCredit(){
    //print_r($_POST);
    $con = connect();
    $empID = $_POST['getEmpForDed'];
    
    $add_installment ="insert into creditDedInstallments (creditDed_id,
                        installmentDate,monthlyValue,remainingValue) values ";
    // $update_installment = "update creditdedIndtallments
    // 					 set ";					
    //divide deductions according to rules:
    //ranges of deductions for medicines:
    $r1 = range(0, 500);
    $r2 = range(501, 1000);
    $r3 = range(1001, 2000);
    $r4 = range(2001, 4000);
    $r5 = range(4001, 5000);
    //---------------deduction from credit insertion ---------------------
    foreach ($_POST['dedDate'] as $DedTypeID => $datevalue) {
        
        if($_POST['dedAmount'][$DedTypeID] != 0){
            if($DedTypeID == 5){ //ادوية
                $add_deduction = "insert into creditDeductions(emp_id,deductionType_id,
                                    deductionDate,totalAmount) output INSERTED.ID values($empID,$DedTypeID,'$datevalue',
                                    ".$_POST['dedAmount'][$DedTypeID].")";
                echo $add_deduction;
                $stmt = $con->prepare($add_deduction);
                $stmt->execute();	
                $insertedID = $stmt->fetchcolumn();
                
                echo( $insertedID);
                $checkSql = "	select max(ID) as ID,endDate
                                from creditDeductions 			
                                where  emp_id = $empID and deductionType_id =$DedTypeID
                                and endDate >=  '$datevalue'
                                group by endDate ";
                $stmt = $con->prepare($checkSql);
                $stmt->execute();
                $result = $stmt->fetchAll();
                
                if($result){
                    foreach ($result as $row){
                        print_r($row);
                        // if there are any current deductions of meds:
                        //get the remaining value and update accordingly	
                        $getRemainingAmount = "select remainingValue
                                                from creditDedInstallments 
                                                where creditDed_id =".$row['ID']." and installmentDate =  DATEADD(month, -1, '$datevalue')";
                        $stmt = $con->prepare($getRemainingAmount);
                        $stmt->execute();
                        $remainingAmount_result = $stmt->fetchcolumn();
                        //echo $getRemainingAmount ;
                        $remainingAmount = $remainingAmount_result + $_POST['dedAmount'][$DedTypeID]; //new remaining amount 
                        //for update:
                        while( $remainingAmount > 0){
                            switch ($remainingAmount) {
                                case in_array($remainingAmount, $r1) :
                                    $monthAmount = 50;
                                    break;
                                case in_array($remainingAmount, $r2):
                                    $monthAmount = 100;
                                    break;
                                case in_array($remainingAmount, $r3):
                                    $monthAmount = 150;
                                    break;
                                case in_array($remainingAmount, $r4):
                                    $monthAmount = 200;
                                    break;
                                case in_array($remainingAmount, $r5):
                                    $monthAmount = 400;
                                    break;
                                case ($remainingAmount > 5000) :
                                    $monthAmount = 500;
                                    break;
        
                            }
                            if($datevalue <= $row['endDate']){
                                $remainingAmount =$remainingAmount - $monthAmount ;
                                $updateInstallment = "update creditDedInstallments
                                                        set	monthlyValue = $monthAmount,
                                                            remainingValue = $remainingAmount
                                                        where creditDed_id =".$row['ID']."	and installmentDate =  '$datevalue'";
                                echo 	$updateInstallment;			
                                $stmt = $con->prepare($updateInstallment);
                                $stmt->execute();
                            }else{
                                $remainingAmount =$remainingAmount - $monthAmount ;
                                $add_installment .=	"( $insertedID,'$datevalue',$monthAmount,$remainingAmount),";
                            }
                            
        
                            
                            $datevalue = date('Y-m-d', strtotime("+1 months", strtotime($datevalue)));
                        }
                        
                    }
                }

                else{
                    echo "no history meds";
                    $remainingAmount =  $_POST['dedAmount'][$DedTypeID];
                    while( $remainingAmount > 0){
                
                        switch ($remainingAmount) {
                            case in_array($remainingAmount, $r1) :
                                $monthAmount = 50;
                                break;
                            case in_array($remainingAmount, $r2):
                                $monthAmount = 100;
                                break;
                            case in_array($remainingAmount, $r3):
                                $monthAmount = 150;
                                break;
                            case in_array($remainingAmount, $r4):
                                $monthAmount = 200;
                                break;
                            case in_array($remainingAmount, $r5):
                                $monthAmount = 400;
                                break;
                            case ($remainingAmount > 5000) :
                                $monthAmount = 500;
                                break;
    
                        }

                        $remainingAmount =$remainingAmount - $monthAmount ;
                        
                        $add_installment .=	"( $insertedID,'$datevalue',$monthAmount,$remainingAmount),";
                        $datevalue = date('Y-m-d', strtotime("+1 months", strtotime($datevalue)));
                        

                    }
                }
                
                $trimmed_add_installment =  rtrim($add_installment,",");	
                echo $trimmed_add_installment;
                $stmt = $con->prepare($trimmed_add_installment);
                $stmt->execute();
                //$endDateinsertedID = $stmt->fetchcolumn();
                //get last deduction to calculate end date and insert it into table
                $sql="select max(installmentDate) from creditDedInstallments where creditDed_id=$insertedID ";
                $stmt = $con->prepare($sql);
                $stmt->execute();
                $endDate = $stmt->fetchColumn();
                $addendDate = "update creditDeductions 
                                set endDate = '$endDate'
                                where ID =$insertedID ";
                $stmt = $con->prepare($addendDate);
                $stmt->execute();


            }else{ //باقى الاستقطاعات حسب عدد الشهور
                $endDate = date('Y-m-d', strtotime("+ ".($_POST['dedmonthsNo'][$DedTypeID]-1)." months", strtotime($datevalue)));
                //echo $endDate; 
                $add_deduction = "insert into creditDeductions(emp_id,deductionType_id,
                                    deductionDate,totalAmount,months,endDate) output INSERTED.ID values($empID,$DedTypeID,'$datevalue',
                                    ".$_POST['dedAmount'][$DedTypeID].",".$_POST['dedmonthsNo'][$DedTypeID].",'$endDate')";
                                    //echo $add_deduction;
                $stmt = $con->prepare($add_deduction);
                $stmt->execute();
                $insertedID = $stmt->fetchcolumn();
                
                echo( $insertedID);
                //----get quotient of division------------
                
                $quotientAmount =  intval($_POST['dedAmount'][$DedTypeID] / $_POST['dedmonthsNo'][$DedTypeID]);
                $remainderAmount = fmod($_POST['dedAmount'][$DedTypeID] ,$_POST['dedmonthsNo'][$DedTypeID]);
                // echo "quotient". $quotientAmount ;
                // echo "<br>";
                // echo "remainderAmount". $remainderAmount;
                // echo "<br>";
                //------------first month will deduct quotient value plus remainder---------------
                
                $firstMonthAmount = $quotientAmount + $remainderAmount ; //اول قسط
                $remainingAmount = $_POST['dedAmount'][$DedTypeID]  - $firstMonthAmount;
                // echo "firstMonthAmount". $firstMonthAmount;
                // echo "<br>";
                // echo "remainingAmount". $remainingAmount;
                
                //------------add first month in sql statement---------------------
                $add_installment .="($insertedID,'$datevalue',$firstMonthAmount,$remainingAmount),";
                
                $datevalue = date('Y-m-d', strtotime("+1 months", strtotime($datevalue)));
                
                while( $remainingAmount > 0){
                    $remainingAmount = $remainingAmount - $quotientAmount ;
                    $add_installment .="( $insertedID,'$datevalue',$quotientAmount,$remainingAmount),";
                    
                    $datevalue = date('Y-m-d', strtotime("+1 months", strtotime($datevalue)));
                     echo "<br>";
                    
                    // echo "quotient". $quotientAmount ;
                    // echo "<br>";
                    // echo "remainingAmount". $remainingAmount;
                    
                    
                }
                    echo"<br>";
                
                $trimmed_add_installment =  rtrim($add_installment,",");	
                echo "out of scope";
                echo $trimmed_add_installment;
                $stmt = $con->prepare($trimmed_add_installment);
                $stmt->execute();
            }

        }
    }
        
}	

//---------------get other benefits--------------------
function getBenefits(){
    $sql = "";
    $output ="";
    $con = connect();
    //check if there are any values in salary for that date:
    $sql = "select ID
            from timesheets
            where sheetDate = '".$_POST['dateFrom']."'";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $timesheetID = $stmt->fetchColumn();
    if(!$timesheetID){

    
        // if no timesheet date insert new one
        $insertSql = "insert into timesheets(sheetDate)values('".$_POST['dateFrom']."') ";
        $stmt = $con->prepare($insertSql);
        $stmt->execute();
        $getlastTSID_sql = "select max(ID) from timesheets";
        
        $stmt = $con->prepare($getlastTSID_sql);
        $stmt->execute();
        $timesheetID = $stmt->fetchColumn();
    
        //---------------timesheet ID INSERTION in salary table---------------------
        $sql="select ID from employee";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        
        foreach ($result as $row) {

            $sql = "insert into salary(TS_id,emp_id) 
                    values ($timesheetID,". $row['ID'].")";
        //	echo $sql;
            $stmt = $con->prepare($sql);
            $stmt->execute();

            //}
            //  print "}\n";
        }
    }
    //if($timesheetID){
        //there is timesheet with this date
        //check salary table

        $sql= "select e.currentCode,e.empName,s.emp_id ,s.TS_id,s.specialBonus,s.otherDues
                    
                from employee e inner join  salary s 
                    on e.ID = s.emp_id 
                where s.TS_id =  $timesheetID";
        if(!empty($_POST['search'])){
            $sql .= " and (e.currentCode like '%". $_POST['search'] ."%' OR e.empName like '%". $_POST['search'] ."%')";	
        }
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if($result){
        // 	<td>
        // 	<input type='number' class='form-control' name='socialInsurancesText[$tsindex][$empindex]' value=".$row['socialInsurances'].">
        // </td> 
            foreach($result as $row){
                $empindex = $row['emp_id'];
                $tsindex = $row['TS_id'];
                
                $output .= "<tr>
                <td>".  $row['currentCode']. "</td>
                <td>".  $row['empName']. "</td>
                <input name='emp_id' type='hidden' value=".$row['emp_id'].">
                <input name='tsID' type='hidden' value=".$row['TS_id'].">
                <td>
                    <input type='number' class='form-control' name='specialBonusText[$tsindex][$empindex]' value=".$row['specialBonus'].">
                </td> 

                <td>
                    <input type='number' class='form-control' name='otherDuesText[$tsindex][$empindex]' value=".$row['otherDues'].">
                </td>
                </tr>";
            }
        }
     //}//else{
    // 	$output = "
    // 	<tr>
    // 	<td colspan='13' class='alert alert-warning'> 
    // 	<strong>لا يوجد حصر أيام الحضور بهذا التاريخ.. </strong>
    // 	</td></tr>";
    // }

    
    echo $output;
}
//---------------get sanctions for insertion---------------------------
function getSanctions(){
    $output ="";
    if(isset($_POST['dateFrom'])){
        $date = $_POST['dateFrom'];
    }	
    $con = connect();

    //-------------------------------------------------------------
    $sql = "select ID
            from timesheets
            where sheetDate= '".$_POST['dateFrom']."'";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $timesheetID = $stmt->fetchColumn();
    if(!$timesheetID){

    
        // if no timesheet date insert new one
        $insertSql = "insert into timesheets(sheetDate)values('".$_POST['dateFrom']."') ";
        $stmt = $con->prepare($insertSql);
        $stmt->execute();
        $getlastTSID_sql = "select max(ID) from timesheets";
        
        $stmt = $con->prepare($getlastTSID_sql);
        $stmt->execute();
        $timesheetID = $stmt->fetchColumn();
        // $insertTimesheetinSalary = "insert into salary(TS_id)values('$timesheetID')";
        //---------------timesheet ID INSERTION in salary table---------------------
        $sql="select ID from employee";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        
        foreach ($result as $row) {

            $sql = "insert into salary(TS_id,emp_id) 
                    values ($timesheetID,". $row['ID'].")";
        //	echo $sql;
            $stmt = $con->prepare($sql);
            $stmt->execute();

            //}
            //  print "}\n";
        }
    }
    //there is timesheet with this date
    //check salary table
    $sql = "select  e.empName,e.currentCode,e.ID,e.currentSalary
                    from	employee e";
    if(!empty($_POST['search'])){

        $sql .= " where (e.currentCode between '".$_POST['search']."' and '".$_POST['searchTo'] ."')
                    or e.currentCode like '%". $_POST['search'] ."%'";	

    }
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    foreach($result as $row){
        $empindex = $row['ID'];
        //".$row['TS_ID']."][".$row['ID']."
        $tsindex = $timesheetID;
        $output .= "<tr>
        <td>".  $row['currentCode']. "</td>
        <td>".  $row['empName']. "</td>
        <td class='currentSalary'>".  $row['currentSalary']. "</td>
        
        <input name='emp_id' type='hidden' value=".$row['ID'].">
        <input name='tsID' type='hidden' value=".$timesheetID.">";
        $sql2= "select s.sanctionDays,s.sanctionAmount,s.sanctionNotes,s.employee_id,s.TS_id
            
                from  sanctions s
                where s.TS_id =  $timesheetID and s.employee_id = $empindex";
        $stmt = $con->prepare($sql2);
        $stmt->execute();
        $result2 = $stmt->fetchAll();
        if($result2){
            foreach($result2 as $row2){
                $output .= "<td>
                <input  class='form-control sanctionDays' name='sanctionsDaysText[$tsindex][$empindex]' value=".$row2['sanctionDays'].">
                </td> 

                <td>
                    <input  class='form-control sanctionAmount' name='sanctionsAmountText[$tsindex][$empindex]' value=".$row2['sanctionAmount'].">
                </td>
                <td>
                    <input type='text' class='form-control sanctionNotes' name='sanctionsNotesText[$tsindex][$empindex]'  value=".$row2['sanctionNotes'].">
                </td>
                
                </tr>";
            }
            
        }else{
            $output .= "<td>
                <input  class='form-control sanctionDays' name='sanctionsDaysText[$tsindex][$empindex]'>
            </td> 

            <td>
                <input  class='form-control sanctionAmount' name='sanctionsAmountText[$tsindex][$empindex]' >
            </td>
            <td>
                <input type='text' class='form-control sanctionNotes' name='sanctionsNotesText[$tsindex][$empindex]' >
            </td>
            
            </tr>";
        }
    }
    echo $output;
    
}
//---------------calculate benefits of salary------------------
function calculateSalary24(){
    $con = connect();		
    $getTimesheet_Id_sql = "select ID from timesheets where sheetDate = '" . $_POST['searchDateFrom'] ."'";	
    $stmt = $con->prepare($getTimesheet_Id_sql);
    $stmt->execute();
    $timesheetID = $stmt->fetchcolumn();
	
    if ($timesheetID) {
        $sql ="select e.ID,e.currentSalary,e.currentWorkAllowanceNature,ms.social_insurance,e.currentSyndicate,
                        ms.med_insurance,l.incentivePercent,j.specialization_amount,j.experience_amount,
                        e.currentRepresentation,empt.TS_id as timesheetID, empt.manufacturing_days,empt.casual_days,empt.absence_days,empt.deduction_days,
                        empt.presence_days,IfNull(es.total, 0) as shiftcash,IfNull(eov.overnight_deserveddays, 0) as overnight_days,
                        IfNull(esk.real_sickLeaves, 0) as sickLeave_days,empt.evaluationPercent
                from   employee e left join maritalStatus ms on e.currentMS = ms.ID
                left join level l on e.currentLevel = l.ID
                left join job j on  e.currentJob = j.ID
                left join empTimesheet empt on e.ID = empt.emp_id and empt.TS_id = $timesheetID
                left join emp_shift es on e.Id = es.emp_id and es.TS_id = $timesheetID
                left join emp_overnight eov on e.Id = eov.emp_id and eov.TS_id = $timesheetID
                left join emp_sickLeaves esk on e.Id = esk.emp_id and esk.TS_id = $timesheetID";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        //$stmt->execute(array($_POST["searchDateFrom"]));
        $result = $stmt->fetchAll();
        foreach ($result as $row) {
            //get days from timesheet;
            $currentDays = ($row['presence_days'])/30; // عدد أيام الحضور/30
            $attendancePay = $row['currentSalary'] * $currentDays;//اجر الحضور
            $natureOfworkAllowance =$row['currentWorkAllowanceNature'] * $currentDays; // بدل طبيعة
            $socialAid = $row['social_insurance'] ; //م.اجتماعية
            $representation = $row['currentRepresentation']; // تمثيل
            $occupationalAllowance = $row['currentSyndicate']; // بدل مهنى
            $manufacturingAllowance = 8 * (22- $row['manufacturing_days']); // بدل تصنيع
            $experience = ($currentDays) * $row['experience_amount']; // خبرة
            $overnightShift = $row['overnight_days'] * ($row['currentSalary']/30) ; // نوباتجية
            $labordayGrant = (10) *  $currentDays ; // منحة عيد العمال
            $tiffinAllowance = (15) *  $row['presence_days'] ; // وجبات نقدية

            // for incentive check casual days and sick leaves
            /*sickleaves :
            if sickleaves<=10 ,therefore deduction will be all days value
            if>10 deduct 0.25 *days values
            */
            $incentive_days =($currentDays - $row['casual_days'] - $row['sickLeave_days']) * $row['evaluationPercent'] ;
            $incentive = $row['currentSalary'] * $row['incentivePercent'] * 0.75 * ($incentive_days);//الحافز
            //$additionalincentive = $row['currentSalary'] * $row['incentivePercent'] * 0.5;//حافز اضافى
            $additionalincentive = $incentive *0.5;// wrong needs to be edited !
            $total_incentive = $incentive + $additionalincentive;
            $shift = $row['shiftcash']; // وردية
            //check sick leaves and abscence and deduction
            if ($row['sickLeave_days'] >= 10 || $row['absence_days'] >=10 || $row['deduction_days']>=10) {
                $specializationAllowance = 0;
            } else {
                $specializationAllowance = $currentDays * ($row['specialization_amount']+ ($row['currentSalary']/4)) ; // بدل تخصص
            }
            $specialBonus = 0; // علاوات خاصة
            $otherDues = 0; // استحقاق
            // $totalbenefits =$attendancePay+$natureOfworkAllowance+$socialAid+$representation+$occupationalAllowance+
            // $manufacturingAllowance+$experience+$overnightShift+$labordayGrant+$labordayGrant+$tiffinAllowance+
            // $total_incentive+$shift+$specializationAllowance+$specialBonus+$otherDues+$additionalincentive ; // اجمالى الاستحقاق
            
            
            // $getdeductions_sql = "select pastPeriod+perimiumCard+familyHealthInsurance+otherDeduction+petroleumSyndicate+
            // sanctions+mobil+loan+empServiceFund+socialInsurances+etisalatNet
            // from salary where emp_id =".$row['ID']." and TS_id = ".$row['timesheetID']." ";
            // $getdeductions_stmt = $con->prepare($getdeductions_sql);
            // $getdeductions_stmt->execute();
            // $totalDeductionsresult = $getdeductions_stmt->fetchColumn();
            //echo $totalDeductionsresult ;
            //------------deductions calculations---------------------
            //$sanction_days = 0;
            //$pastPeriod = 0;//مدة سابقة
            //$perimiumCard = 0 ;
            $familyHealthInsurance = $row['med_insurance']  ; //علاج اسر
            //$otherDeduction = 0; // استقطاع اخر
            $petroleumSyndicate= 10; // ن.بترول
            //$sanctions = ($row['currentSalary']/30) * $sanction_days; // جزاءات
            //$mobil = 0; // نوباتجية
            // $loan = 0; //قرض
            $empServiceFund = 20; // صندوق خدمات عاملين
            $socialInsurances = 0;//تأمينات
            //$etisalatNet =  0;
            // $totalDeductions = $pastPeriod+$perimiumCard+$familyHealthInsurance+$otherDeduction+$petroleumSyndicate+
            // $sanctions+$mobil+$loan+$empServiceFund+$socialInsurances+$etisalatNet; // اجمالى الاستقطاع

            //$netsalary=$totalbenefits-$totalDeductions;
            //-----------insert into salary table----------------
            // $sql2 ="insert into salary(emp_id,TS_id,attendancePay,natureOfworkAllowance,socialAid,representation,occupationalAllowance,
            // 		experience,overnightShift,labordayGrant,tiffinAllowance,incentive,specializationAllowance,
            // 		pastPeriod,perimiumCard,familyHealthInsurance,otherDeduction,petroleumSyndicate,sanctions,
            // 		mobil,loan,empServiceFund,socialInsurances,etisalatNet,totalBenefits,totalDeductions)
            // 		values(".$row['ID'].",".$row['timesheetID'].",".$attendancePay.",".$natureOfworkAllowance.",".$natureOfworkAllowance.",".$representation.",".$occupationalAllowance.",
            // 		".$experience.",".$overnightShift.",".$labordayGrant.",".$tiffinAllowance.",".$incentive.",".$specializationAllowance.",
            // 		".$pastPeriod.",".$perimiumCard.",".$familyHealthInsurance.",".$otherDeduction.",".$petroleumSyndicate.",
            // 		".$sanctions.",".$mobil.",".$loan.",".$empServiceFund.",".$socialInsurances.",".$etisalatNet.",".$totalbenefits.",
            // 		".$totalDeductions.")";
            $sql2 = "UPDATE salary 
                    SET attendancePay = $attendancePay,
                    natureOfworkAllowance = $natureOfworkAllowance,
                    socialAid = $socialAid,
                    representation = $representation,
                    occupationalAllowance = $occupationalAllowance,
                    experience = $experience,
                    overnightShift =$overnightShift,
                    labordayGrant =$labordayGrant,
                    tiffinAllowance =$tiffinAllowance,
                    incentive =$incentive,
                    additionalIncentive =$additionalincentive,
                    totalincentive =  $incentive + $additionalincentive,
                    specializationAllowance =$specializationAllowance,
                    manufacturingAllowance =$manufacturingAllowance,
                    familyHealthInsurance =$familyHealthInsurance,
                    petroleumSyndicate =$petroleumSyndicate,
                    empServiceFund = $empServiceFund,
                    socialInsurances =$socialInsurances

                    WHERE TS_id = ".$row['timesheetID']."
                    and emp_id =".$row['ID']. "" ;

            $stmt = $con->prepare($sql2);
            $stmt->execute();
        }
    }
}

//---------------insert deductions--------------------------------------------------------------------
function insertDeductions(){
    $con = connect();
    //get deduction type ID to complete insertion in case of upload 
    $getDeductionID = "select d.deductionTypeID from deductiontypes d where d.deductionType = 'string'";
    $stmt = $con->prepare($getDeductionID);
    $stmt->execute();
    $DeductionID=$stmt->fetchColumn();

    //upload from excel sheet



}
//----------------upload deductions--------------------
function uploadDeductions(){ //all deductions page
    //--------second option through upload--------------------
    $con = connect();
    $TS_ID = getTimesheetID($con);
    echo $TS_ID ;
    checkForTSID_inSalary($con);
    if(checkForTSID_inSalary($con)){ //true then update rows in salary
        if(isset($_POST['upload_deductionsexcel'])){
            //check if date was choosen
            if(! empty($_POST['searchDateFrom']) && is_uploaded_file($_FILES['result_file']['tmp_name'])){
                $editDate =$_POST['searchDateFrom'];
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
                        // $worksheet = $spreadsheet->setActiveSheetIndex(0);
                        // $highestRow = $worksheet->getHighestRow();
                        $data = $spreadsheet->getActiveSheet()->toArray();
                        $count = count($data);
                        // echo $count;
                        $sql="";
                        for($row =1; $row <2; $row ++){
                            for($i=0;$i<19;$i++){
                                print_r($data[$row][$i]);

                            }
                        }
                        for($row =1; $row < $count ; $row ++){
                            
                            if ($data[$row][0]) {
                                $getEmpID_sql ="select id from employee where currentCode = " . $data[$row][0] ."";
                                $stmt = $con->prepare($getEmpID_sql);
                                // echo $getEmpID_sql;
                                $stmt->execute();
                                $empID = $stmt->fetchColumn();
                            }                    
                            if($empID){
                                //`pastPeriod`, `perimiumCard`, `familyHealthInsurance`, `otherDeduction`, `
                                // petroleumSyndicate`, `sanctions`, `mobil`, `loan`, `empServiceFund`, `socialInsurances`, `etisalatNet`
                                $totalDeductions = 0;
                                for ($i=2; $i < 18; $i++) { 
                                    $totalDeductions += $data[$row][$i];
                                }
                                
                                // $deductions= "($empID,'$TS_ID','" .$data[$row][3]."','" .$data[$row][4]."','" .$data[$row][5]."',
                                // " .$data[$row][7]."," .$data[$row][11]."," .$data[$row][12]."," .$data[$row][13]."),";
                                // $sql.=  $deductions;

                                $updateWithdeductions = "UPDATE salary 
                                SET pastPeriod =" .$data[$row][2].",
                                    perimiumCard =" .$data[$row][3].",
                                    familyHealthInsurance =" .$data[$row][4].",
                                    otherDeduction =" .$data[$row][5].", 
                                    petroleumSyndicate =" .$data[$row][6].",
                                    sanctions =" .$data[$row][7].",
                                    mobil =" .$data[$row][8].",
                                    zamala =" .$data[$row][9].",
                                    empServiceFund =" .$data[$row][10].",
                                    socialInsurances =" .$data[$row][11].",
                                    supplementaryPension =" .$data[$row][12].",
                                    tax =" .$data[$row][13].",
                                    etisalatNet =" .$data[$row][14].",
                                    omra =" .$data[$row][15].",
                                    cairoBank =" .$data[$row][16].",
                                    vodafone =" .$data[$row][17].",
                                    totalDeductions =". $totalDeductions."
                                where emp_id= $empID
                                and TS_id =$TS_ID";
                            }
                            $statement = $con->prepare($updateWithdeductions);
                            $statement->execute();
                       
                        }
                        // INSERT INTO `salary`(`TS_id`, `emp_id`, `salaryDescription`, `attendancePay`, `natureOfworkAllowance`, `socialAid`,
                        //  `representation`, `occupationalAllowance`, `experience`, `specialBonus`, `overnightShift`, 
                        // `laborDayGrant`, `tiffinAllowance`, `incentive`, `shift`, `specializationAllowance`, `manufacturingAllowance`, 
                        // `otherDues`, `additionalIncentive`, `pastPeriod`, `perimiumCard`, `familyHealthInsurance`, `otherDeduction`, `
                        // petroleumSyndicate`, `sanctions`, `mobil`, `loan`, `empServiceFund`, `socialInsurances`, `etisalatNet`, 
                        // `totalBenefits`, `totalDeductions`, `netSalary`) 
                        // $insertDeduction_sql = "INSERT INTO salary(emp_id,) 
                        //                         VALUES ". trim($sql,",");
                        
                     
                         //echo $insertDeligation_sql;
                        //  $statement = $con->prepare($insertDeduction_sql);
                        //  $statement->execute();
                         $message = '<div class="alert alert-success">Data Imported Successfully</div>';
    
                    }else{
                        $message = '<div class="alert alert-danger">Only .xls .csv or .xlsx file allowed</div>';
                    }
                }else{
                    $message = '<div class="alert alert-danger">Please Select File</div>';
                }
    
                echo json_encode($message) ;
            }else{
                $message =   '<div class="alert alert-danger">you have to select date and choose file</div>';
                // echo "you have to select date and choose file";
            }
    
        }

    }
    
    else{
        $message = "no timesheet found";
    }
    echo $message;
}
//-------------update deductions----------------------

function updateDeductions(){

    $otherDeductionText = $_POST['otherDeductionText'];
    $mobilText = isset($_POST['mobilText'])? $_POST['mobilText']:'';
    $etisalatNetText = isset($_POST['etisalatNetText'])? $_POST['etisalatNetText']:'';
    $perimiumCardText = isset($_POST['perimiumCardText'])? $_POST['perimiumCardText']:'';
    $pastPeriodText = isset($_POST['pastPeriodText'])? $_POST['pastPeriodText']:'';
    //print_r($otherDeductionText) ;
    $con = connect();
    //------------OTHER DEDUCTIONS INSERTION---------------------
    if (isset($_POST['otherDeductionText'])) {
        //echo "hi";
        foreach ($otherDeductionText as $timesheetkey => $otherDeductionvalueArray) {
            foreach ($otherDeductionvalueArray as $emp => $deduction) {

                $sql = "UPDATE salary 
                    SET otherDeduction ='$deduction' 
                    where emp_id= '$emp'
                    and TS_id ='$timesheetkey' ";
                //echo $sql;
                $stmt = $con->prepare($sql);
                $stmt->execute();
            }
        }
    }
    //------------SOCIAL INSURANCES INSERTION----------------
    // if (isset($_POST['socialInsurancesText'])) {
    // 	echo "hi";
    //     foreach ($socialInsurancesText as $timesheetkey => $socialInsurancesvalueArray) {
    //         foreach ($socialInsurancesText as $emp => $socialInsurances) {

    // 			$sql = "UPDATE salary 
    // 				SET socialInsurances ='$socialInsurances' 
    // 				where emp_id= '$emp'
    // 				and TS_id ='$timesheetkey' ";
    // 			echo $sql;
    // 			$stmt = $con->prepare($sql);
    // 			$stmt->execute();
    //         }
    //     }
    // }
    //------------MOBIL INSERTION-----------------------------
    if(isset($_POST['mobilText'])){
        foreach($mobilText as $timesheetkey => $mobilvalueArray) {
            foreach($mobilvalueArray as $emp => $mobil){
                $sql = "UPDATE salary 
                        SET mobil ='$mobil' 
                        where emp_id= '$emp'
                        and TS_id ='$timesheetkey' ";
                        
                $stmt = $con->prepare($sql);
                $stmt->execute();
            }
        }
    }

    //------------etisalatNet INSERTION-----------------------
    if(isset($_POST['etisalatNetText'])){
        foreach($etisalatNetText as $timesheetkey => $etisalatNetvalueArray) {
            foreach($etisalatNetvalueArray as $emp => $etisalatNet){
                $sql = "UPDATE salary 
                        SET etisalatNet ='$etisalatNet' 
                        where emp_id= '$emp'
                        and TS_id ='$timesheetkey' ";
                //echo $sql;
                $stmt = $con->prepare($sql);
                $stmt->execute();
            }
        }
    }

    //------------perimiumCard INSERTION----------------------
    if(isset($_POST['perimiumCardText'])){
        foreach($perimiumCardText as $timesheetkey => $perimiumCardvalueArray) {
            foreach($perimiumCardvalueArray as $emp => $perimiumCard){
                $sql = "UPDATE salary 
                        SET perimiumCard ='$perimiumCard' 
                        where emp_id= '$emp'
                        and TS_id ='$timesheetkey' ";
                $stmt = $con->prepare($sql);
                $stmt->execute();
            }
        }
    }
    //------------pasrPeriod INSERTION----------------------
    if(isset($_POST['pastPeriodText'])){
        foreach($pastPeriodText as $timesheetkey => $pastPeriodvalueArray) {
            foreach($pastPeriodvalueArray as $emp => $pastPeriod){
                $sql = "UPDATE salary 
                        SET pastPeriod ='$pastPeriod' 
                        where emp_id= '$emp'
                        and TS_id ='$timesheetkey' ";
                $stmt = $con->prepare($sql);
                $stmt->execute();
            }
        }
    }

    
}
//-------------update Benefits----------------------
function updateBenefits(){

    $specialBonusText = $_POST['specialBonusText'];
    $otherDuesText = isset($_POST['otherDuesText'])? $_POST['otherDuesText']:'';

    //print_r($specialBonusText) ;
    $con = connect();
    //------------special bonus INSERTION---------------------
    if (isset($_POST['specialBonusText'])) {
        //echo "hi";
        foreach ($specialBonusText as $timesheetkey => $specialBonusvalueArray) {
            foreach ($specialBonusvalueArray as $emp => $bonus) {

                $sql = "UPDATE salary 
                    SET specialBonus ='$bonus' 
                    where emp_id= '$emp'
                    and TS_id ='$timesheetkey' ";
                //echo $sql;
                $stmt = $con->prepare($sql);
                $stmt->execute();
            }
        }
    }
    //------------other dues INSERTION----------------------
    if(isset($_POST['otherDuesText'])){
        foreach($otherDuesText as $timesheetkey => $otherDuesvalueArray) {
            foreach($otherDuesvalueArray as $emp => $otherDues){
                $sql = "UPDATE salary 
                        SET otherDues ='$otherDues' 
                        where emp_id= '$emp'
                        and TS_id ='$timesheetkey' ";
                $stmt = $con->prepare($sql);
                $stmt->execute();
            }
        }
    }

    
}

//-------------UPDATE SANCTIONS----------------------
function insertSanctions(){
    //$sanctionDate =$_POST['searchDateFrom'];
    $con = connect();
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    
    //---------------SANCTIONS INSERTION---------------------
      if (isset($_POST['sanctionsDaysText'])) {
         
        foreach ($_POST['sanctionsDaysText'] as $TSID => $values) {
            //print "$TSID {\n";
            foreach ($values as $empKey => $sanctionDays) {
                if($sanctionDays){
                    //print "    $empKey => $sanctionDays\n";
                    $Amount = $_POST['sanctionsAmountText'][$TSID][$empKey];
                    $notes = $_POST['sanctionsNotesText'][$TSID][$empKey];
                    //echo $notes;
                    //check wether there is sanction already to update
                    $checkvalues_sql = "select sanctionAmount from sanctions where TS_id = $TSID and employee_id = $empKey";
                    
                    $checkvalues_stmt = $con->prepare($checkvalues_sql);
                    $checkvalues_stmt->execute();
                    $result=$checkvalues_stmt->fetchAll();
                    if($result){
                        $sql = "UPDATE sanctions 
                                SET sanctionDays =$sanctionDays,
                                sanctionAmount = $Amount,
                                sanctionNotes = '$notes'
                                WHERE TS_id = $TSID 
                                and employee_id = $empKey ";
                                echo $sql;
                        $updateSalarywithSanctions = "UPDATE salary 
                                SET sanctions = $Amount
                                WHERE TS_id = $TSID 
                                and emp_id = $empKey ";
                    }else{
                        $sql = "insert into sanctions values ('$TSID','$empKey','$sanctionDays','$Amount','$notes')";
                        echo $sql;
                        $updateSalarywithSanctions = "UPDATE salary 
                                SET sanctions = $Amount
                                WHERE TS_id = $TSID 
                                and emp_id = $empKey ";
                    }
                    $stmt = $con->prepare($sql);
                    $stmt->execute();
                    $updateSalary_stmt = $con->prepare($updateSalarywithSanctions);
                    $updateSalary_stmt->execute();
                
                }
            }
            //print "}\n";
        }
    }else{ echo "nothing set";}
}

//---------get totals of benefits and deductions and netsalary-------
function getWagesTotals(){
    $output="";
    $con = connect();
    if(isset($_POST['dateFrom'])){
        $date = $_POST['dateFrom'];
    }elseif(isset($_POST['searchDateFrom'])){
        $date = $_POST['searchDateFrom'];
    }	
    $sql = "select  e.empName,e.currentCode,s.totalBenefits,s.totalDeductions,s.netSalary,
                    s.emp_id,s.TS_id,ts.sheetDate
            from    employee e inner join salary s on e.ID = s.emp_id 
                    inner join timesheets ts 	on   s.TS_id =ts.ID
            where month(ts.sheetDate) = month( '$date')
               and year(ts.sheetDate) = year( '$date')";
            // echo $sql;
    if(!empty($_POST['search'])){
        $sql .= " and (e.currentCode like '%". $_POST['search'] ."%' OR e.empName like '%". $_POST['search'] ."%')";	
    }
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    if(! $result ){
        $output = "
        <tr>
        <td colspan='6' class='alert alert-warning'> 
        <strong>لا يوجد حصر أيام الحضور بهذا التاريخ!</strong>
        </td></tr>";
    }else{
        foreach($result as $row){
            $output .= 
            "<tr>
                <input name='emp_id' type='hidden' value=".$row['emp_id'].">
                <input name='TS_id' type='hidden' value=".$row['TS_id'].">
                <td>".  $row['currentCode']. "</td>
                <td>".  $row['empName']. "</td>
                <td>".  $row['totalBenefits']. "</td>
                <td>".  $row['totalDeductions']. "</td>
                <td>".  $row['netSalary']. "</td>
                <td>
                    <button type='button' class='btn btn-primary btn-sm wagesDetailsBtn' data-toggle='modal' 
                    data-target='#WagesDetailsModal' id=".$row['TS_id'] . $row['emp_id'].">
                    <i class='fa fa-info fa-lg' aria-hidden='true'></i>
                    </button>
                </td>
            </tr>";
        }
    }

    echo $output;
}
//----------get wage details-----------------------------
function viewWagesDetails(){
    $con = connect();
    $output="";
    $sql = "select s.*,e.currentCode ,e.empName,empt.presence_days,t.sheetDate
            from employee e inner join  salary s on e.Id = s.emp_id  inner join empTimesheet empt 
                            on s.emp_id = empt.emp_id and s.TS_id = empt.TS_id
                            inner join timesheets t on empt.TS_id = t.ID
            where s.TS_id ='".$_POST['wagesDetailssheetID']."'
                AND s.emp_id ='".$_POST['wagesDetailsEmpID'] ."' ";
    //echo $sql;
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    if($result){
        foreach($result as $row){
            // 	<div class='mailtitle'>
            // 	<div><img src='images/amoc2.png' align='left'
            // 			style='max-width:100% ;'></div>
            // 	<div id='mailcompany'>
            // 		<h3>شركة الاسكندرية للزيوت المعدنية(أموك)</h3>
            // 		<h3>الادارة العامة للشئون المالية</h3>
            // 		<h4>قسيمة صرف مرتب</h4>
            // 	</div>
            // </div>
            $output = "
    
                <table class='mailTable'>
                    <tr>
                        <th colspan='2'>رقم القيد </th>
                        <th colspan='3'>الاســــــم</th>
                        <th colspan='2'>التاريخ</th>
                        <th colspan='2'>عدد الايام</th>
                    </tr>
                    <tr>
                        <td colspan='2'>".$row['currentCode']."</td>
                        <td colspan='3'>".$row['empName']."</td>
                        <td colspan='2'>".$row['sheetDate']."</td>
                        <td colspan='2'>".$row['presence_days']."</td>
                    </tr>
                    <tr>
                        <th colspan='8'>الاستحقاقات</th>
                        <th style='background-color:#3c3c3db7'>الرصيد</th>
                    </tr>
                    <tr>
                        
                        <td class='mailsubHeader'>المرتب</td>
                        <td class='mailsubHeader'>أجر الحضور</td>
                        <td class='mailsubHeader'>بدل طبيعة</td>
                        <td class='mailsubHeader'>م.أجتماعيه</td>
                        <td class='mailsubHeader'>حافز علمين</td>
                        <td class='mailsubHeader'>تمثيل</td>
                        <td class='mailsubHeader'>بدل مهنى</td>
                        <td class='mailsubHeader'>خبرة</td>
                        <td></td>
                    </tr>
    
                    <tr>
                        <td>".$row['empName']."</td>
                        <td>".$row['attendancePay']."</td>
                        <td>".$row['natureOfworkAllowance']."</td>
                        <td>".$row['socialAid']."</td>
                        <td></td>
                        <td>".$row['representation']."</td>
                        <td>".$row['occupationalAllowance']."</td>
                        <td>".$row['experience']."</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class='mailsubHeader'>علاوات خاصه</td>
                        <td class='mailsubHeader'>نوباتجية</td>
                        <td class='mailsubHeader'>منحة عيد العمال</td>
                        <td class='mailsubHeader'>وجبات نقدية</td>
                        <td class='mailsubHeader'>الحافز</td>
                        <td class='mailsubHeader'>وردية</td>
                        <td class='mailsubHeader'>بدل تخصص</td>
                        <td class='mailsubHeader'>بدل تصنيع</td>
                        <td></td>
                    </tr>
                    <tr>
                        
                        <td>".$row['specialBonus']."</td>
                        <td>".$row['overnightShift']."</td>
                        <td>".$row['laborDayGrant']."</td>
                        <td>".$row['tiffinAllowance']."</td>
                        <td>".$row['incentive']."</td>
                        <td>".$row['shift']."</td>
                        <td>".$row['specializationAllowance']."</td>
                        <td>".$row['manufacturingAllowance']."</td>
                        <td></td>
                    </tr>
    
                    <tr>
                        
                        <td class='mailsubHeader'>استحقاق</td>
                        <td class='mailsubHeader'>حافز إضافى</td>
                        <td colspan='7'></td>
                    </tr>
                    <tr>
                        
                        <td>".$row['otherDues']."</td>
                        <td>".$row['additionalIncentive']."</td>
                        <td colspan='7'></td>
                    </tr>
                    <tr class='mailtotal'>
                        
                        <td colspan='8'>اجمالى الدخل</td>
                        <td>".$row['totalBenefits']."</td>
                    </tr>
                    <tr>
                        
                        <th colspan='8'> الاستقطاعات</th>
                        <td></td>
                    </tr>
    
                    <tr>
                        
                        <td class='mailsubHeader'>مدة سابقة</td>
                        <td class='mailsubHeader'>كارت بريميوم</td>
                        <td class='mailsubHeader'>علاج الأسر</td>
                        <td class='mailsubHeader'>استقطاع أخر</td>
                        <td class='mailsubHeader'>ن.بترول</td>
                        <td class='mailsubHeader'>جزاءات</td>
                        <td class='mailsubHeader'>موبايل</td>
                        <td class='mailsubHeader'>قرض بنك NBE</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>".$row['pastPeriod']."</td>
                        <td>".$row['perimiumCard']."</td>
                        <td>".$row['familyHealthInsurance']."</td>
                        <td>".$row['otherDeduction']."</td>
                        <td>".$row['petroleumSyndicate']."</td>
                        <td>".$row['sanctions']."</td>
                        <td>".$row['mobil']."</td>
                        <td>".$row['loan']."</td>
                        <td></td>
                    </tr>
                    <tr>
                        
                        <td class='mailsubHeader'>صندوق خدمات عاملين</td>
                        <td class='mailsubHeader'>جنيهات مرحله</td>
                        <td class='mailsubHeader'>التأمينات</td>
                        <td class='mailsubHeader'>معاش تكميلى</td>
                        <td class='mailsubHeader'>الضريبة</td>
                        <td class='mailsubHeader'>اتصالات</td>
                        <td class='mailsubHeader'>الدمغة</td>
                        <td class='mailsubHeader'>بنك القاهرة</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>".$row['empServiceFund']."</td>
                        <td></td>
                        <td>".$row['socialInsurances']."</td>
                        <td></td>
                        <td></td>
                        <td>".$row['etisalatNet']."</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        
                        <th colspan='8'> الاستقطاعات من الرصيد</th>
                        <td></td>
                    </tr>
                    <tr>
                        
                        <td colspan='2' class='mailsubHeader'>بتروتريد</td>
                        <td colspan='2' class='mailsubHeader'>	سلفة مدارس 2019</td>
                        <td colspan='2' class='mailsubHeader'>إيهاب سنتر</td>
                        <td colspan='2' class='mailsubHeader'>سلف عاملين</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        
                        <td colspan='2' class='mailsubHeader'>رحلات</td>
                        <td colspan='2' class='mailsubHeader'>أدوية</td>
                        <td colspan='2' class='mailsubHeader'>سلفة اجتماعية</td>
                        <td colspan='2' class='mailsubHeader'>رحلات نصف العام</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr class='mailtotal'>
                        
                        <td colspan='8'>اجمالى الاستقطاع</td>
                        <td>".$row['totalDeductions']."</td>
                    </tr>
                    <tr class='mailtotal'>
                        
                        <td colspan='8'>صافى الدخل</td>
                        <td>".$row['netSalary']."</td>
                    </tr>
                </table>
                <div class='mailnotice'>
                    <h4>تنبيه:</h4>
                    <p>شيكات القبض المرسلة على البريد الالكتروني لا تعتبر مستند قانوني و ما هي إلا اشعار و في حالة الحاجة إلى مفردات المرتب يرجى التواصل مع الإدارة العامة للشئون المالية</p>
                </div>
                <hr>
                <div style='text-align: right;'>
                    <p>قطاع الأجور - قطاع البرامج ونظم المعلومات</p>
                </div>";
    
        }
    }else{
        $output = "data is not completed yet";
    }


    echo $output;
}

