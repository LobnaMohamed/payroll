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
				console.log(data);
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
		//alert("hi");
		//e.preventDefault();
		var $form = $('#editEmpForm');

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
	$(document).on('click','.editLevelData', function(){
	});
	//--------------get contracts data in edit modal---------------
	//--------------get marital status data in edit modal---------------
	//--------------get jobs data in edit modal---------------
	//--------------get syndicates data in edit modal---------------













	//--------------get management data in edit modal---------------
	$(document).on('click','.editManagementData', function(){
		var management_id=$(this).attr("id");
		// console.log(management_id);
		$.ajax({
			url:"fetch_Mang.php",
			method:"POST",
			data:{managementID:management_id},
			dataType:"json",
			success:function(data){
				// console.log(data);
				$('#management_id').val(data.ID);
				$('#managementEdit').val(data.Management);
			},
			error:function(data){
				//console.log( data);
			}
		});
	});
	//--------------onsubmit edit management form-----------------------------
	$(document).on('submit','#editManagementForm', function(){
		//alert("hi");
		//e.preventDefault();
		var $form = $('#editManagementForm');

		$.ajax({
			url:"insert.php",
			method:"POST",
			data: $('form#editManagementForm').serialize(),
			//dataType:"json",

			success:function(data){
				//console.log(data);
				$("#editManagementModal").modal('hide');	
			},
			error: function(error) {
				//console.log(error);
			}
		});		
	});
	
	//--------------check in change password modal------------------
	$('#changePassModal').on('show.bs.modal', function(e) {
		//alert ("hi");
		var username = $('input[name="username"]').val();
		var password = $('input[name="password"]').val();
		//check if username or password are empty
		if(username == "" || password == ""){
			alert ("أدخل بياناتك!");
			e.preventDefault();//stop modal from showing
		}else{
		    $(e.currentTarget).find('input[name="user"]').val(username);
		    $(e.currentTarget).find('input[name="oldPass"]').val(password);
		    // on form submit
		    $('#changePassForm').on('submit', function(e){
		    	//e.preventDefault();
		    	var newPass = $.trim($(e.currentTarget).find('input[name="newpassword"]').val());
			    var confirmPass = $.trim($(e.currentTarget).find('input[name="confirmpassword"]').val());
			    if(newPass == confirmPass && newPass.length >= 7 && newPass != 1234567){
					//ajax to update password:
				    $.ajax({
				    	url:document.location.url,
						method:"POST",
						data: $('form#changePassForm').serialize(),
						success:function(data){
							 alert("تم تغيير كلمة السر بنجاح");
							 // console.log(data.result);
						},
						error: function(error) {
			            	// alert("error");
			            	// console.log(error);
			        	}
					});	
			    }else{
			    	e.preventDefault();
			    	//console.log("slidedown");
			    	$('#modalAlert').removeClass("hide");
			    	$('#changePassForm')[0].reset();
			    }
			    $('#changePassForm').on('keyup',function(){
			    	$('#modalAlert').addClass("hide");
			    });
		    });
		}
	});
 	
 	//---------------check if pass = 1234567 on login----------------

 	$('#signin').on('submit', function(e){

 		//var password = $("input[name=password]");
 		//check if pass == 1234567
 		e.preventDefault();
		$.ajax({
			url:'checkpassAjax.php',
			method:"POST",
			data: $('form#signin').serialize(),
			dataType:"json",
			success:function(data){
				//console.log(data);			
				if(data.response == "changePass"){
					alert("يجب تغيير كلمة السر!");
					$("#changePassModal").modal('show');					
				}
				if(data.response == "noouser"){
					alert ("من فضلك أدخل بيانات صحيحة");
					$( 'input[name=password]' ).val('');
					// $( '#signin' ).each(function(){
					// 	this.reset();
					// });
				}
				if(data.response == "nothing3" || data.response == "nothing"){
					 window.location.replace(data.redirect) ; 
				}
				//define it as global
				// currentActivePage = document.location.href.match(/[^\/]+$/)[0];
				// currentActivePage ;
				//$('a[href="'+currentActivePage+'"]').attr('id', 'activePage');

			},
			error: function(error) {
				//alert("error");
				//console.log(error);
			}
		});	
 	});
 
	//-----------search confirmed vacs---------------------------- 
	$('#searchDateTo,#searchDateFrom,#searchTo,#search').bind('change keyup',function(){
		//get dates between 2 dates
	   var value = $('#search').val();
	   var valueTo =  $('#searchTo').val();
		var dateTo_value = $('#searchDateTo').val();
		var dateFrom_value = $('#searchDateFrom').val();
		var currentURL = document.location.href.match(/[^\/]+$/)[0];
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
			   // console.log(data);
			   
			   if(currentURL == 'confirmed.php'){
				   //console.log(data);
				   $('#confirmedVacbody').html(data);
				   
			   }
			   else if(currentURL == 'pending.php'){
				   //console.log(data);
				   $('#pendingVacbody').html(data);
				   
			   }
			   else if(currentURL == 'empdata.php'){
				   //console.log(data);
				   $('#empDatabody').html(data);

				}
				else if(currentURL == 'myvacationstatus.php'){
				   $('#VacStatusbody').html(data);
			    }
			   else if(currentURL == 'pendingPermit.php'){
					$('#pendingPermitbody').html(data);
				}
				else if(currentURL == 'confirmedPermit.php'){
					$('#confirmedPermitbody').html(data);
				}
				else if(currentURL == 'pendingAtTopmgr.php'){
					$('#pendingVacAtTopmgrbody').html(data);
				}
			   
		   },
		   error: function(error) {
			   //console.log(error);
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