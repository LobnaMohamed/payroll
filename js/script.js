/*global $, alert, console*/
$(document).ready(function(){

	'use strict';

	$.extend({ alert: function (message, title) {
		$("<div></div>").dialog( {
		  buttons: { "Ok": function () { $(this).dialog("close"); } },
		  close: function (event, ui) { $(this).remove(); },
		  resizable: false,
		  title: title,
		  modal: true
		}).text(message);
	  }
	  });
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
	$('#addjob').bind('change keyup',function(){
		//get dates between 2 dates
		var jobID = $('this').val();
		//console.log(dateFrom);
	   $.ajax({
		   url:'fetch.php',
		   method:"POST",
		   data: {jobID:jobID},
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
			
		   },
		   error: function(error) {
			   console.log(error);
		   }
	   });	
    });
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
				$('#empNamecurrentValue').val(data.empName);
				
				$('#empCodeEdit').val(data.currentCode);
				$('#empCodecurrentValue').val(data.currentCode);
				
				$('#genderEdit').val(data.gender);
				
				$('#desc_jobEdit').val(data.job_description);
				$('#descjobcurrentValue').val(data.currentCode);
				
				$('#educationEdit').val(data.education);
				$('#educationcurrentValue').val(data.education);
				
				$('#shiftEdit').val(data.currentShift);
				$('#syndicateEdit').val(data.syndicate_id);
				$('#syndicatecurrentValue').val(data.syndicate_id);
				

				$('#basicSalaryDate').val(data.salaryMaxDate);
				$('#basicSalaryDatecurrentValue').val(data.salaryMaxDate);
				
				$('#basicsalaryEdit').val(data.currentSalary);
				$('#basicSalarycurrentValue').val(data.currentSalary);

				$('#levelDate').val(data.levelMaxDate);
				$('#levelDatecurrentValue').val(data.levelMaxDate);
				
				$('#levelEdit').val(data.currentLevel);
				$('#levelcurrentValue').val(data.currentLevel);

				$('#contractDate').val(data.contractMaxDate);
				$('#contractDatecurrentValue').val(data.contractMaxDate);
				
				$('#contractTypeEdit').val(data.currentContract);
				$('#contractTypecurrentValue').val(data.currentContract);

				$('#jobDate').val(data.JobMaxDate);
				$('#jobDatecurrentValue').val(data.JobMaxDate);
				
				$('#jobEdit').val(data.currentJob);
				$('#jobcurrentValue').val(data.currentJob);

				
				$('#maritalstatusEdit').val(data.currentMS);
				$('#MScurrentValue').val(data.currentMS);

				$('#MSDate').val(data.MSMaxDate);
				$('#MSDatecurrentValue').val(data.MSMaxDate);
				

			},error:function(error){
				console.log(error);
			}
		});
	});

	//---------------get level data in edit modal-----------------
		
	$(document).on('click','.editLevelData', function(){
		console.log("edit level");
		var currentURL = document.location.href.match(/[^\/]+$/)[0];
		console.log("currentURL :" +currentURL );
		var level_id=$(this).attr("id");
		
		console.log(level_id);
		$.ajax({
			url:"fetch.php",
			method:"POST",
			data:{level_id:level_id},
			dataType:"json",
			success:function(data){
				console.log(data);
			
				$('#levelEdit').val(data.empLevel);
				$('#hafezpercentEdit').val(data.incentivePercent);
				
			},error:function(error){
				console.log(error);
			}
		});
	});
	//---------------get contract data in edit modal-----------------
	
	$(document).on('click','.editcontractData', function(){
		console.log("edit contract");
		var currentURL = document.location.href.match(/[^\/]+$/)[0];
		console.log("currentURL :" +currentURL );
		var contract_id=$(this).attr("id");
		
		console.log(contract_id);
		$.ajax({
			url:"fetch.php",
			method:"POST",
			data:{contract_id:contract_id},
			dataType:"json",
			success:function(data){
				console.log(data);
			
				$('#contractEdit').val(data.contractType);
				
				
			},error:function(error){
				console.log(error);
			}
		});
	});
	//---------------get MS data in edit modal-----------------

	$(document).on('click','.editmaritalstatusData', function(){
		console.log("edit ms");
		var currentURL = document.location.href.match(/[^\/]+$/)[0];
		console.log("currentURL :" +currentURL );
		var MS_id=$(this).attr("id");
		
		console.log(MS_id);
		$.ajax({
			url:"fetch.php",
			method:"POST",
			data:{MS_id:MS_id},
			dataType:"json",
			success:function(data){
				console.log(data);
			
				$('#MaritalStatusEdit').val(data.maritalStatus);
				$('#amountEdit').val(data.social_insurance);
				$('#medInsuranceEdit').val(data.med_insurance);
				
				
			},error:function(error){
				console.log(error);
			}
		});
	});
	//---------------get MS data in edit modal-----------------

	$(document).on('click','.editsyndicateData', function(){
		console.log("edit syndicates");
		var currentURL = document.location.href.match(/[^\/]+$/)[0];
		console.log("currentURL :" +currentURL );
		var syndicate_id=$(this).attr("id");
		
		console.log(syndicate_id);
		$.ajax({
			url:"fetch.php",
			method:"POST",
			data:{syndicate_id:syndicate_id},
			dataType:"json",
			success:function(data){
				console.log(data);
			
				$('#syndicateEdit').val(data.syndicate);
				$('#syndicateAmountEdit').val(data.amount);
				
				
				
			},error:function(error){
				console.log(error);
			}
		});
	});

	//---------------get job data in edit modal-----------------

	$(document).on('click','.editjobData', function(){
		console.log("edit jobs");
		var currentURL = document.location.href.match(/[^\/]+$/)[0];
		console.log("currentURL :" +currentURL );
		var job_id=$(this).attr("id");
		
		console.log(job_id);
		$.ajax({
			url:"fetch.php",
			method:"POST",
			data:{job_id:job_id},
			dataType:"json",
			success:function(data){
				console.log(data);
			
				$('#jobEdit').val(data.job);
				$('#experienceEdit').val(data.experience_amount);
				$('#specializationEdit').val(data.specialization_amount);
				$('#representationEdit').val(data.representation_amount);
				
				
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

	//--------------view emp history------------------
	$(document).on('click','.viewEmpHistory', function(){
		var employee_id=$(this).attr("id");
		//var historyDate=$(this).attr("historyDate");

		console.log(employee_id);
		$.ajax({
			url:"fetch.php",
			method:"POST",
			data:{historyEmpID:employee_id},
			dataType:"json",
			success:function(data){
				console.log(data);
				//load main data:
				$('#historyEmp_code').text(data.currentCode);
				$('#historyEmp_name').text(data.empName);
				$('#historyEmp_hireDate').text(data.hireDate);				
				$('#historyEmp_DOB').text(data.DOB);
				// $('#historyEmp_level').text(data.empLevel);
				// $('#historyEmp_job').text(data.job);
				// $('#historyEmp_syndicate').text(data.syndicate);
				// $('#historyEmp_MS').text(data.maritalStatus);
				// $('#historyEmp_contract').text(data.contractType);
				// $('#historyEmp_shift').text(data.currentShift);
				// $('#historyEmp_salary').text(data.currentSalary);

				
			},error:function(error){
				console.log(error);
			}
		});
	});
	//--------------get wages details for emp------------------
	$(document).on('click','.wagesDetailsBtn', function(){
		//var employee_id=$(this).attr("id");
		var row = $(this).closest("tr");
		var employeeID = row.find("input[name='emp_id']").val();
		var sheetID = row.find("input[name='TS_id']").val();	
		console.log(employeeID);
		console.log(sheetID);

		$.ajax({
			url:"fetch.php",
			method:"POST",
			data:{wagesDetailsEmpID:employeeID,
				  wagesDetailssheetID:sheetID},
			//dataType:"json",
			success:function(data){
				$('.modal-body').html(data);
				$("#WagesDetailsModal").modal('show');
				console.log(data);
				// $('#currentProfileEmp_code').text(data.currentCode);
				// $('#currentProfileEmp_level').text(data.empLevel);
				// $('#currentProfileEmp_job').text(data.job);
				// $('#currentProfileEmp_syndicate').text(data.syndicate);
				// $('#currentProfileEmp_name').text(data.empName);
				// $('#currentProfileEmp_MS').text(data.maritalStatus);
				// $('#currentProfileEmp_contract').text(data.contractType);
				// $('#currentProfileEmp_shift').text(data.currentShift);
				// $('#currentProfileEmp_hireDate').text(data.hireDate);				
				// $('#currentProfileEmp_DOB').text(data.DOB);
				// $('#currentProfileEmp_salary').text(data.currentSalary);
			},error:function(error){
				$('.modal-body').html(error.responseText);
				$("#WagesDetailsModal").modal('show');
				console.log(error);
			}
		});
	});
	
 
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
				}else if(currentURL == 'shiftinsertion.php'){
					//console.log(data);
					$('#timesheetbody').html(data);	 
				}else if(currentURL == 'overnightinsertion.php'){
					//console.log(data);
					$('#timesheetbody').html(data);	 
				}else if(currentURL == 'sickleavesinsertion.php'){
					//console.log(data);
					$('#timesheetbody').html(data);	 
				}
				else if(currentURL == 'wages.php'){
					
				   $('#wagesDatabody').html(data);
				   $('#salaryDescription').html(data);

				}
				else if(currentURL == 'deductions.php'){
					//console.log(data);
					$('#Deductionsbody').html(data);
 
				 }else if(currentURL == 'sanctions.php'){
					
					$('#sanctionsbody').html(data);
 
				 }else if(currentURL == 'benefitsreview.php'){
					
					$('#benefitsbody').html(data);
 
				 }else if(currentURL == 'deductionsreview.php'){
					
					$('#deductionsbody').html(data);
 
				 }else if(currentURL == 'benefits.php'){
					
					$('#benefitsbody').html(data);
 
				 }
		   },
		   error: function(error) {
			   console.log(error);
		   }
	   });	
    });
   
	$('#timesheetinsertion').on('submit',function(){
		//   e.preventDefault();
		var timesheet_date = $('#searchDateFrom').val();
		//var emp = $('#search').val();
		var currentURL = document.location.href.match(/[^\/]+$/)[0];
		console.log(currentURL);
		console.log(timesheet_date);
		$.ajax({
			url:'fetch.php',
			method:"POST",
			data: //{//timesheetDate:timesheet_date,
				   //search:emp,
				   //pageurl:currentURL
				   $('form#timesheetinsertion').serialize()
			//	}
			,
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
				var d = new Date(data.sheetDate);
				var month = d.getMonth() + 1; // Since getMonth() returns month from 0-11 not 1-12
				var year = d.getFullYear();
				var dateStr = month + " / " + year;
				$('#sheetDate').val(dateStr);
				$('#presenceDaysEdit').val(data.presence_days) ;
				$('#deductionDaysEdit').val(data.deduction_days);
				$('#absenceDaysEdit').val(data.absence_days) ;
				$('#sickLeaveDaysEdit').val(data.sickLeave_days);
				$('#manufacturingDaysEdit').val(data.manufacturing_days);
				$('#evaluationPercentEdit').val(data.manufacturing_days);

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
	//-----------search emp to add deductions from credit---------------------------- 
	$('#deductionFromCreditinsertion').on('submit',function(e){
	//	e.preventDefault();
		//get dates between 2 dates
		var value = $('#getEmpForDed').val();
		// var valueTo =  $('#searchTo').val();
		// var dateTo_value = $('#searchDateTo').val();
		// var dateFrom_value = $('#searchDateFrom').val();
		var currentURL = document.location.href.match(/[^\/]+$/)[0];
		console.log($('form#deductionFromCreditinsertion').serialize());
		$.ajax({
			url:'fetch.php',
			method:"POST",
			data: $('form#deductionFromCreditinsertion').serialize()
				// searchTo:valueTo,
				// dateFrom:dateFrom_value,
				// dateTo:dateTo_value,
				//pageurl:currentURL
			,
			// dataType:"json",
			success:function(data){
				console.log(data);
				$('#deductionFromCreditinsertion').trigger("reset");
				// if(currentURL == 'insertDedfromcredit.php'){
				// 	//console.log(data);
				// 	$('#empName').val(data);
				// }
			},
			error: function(error) {
				console.log(error);
			}
		});	
	});

	//-----------UPLOAD deductions from credit---------------------------- 
	$('#deductionFromCreditUpload').on('submit',function(e){
		//	e.preventDefault();
			//get dates between 2 dates
			//var value = $('#getEmpForDed').val();
			// var valueTo =  $('#searchTo').val();
			// var dateTo_value = $('#searchDateTo').val();
			// var dateFrom_value = $('#searchDateFrom').val();
			var currentURL = document.location.href.match(/[^\/]+$/)[0];
			console.log($('form#deductionFromCreditUpload').serialize());
			$.ajax({
				url:'fetch.php',
				method:"POST",
				data: $('form#deductionFromCreditUpload').serialize(),
					// searchTo:valueTo,
					// dateFrom:dateFrom_value,
					// dateTo:dateTo_value,
					//pageurl:currentURL
				// dataType:"json",
				success:function(data){
					console.log(data);
					$('#submitted').append("<div> file inserted</div>");
					// if(currentURL == 'insertDedfromcredit.php'){
					// 	//console.log(data);
					// 	$('#empName').val(data);
					// }
				},
				error: function(error) {
					console.log(error);
				}
			});	
	});

	//--------------get data to view Current Credit Deductions For Emp ------------------
	$(document).on('click','.editdedFromCredit', function(){
		var employee_id=$('#getEmpForDed').val();
		console.log(employee_id);
		$.ajax({
			url:"fetch.php",
			method:"POST",
			data:{editDed_EmpID:employee_id},
			dataType:"json",
			success:function(data){
				console.log(data);
				console.log(data.empCode);

				if (data.empCode != null){
					$('#currentDedEditBody').html(data.tableOutput);
					$('#empName').html(data.empName);
					$('#empCode').html(data.empCode);
				}else{
					
					$('#editdedFromCreditModal').modal('hide')

					alert("لم تقم بإختيار أى موظف..");
					
				}
			},error:function(error){
				console.log(error);
			}
		});
	});
	//--------------get data to view ended Credit Deductions For Emp ------------------
	$(document).on('click','.viewEndeddedFromCredit', function(e){
		// e.preventDefault();
		var employee_id=$('#getEmpForDed').val();
		console.log(employee_id);
		$.ajax({
			url:"fetch.php",
			method:"POST",
			data:{endedDed_EmpID:employee_id},
			dataType:"json",
			success:function(data){
				console.log(data);
				console.log(data.empCode);

				if (data.empCode != null){
					$('#endedDedEditBody').html(data.tableOutput);
					$('#empName1').html(data.empName);
					$('#empCode1').html(data.empCode);
				}else{
					
					$('#viewdedFromCreditModal').modal('hide');
					
					alert("لم تقم بإختيار أى موظف..");
					// $("<div>Test message</div>").dialog();
				}
				

			},error:function(error){
				console.log(error);
				//alert("لم تقم يإختيار موظف <span><i class='fa fa-exclamation-triangle'></i></span>");
				//$("<div>Test message</div>").dialog();
			}
		});
	});

});