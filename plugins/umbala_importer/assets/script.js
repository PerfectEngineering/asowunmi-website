jQuery(document).ready(function($){
	"use strict";
	
	$('.umbala-importer-wrapper .option label').bind('click', function(){
		var checkbox = $(this).find('input[type="checkbox"]');
		if( checkbox.is(':checked') ){
			$(this).addClass('selected');
		}
		else{
			$(this).removeClass('selected');
		}
		
		umbala_import_button_state();
	});
	
	function umbala_import_button_state(){
		var disabled = true;
		$('.umbala-importer-wrapper .option input[type="checkbox"]').each(function(){
			if( $(this).is(':checked') ){
				disabled = false;
				return;
			}
		});
		$('#umbala-import-button').attr('disabled', disabled);
	}
	
	/* Import */
	var umbala_import_percent = 0, umbala_import_percent_increase = 0, umbala_import_file = 0;
	var umbala_data_import = new Array();

	/* Full Import */
	$('#umbala-import-button-full').bind('click', function(){	
		$('.umbala-importer-wrapper .option label').unbind('click');
		$(this).attr('disabled', true);
		$(this).siblings('.importing-button').removeClass('hidden');
		$('.umbala-importer-wrapper label').addClass('hidden');
		$('#umbala-import-button').css('display','none');
		
		$('.umbala-importer-wrapper .import-result').removeClass('hidden');

			umbala_data_import.push( {'action' : 'umbala_import_theme_options', 'message' : 'Theme Options Done'} );

			umbala_data_import.push( {'action' : 'umbala_import_widget', 'message' : 'Widgets Done'} );
	
			umbala_data_import.push( {'action' : 'umbala_import_revslider', 'message' : 'Revolution Sliders Done'} );
		
			umbala_data_import.push( {'action' : 'umbala_import_content', 'message' : 'Demo Content Done'});			
		
			umbala_data_import.push( {'action' : 'umbala_import_config'} );
		
		var total_ajaxs = umbala_data_import.length;
		
		if( total_ajaxs == 0 ){
			return;
		}
		
		umbala_import_percent_increase = 100 / total_ajaxs;
		
		umbala_import_ajax();
		
	});
	/* Custom Import */
	$('#umbala-import-button').bind('click', function(){
		$('.umbala-importer-wrapper .option label').unbind('click');
		
		$(this).attr('disabled', true);
		$(this).siblings('.importing-button').removeClass('hidden');
		$('#umbala-import-button-full').addClass('hidden');
		
		$('.umbala-importer-wrapper .import-result').removeClass('hidden');
		
		var import_theme_options = $('#umbala_import_theme_options').is(':checked');
		var import_widget = $('#umbala_import_widget').is(':checked');
		var import_revslider = $('#umbala_import_revslider').is(':checked');
		var import_demo_content = $('#umbala_import_demo_content').is(':checked');
		
		if( import_theme_options ){
			umbala_data_import.push( {'action' : 'umbala_import_theme_options', 'message' : 'Theme Options Done'} );
		}
		
		if( import_widget ){
			umbala_data_import.push( {'action' : 'umbala_import_widget', 'message' : 'Widgets Done'} );
		}
		
		if( import_revslider ){
			umbala_data_import.push( {'action' : 'umbala_import_revslider', 'message' : 'Revolution Sliders Done'} );
		}

		if( import_demo_content ){			
			umbala_data_import.push( {'action' : 'umbala_import_content', 'message' : 'Demo Content Done'});			
		}
		
		if( import_demo_content ){
			umbala_data_import.push( {'action' : 'umbala_import_config'} );
		}
		
		var total_ajaxs = umbala_data_import.length;
		
		if( total_ajaxs == 0 ){
			return;
		}
		
		umbala_import_percent_increase = 100 / total_ajaxs;
		
		umbala_import_ajax();
		
	});
	
	function umbala_import_ajax(){
		if( umbala_import_file == umbala_data_import.length ){
			umbala_import_message( 'Success!!!' );
			$('.umbala-importer-wrapper .fa.importing-button').hide();
			return;
		}
		$.ajax({
			type: 'POST'
			,url: ajaxurl
			,async: true
			,data: umbala_data_import[umbala_import_file]
			,complete: function(jqXHR, textStatus){
				umbala_import_percent += umbala_import_percent_increase;
				umbala_progress();
				if( umbala_data_import[umbala_import_file].message ){
					umbala_import_message( umbala_data_import[umbala_import_file].message );
				}
				umbala_import_file++;
				setTimeout(function(){
					umbala_import_ajax();
				}, 6000);
			}
		});
	}
	
	function umbala_progress(){
		if( umbala_import_percent > 100 ){
			umbala_import_percent = 100;
		}
		var progress_bar = $('.umbala-importer-wrapper .import-result .progress-bar');
		progress_bar.css({'width': Math.ceil( umbala_import_percent ) + '%'});
		progress_bar.html( Math.ceil( umbala_import_percent ) + '% Complete');
	}
	
	function umbala_import_message( message ){
		var message_wrapper = $('.umbala-importer-wrapper .messages');
		message_wrapper.append('<p>' + message + '</p>');
	}
	
});
