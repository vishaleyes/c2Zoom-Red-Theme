// JavaScript Document
var sigCapture = null;

$(document).ready(function(e) {
	
	
	sigCapture = new SignatureCapture( "signature" );
	
	$("#submit").click( onSubmitClick );
	$("#cancel").click( onCancelClick );
});

function onSubmitClick( event ) {
	
		//alert('here');
		//$("#feedback").html( "Sending..." );
		//sssvar email = $("#email").val();
		var sig = sigCapture.toString();
		//$.support.cors = true;
		var can = document.getElementById('signature');
		var ctx = can.getContext('2d');
			
			
			
		var img = new Image();
		img.src = can.toDataURL();
		patient_id = $("#patient_id").val();
		
		var murl = "http://php.hitechos.net/c2zoom/index.php?r=api/getsignature";
		
		
		$.ajax({
 		  type: 'POST',
		   url: murl,
		   data: "signature=" + img.src+'&patient_id='+patient_id,	
		 // data : '',
		  async:true,
		  crossDomain:true,
		  success: function (result)
		  {
			//document.body.appendChild(img);
			 
			$('#signature_img').attr('src',img.src);
			$('#imgdisplay').html('<span>Your signature uploaded successfully.</span>');
			return true;
		  },
		  error: function(e)
		  {
			  console.log(e.message);
		  }
		});
	
	
}

function onCancelClick( event ) {
	clearForm();
}

function clearForm() {
	$("#email").val( "" );
	sigCapture.clear();
	$("#feedback").html( "" );
}

function requestSuccess( data, textStatus, jqXHR ) {
	clearForm();
	$("#feedback").html( "Thank you." );
}

function requestError( jqXHR, textStatus, errorThrown ) {
	$("#feedback").html( "Error: " + errorThrown );
}

function verifyEmail() {
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test( $("#email").val() );
}

