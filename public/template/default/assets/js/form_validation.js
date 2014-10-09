/* 
	Simple jquery form validation
	Will display any error messages before submitting form for processing
	
	The only "gotcha" here is that all of our forms will need to use the 
	following id -- "frm"
*/

$(document).ready(function() {

$('#frm').submit(function(){
	
	$.post($('#frm').attr('action'), $('#frm').serialize(), function( data ) {
	
		if(data.st == 0) {
		 $('#validation-error').html(data.msg);
		}
				
		if(data.st == 1) {
		  $('#validation-error').html(data.msg);

		}
				
	}, 'json');

		return true;		
   });

	
});
