$(document).ready(function() { 

	$('#form_primary_insured').validate({
			
		
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            rules: {
	                insured_socialno: {
	                    required: true, 
						maxlength : 7
	                },
					insured_firstname: {
	                    required: true
						  
	                },
	                insured_lastname: {
	                    required: true
	                }
	            },

	            messages: {
	                insured_socialno: {
	                    required: "insured_socialno is required.",
						max: "Please enter maximum 7 digit."
	                },
	                insured_firstname: {
	                    required: "Firstname is required."
	                },
					insured_lastname: {
						required: "Lastname is Required."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   
	                $('.alert-danger', $('.login-form')).show();
	            },

	            highlight: function (element) { // hightlight error inputs
	                $(element)
	                    .closest('.form-group').addClass('has-error'); // set error class to the control group
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            errorPlacement: function (error, element) {
	                error.insertAfter(element.closest('.form-control'));
	            },

	            submitHandler: function (form) {
	                form.submit(); // form validation success, call ajax form submit
	            }
	        });
			
	$('#form_insurance_plan').validate({
			
		
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            rules: {
	                pri_insurance_company: {
	                    required: true 
						
	                },
					pri_insurance_phonenumber: {
	                    number: true
						  
	                },
	                sec_insurance_company: {
	                    required: true 
	                },
	                sec_insurance_phonenumber: {
	                    number: true
	                }
	            },

	            messages: {
	                pri_insurance_company: {
	                    required: "Plan name is required."
	                },
	                pri_insurance_phonenumber: {
	                    number: "Phone number is numeric field."
	                },
					sec_insurance_company: {
						required: "Secondary plan name is required."
	                },
					sec_insurance_phonenumber: {
						required: "Secondary phone number is numeric field."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   
	                $('.alert-danger', $('.login-form')).show();
	            },

	            highlight: function (element) { // hightlight error inputs
	                $(element)
	                    .closest('.form-group').addClass('has-error'); // set error class to the control group
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            errorPlacement: function (error, element) {
	                error.insertAfter(element.closest('.form-control'));
	            },

	            submitHandler: function (form) {
	                form.submit(); // form validation success, call ajax form submit
	            }
	        });
			
	
			
});