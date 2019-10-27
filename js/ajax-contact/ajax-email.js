(function($) {

	$('#pm_s_first_name').focus(function(e) {
		$(this).removeClass('invalid_field');
	});
	
	$('#pm_s_last_name').focus(function(e) {
		$(this).removeClass('invalid_field');
	});
	
	$('#pm_s_email_address').focus(function(e) {
		$(this).removeClass('invalid_field');
	});
	
	$('#pm_s_message').focus(function(e) {
		$(this).removeClass('invalid_field');
	});
	
	$('#pm_s_phone_number').focus(function(e) {
		$(this).removeClass('invalid_field');
	});
	
	$('#pm-contact-form-btn').on('click', function(e) {
							
		e.preventDefault();
								
		//var $this = $(this);
		
		$('#pm-contact-form-response').html(wordpressOptionsObject.fieldValidation);
		
		// Collect data from inputs
		var reg_nonce = $('#moxie_theme_send_contact_nonce').val();
		var reg_first_name = $('#pm_s_first_name').val();
		var reg_last_name = $('#pm_s_last_name').val();
		var reg_email_address =  $('#pm_s_email_address').val();
		var reg_message =  $('#pm_s_message').val();
		var reg_phone = $('#pm_s_phone_number').val();
		var reg_recipient_email =  $('#pm_s_email_address_contact').val();
		
		/**
		 * AJAX URL where to send data 
		 * (from localize_script)
		 */
		var ajax_url = moxie_theme_register_vars.moxie_theme_ajax_url;
	
		// Data to send
		var data = {
		  action: 'send_contact_form',
		  nonce: reg_nonce,
		  first_name: reg_first_name,
		  last_name: reg_last_name,
		  email_address: reg_email_address,
		  message: reg_message,
		  phone: reg_phone,
		  recipient: reg_recipient_email
		};
		
		
		
		// Do AJAX request
		$.post( ajax_url, data, function(response) {
	
		  // If we have response
		  if(response) {
			  			  				
			if(response === 'first_name_error') {
			  
				$('#pm-contact-form-response').html(wordpressOptionsObject.contactForm1);
				$('#pm_s_first_name').addClass('invalid_field');
			  
			} else if( response === 'last_name_error' ){
				
			  	$('#pm-contact-form-response').html(wordpressOptionsObject.contactForm2);
				$('#pm_s_last_name').addClass('invalid_field');			
			  
			} else if( response === 'email_error' ){
				
			    $('#pm-contact-form-response').html(wordpressOptionsObject.contactForm3);
				$('#pm_s_email_address').addClass('invalid_field');

			} else if( response === 'message_error' ){
				
			  	$('#pm-contact-form-response').html(wordpressOptionsObject.contactForm4);
				$('#pm_s_message').addClass('invalid_field');

			}  else if( response === 'success' ){
				
			  	$('#pm-contact-form-response').html(wordpressOptionsObject.successMessage);
				$('#pm-contact-form-btn').fadeOut();
			  
			} else if( response === 'failed' ){
				
				$('#pm-contact-form-response').html(wordpressOptionsObject.failedMessage);
				$('#pm-contact-form-btn').fadeOut();
				
			} else {
			  $('.result-message').html( response );
			  $('.result-message').show();
			}
		  }
		});
		
		
	});
	
})(jQuery);