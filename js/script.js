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
	$(document).on('submit','#editEmpForm', function(e){
		alert("hi");
		e.preventDefault();
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
	$(document).on('submit','#SalaryCalculation', function(e){
		alert("hi");
		e.preventDefault();
		var $form = $('#SalaryCalculation');
		console.log( $( this ).serialize() );
		$.ajax({
			url:"fetch.php",
			method:"POST",
			data: $('form#SalaryCalculation').serialize(),
			success:function(data){
				console.log(data);	
			},
			error: function(error) {
				alert(error);
			}
		});		
	});
	//-----------------------------------------------------------
	// $('form#editEmpForm').each(function(){
  //       $(this).data('serialized', $(this).serialize())
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
		console.log(currentURL);
	   $.ajax({
		   url:'searchAjax.php',
		   method:"GET",
		   data: {search:value,
				searchTo:valueTo,
				dateFrom:dateFrom_value,
				dateTo:dateTo_value,
				pageurl:currentURL},
		   // dataType:"json",
		   success:function(data){
			   console.log(data);

        		if(currentURL == 'empdata.php'){
				   //console.log(data);
				   $('#empDatabody').html(data);

				}else if(currentURL == 'wages.php'){
					
					$('#wagesDatabody').html(data);

				}
		   },
		   error: function(error) {
			   console.log(error);
		   }
	   });	
   });
   //------------search timesheet by date----------------------------
   $('#timesheetDate,#search').bind('change keyup',function(){
			//get timesheet of specific date
		
		var timesheet_date = $('#timesheetDate').val();
		var emp = $('#search').val();
		var currentURL = document.location.href.match(/[^\/]+$/)[0];
		$.ajax({
			url:'searchAjax.php',
			method:"GET",
			data: {timesheetDate:timesheet_date,
				   search:emp,
				   pageurl:currentURL},
			// dataType:"json",
			success:function(data){
				if(currentURL == 'timesheet.php'){
					console.log(data);
					$('#timesheetbody').html(data);
				}		
			},
			error: function(error) {
				//console.log(error);
			}
		});	
	});

});