jQuery(document).ready(function($) {

	/* === Adding Contacts === */
	$( document ).on( 'click', '#wpproj-add-new-contact', function(e){

		// no linky
		e.preventDefault();

		var current = $(this);
		var wrapper = $(this).parent('ul');

		remove_active_tab();
		remove_form();

		$(current).addClass('active');

		$.post( WPPROJ.ajaxurl, { action: 'get_add_contact_form' }, function ( response ){

			if ( response.success === true ){
				$(current).parents('.tab-wrapper').after(response.data);
			} else {
				$(current).parents('.tab-wrapper').after(response.data).find('.error').delay(4000).fadeOut(4000);
			}

		}, 'json' );

	});

	$( document ).on( 'click', '#stop-new-contact', function(e){

		// no linky
		e.preventDefault();

		$(this).parent('form').remove();
		remove_active_tab();

	});

	/* === Adding Companies === */
	$( document ).on( 'click', '#wpproj-add-new-company', function(e){

		// no linky
		e.preventDefault();

		var current = $(this);
		var wrapper = $(this).parent('ul');

		remove_active_tab();
		remove_form();

		$(current).addClass('active');

		$.post( WPPROJ.ajaxurl, { action: 'get_add_company_form' }, function ( response ){

			if ( response.success === true ){
				$(current).parents('.tab-wrapper').after(response.data);
			} else {
				$(current).parents('.tab-wrapper').after(response.data).find('.error').delay(4000).fadeOut(4000);
			}

		}, 'json' );

	});

	$( document ).on( 'click', '#stop-new-company', function(e){

		// no linky
		e.preventDefault();

		$(this).parent('form').remove();
		remove_active_tab();

	});

	/**
	 * Getting all our form fields
	 *
	 * @since 0.1
	 * @author SFNdesign, Curtis McHale
	 */
	$( document ).on( 'submit', '.wpproj-form', function(e){

		e.preventDefault();

		var form            = $(this);
		var formaction      = $(form).attr('action');
		var ajaxloader      = $(form).find('.ajax-loader');
		var userfeedback    = $(form).find('.user-feedback');

		var ajaxresponse    = $( '#show-contacts' ).find( 'tr:first-child' );

		$(ajaxloader).show();

		$(form).ajaxSubmit({
			data: {
				action: formaction,
				_nonce: WPPROJ.formsubmitnonce
			}, // data
			type: 'POST',
			clearForm: true,
			dataType: 'json',
			url: WPPROJ.ajaxurl,
			success: function( responseText, statusText, xhr, $form ){
				$(ajaxloader).hide();
				$( ajaxresponse ).after( responseText.data.returncontent );
				$( userfeedback ).empty().append( responseText.data.message ).addClass( 'success' ).show().delay( 4000 ).fadeOut( 4000 );
			}
		}); // ajaxSubmit

	});

	function remove_form(){
		$('.wpproj-form').remove();
	}

	function remove_active_tab(){
		$('.tab-wrapper').find('.active').removeClass('active');
	}

});