/*global $, alert, console*/
$(document).ready(function(){

	'use strict';

	//scroll down
	$("#scroll_down").click(function() {
		$('html, body').animate({
			scrollTop: $("#endOfEmpData").offset().top
		}, 2000);
		$("#scroll_down").addClass("hide");
		$("#scroll_up").removeClass("hide");
	});
	//scroll up
	$("#scroll_up").click(function() {
		$('html, body').animate({
			scrollTop: $("body").offset().top
		}, 2000);
		$("#scroll_down").removeClass("hide");
		$("#scroll_up").addClass("hide");
	});


	
	var nameError = true ,
		codeError = true,
		daterror = true;
	function checkErrors() {

		if(nameError == true || codeError == true || daterror == true){
			//console.log('there is  errors');
			// alert("name cant be less than 3");

		} else {
			//console.log('form is valid');
		}
	}

	$('#name').blur(function(){
	 	if($(this).val().length <= 3){ //show error
	 		$(this).css('border', '1px solid #F00').parent().find('.custom-alert').fadeIn(300)
	 		.end().find('.asterisx').fadeIn(50);
	 		
	 		nameError = true;

	 	}else {  //no errors
	 		
	 		$(this).css('border', '1px solid #080');
	 		$(this).parent().find('.custom-alert').fadeOut(300);
	 		$(this).parent().find('.asterisx').fadeOut(50);
	 		nameError = false;
	 	}
	 	checkErrors();
	});

	// edit employees info modal
	// $('a.edit').on('click', function() {
	//     var myModal = $('#editEmp');

	//     // now get the values from the table
	//     var firstName = $(this).closest('tr').find('td.firstName').html();
	//     var lastName = $(this).closest('tr').find('td.lastName').html();
	//     // and set them in the modal:
	//     $('.firstName', myModal).val(firstName);
	//     $('.lastNameName', myModal).val(lastName);

	//     // and finally show the modal
	//     myModal.modal({ show: true });

	//     return false;
	// });	

	//--------------get employee data in edit modal---------------
	$(document).on('click','.editEmpData', function(){
		$('.nav-tabs a[href="#tab5"]').tab('show')
		var currentURL = document.location.href.match(/[^\/]+$/)[0];
		var employee_id=$(this).attr("id");
		console.log(employee_id);
		$.ajax({
			url:"fetch.php",
			method:"POST",
			data:{empID:employee_id},
			dataType:"json",
			success:function(data){
				//console.log(data);
				$('#employee_idEdit').val(data.ID);
				$('#empNameEdit').val(data.empName);
				$('#empCodeEdit').val(data.currentCode);
				$('#genderEdit').val(data.gender);
				$('#desc_jobEdit').val(data.job_description);
				$('#levelEdit').val(data.currentLevel);
				$('#contractTypeEdit').val(data.currentContract);
				$('#jobEdit').val(data.currentJob);
				$('#syndicateEdit').val(data.syndicate_id);
				$('#maritalstatusEdit').val(data.currentMS);
				$('#basicsalaryEdit').val(data.currentSalary);
				$('#educationEdit').val(data.education);
				$('#shiftEdit').val(data.currentShift);
			},error:function(error){
				console.log(error);
			}
		});
	});
	//--------------onsubmit edit form-----------------------------
	$(document).on('submit','#editEmpForm', function(){
		alert("hi");
		//e.preventDefault();
		var $form = $('#editEmpForm');
		console.log( $( this ).serialize() );
		$.ajax({
			url:"fetch.php",
			method:"POST",
			data: $('form#editEmpForm').serialize(),
			//dataType:"json",

			success:function(data){
				console.log(data);
				$("#editEmpModal").modal('hide');	
			},
			error: function(error) {
            	alert(error);
        	}
		});		
	});

	//--------------onsubmit calculate salary form-----------------------------
	$(document).on('submit','#SalaryCalculation', function(){
		var currentURL = document.location.href.match(/[^\/]+$/)[0];
		$.ajax({
			url:"fetch.php",
			method:"POST",
			data:$('form#SalaryCalculation').serialize(),
			
			success:function(data){
				console.log(data);
				if(currentURL == 'wages.php'){
					
					$('#wagesDatabody').html(data);

				 }
			},
			error: function(error) {
				alert(error);
			}
		});	
	});
	//-----------------------------------------------------------
	// $('form#editEmpForm').each(function(){
//   $(this).data('serialized', $(this).serialize())
  //   }).on('change input', function(){
  //       $(this) .find('input:submit, button:submit').prop('disabled', $(this).serialize() == $(this).data('serialized'));
	// 	 }).find('input:submit, button:submit').prop('disabled', true);
		 

	//--------------view emp current profile------------------
	$(document).on('click','.viewcurrentEmp', function(){
		var employee_id=$(this).attr("id");
		console.log(employee_id);
		$.ajax({
			url:"fetch.php",
			method:"POST",
			data:{currentProfileEmpID:employee_id},
			dataType:"json",
			success:function(data){
				console.log(data);
				$('#currentProfileEmp_code').text(data.currentCode);
				$('#currentProfileEmp_level').text(data.empLevel);
				$('#currentProfileEmp_job').text(data.job);
				$('#currentProfileEmp_syndicate').text(data.syndicate);
				$('#currentProfileEmp_name').text(data.empName);
				$('#currentProfileEmp_MS').text(data.maritalStatus);
				$('#currentProfileEmp_contract').text(data.contractType);
				$('#currentProfileEmp_shift').text(data.currentShift);
				$('#currentProfileEmp_hireDate').text(data.hireDate);				
				$('#currentProfileEmp_DOB').text(data.DOB);
				$('#currentProfileEmp_salary').text(data.currentSalary);

				
			},error:function(error){
				console.log(error);
			}
		});
	});
	//--------------get level data in edit modal---------------
	// $(document).on('click','.editLevelData', function(){
	// });
	//--------------get contracts data in edit modal---------------
	//--------------get marital status data in edit modal---------------
	//--------------get jobs data in edit modal---------------
	//--------------get syndicates data in edit modal---------------

	
 
	//-----------search forms---------------------------- 
	$('#searchDateTo,#searchDateFrom,#searchTo,#search').bind('change keyup',function(){
		//get dates between 2 dates
		var value = $('#search').val();
		var valueTo =  $('#searchTo').val();
		var dateTo_value = $('#searchDateTo').val();
		var dateFrom_value = $('#searchDateFrom').val();
		var currentURL = document.location.href.match(/[^\/]+$/)[0];
		//console.log(dateFrom);
	   $.ajax({
		   url:'searchAjax.php',
		   method:"POST",
		   data: {search:value,
				searchTo:valueTo,
				dateFrom:dateFrom_value,
				dateTo:dateTo_value,
				pageurl:currentURL},
		   // dataType:"json",
		   success:function(data){
			  // console.log(data);

        		if(currentURL == 'empdata.php'){
				   //console.log(data);
				   $('#empDatabody').html(data);

				}
				else if(currentURL == 'timesheet.php'){
					//console.log(data);
					$('#timesheetbody').html(data);
				}
				else if(currentURL == 'timesheetinsertion.php'){
					//console.log(data);
					$('#timesheetbody').html(data);	 
				}
				else if(currentURL == 'wages.php'){
					
				   $('#wagesDatabody').html(data);

				}
				else if(currentURL == 'Deductions.php'){
					//console.log(data);
					$('#Deductionsbody').html(data);
 
				 }else if(currentURL == 'sanctions.php'){
					
					$('#sanctionsbody').html(data);
 
				 }
		   },
		   error: function(error) {
			   console.log(error);
		   }
	   });	
    });
   
	$('#timesheetinsertion').on('submit',function(){
		//  e.preventDefault();
		var timesheet_date = $('#timesheetDate').val();
		//var emp = $('#search').val();
		var currentURL = document.location.href.match(/[^\/]+$/)[0];
		console.log(currentURL);
		console.log(timesheet_date);
		$.ajax({
			url:'fetch.php',
			method:"POST",
			data: {timesheetDate:timesheet_date,
				   //search:emp,
				   pageurl:currentURL},
			// dataType:"json",
			success:function(data){
			    if(currentURL == 'timesheetinsertion.php'){
					console.log(data);
					console.log("line 309");
					$('#timesheetbody').html(data);	 
				}		
			},
			error: function(error) {
				console.log(error);
			}
		});	
	});
	//--------------get data into edit timesheet modal---------------------
	$(document).on('click','.edittimsesheetData', function(){
		var currentURL = document.location.href.match(/[^\/]+$/)[0];
		var employee_id=$(this).attr("id");
		var timesheet_id = $(this).closest('tr').find('td.timesheet_ID').html();
		console.log(timesheet_id);
		
		console.log(employee_id);
		$.ajax({
			url:"fetch.php",
			method:"POST",
			data:{editTimesheet_empID:employee_id,
				  editTimesheet_ID :timesheet_id
				 },
			dataType:"json",
			success:function(data){
				//console.log(data);
				$('#emp_id').val(data.emp_id);
				$('#sheetID').val(data.TS_id);

				$('#emp_currentCode').val(data.currentCode);
				$('#empName').val(data.empName);
				$('#sheetDate').val(data.sheetDate);
				$('#presenceDaysEdit').val(data.presence_days) ;
				$('#deductionDaysEdit').val(data.deduction_days);
				$('#absenceDaysEdit').val(data.absence_days) ;
				$('#sickLeaveDaysEdit').val(data.sickLeave_days);
				$('#manufacturingDaysEdit').val(data.manufacturing_days);
				$('#overnightDaysEdit').val(data.overnight_days) ;
				$('#shiftDaysEdit').val(data.shift_days) ;
				$('#annualDaysEdit').val(data.annual_days);
				$('#casualDaysEdit').val(data.casual_days) ;
				$('#notesEdit').val(data.notes);
			},error:function(error){
				console.log(error);
			}
		});
	});
	//--------------onsubmit edit form-----------------------------
	$(document).on('submit','#editTimesheetForm', function(){
		alert("سيتم تعديل البيانات...هل انت متأكد؟");
		//e.preventDefault();
		//var $form = $('#editTimesheetForm');
		//console.log( $( this ).serialize() );
		var $element = $(this);

		var data = $element.serialize();
		console.log(data);
		$.ajax({
			url:"fetch.php",
			method:"POST",
			data: data,
			//dataType:"json",
			success:function(data){
				console.log(data);
				console.log('success');
				
				$("#edittimsesheetModal").modal('hide');	
			},
			error: function(error) {
            	alert(error);
        	}
		});		
	});


	//-------------------submit deductions form--------------
	$(document).on('submit','#deductioninsertion', function(){
		$.ajax({
			url:"fetch.php",
			method:"POST",
			data: $('form#deductioninsertion').serialize(),
			success:function(data){
				console.log(data);
			},
			error: function(error) {
            	alert(error);
        	}
		});		
	});

	//------------------on change sanction days-----------
	$("#sanctions tbody").on("change keyup", ".sanctionDays", function(){
		var row = $(this).closest("tr");
		var empID = row.find("input[name='emp_id']").val();
		var sheetID = row.find("input[name='tsID']").val();		
		var sanctionDays = $(this).val();

		//var currentSalary = row.find("input[name='currentSalary']").val();
		var currentSalary = row.find('.currentSalary').html();
		var sanctionAmount = ((currentSalary/30)*sanctionDays).toFixed(2);	
		// row.find("input[name='sanctionsAmountText["+sheetID+"]["+empID+"]']").val(sanctionAmount);

		// row.find("input[name='sanctionsDaysText["+sheetID+"]["+empID+"]']").val(sanctionDays);
		row.find('.sanctionAmount').val(sanctionAmount);
	});
	//-------------------enable text box--------------------
	// $("#sanctions tbody").on("dblclick", ".salaryValue", function(){
	// 	$(".salaryValue").attr("readonly", false); 
	// });
	//-------------------submit sanctions form--------------
	$(document).on('submit','#sanctionsinsertion', function(){
		// e.preventDefault();
		console.log($('form#sanctionsinsertion').serialize());

		//var id =  $('input[name="emp_id"]').val();
		// $("input[name='emp_id']").each(function() {
		// 	console.log( this.value );
		//   });
		// $('form#sanctionsinsertion').each(function() {
		// 	console.log( "hi" );
		//   });
		// console.log( $('form#sanctionsinsertion').find('input[name="sanctionsDaysText[]"]').serialize());
		//console.log(id);
		//console.log(days);
		$.ajax({
			url:"fetch.php",
			method:"POST",
			data: $('form#sanctionsinsertion').serialize(),
			success:function(data){
				console.log(data);
			},
			error: function(error) {
            	alert(error);
        	}
		});		
	});

});