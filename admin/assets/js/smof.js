/**
 * SMOF js
 *
 * contains the core functionalities to be used
 * inside SMOF
 */

 /* var editor = ace.edit("custom_css");
 editor.setTheme("ace/theme/chrome");
 editor.getSession().setMode(""); */

jQuery.noConflict();

/** Fire up jQuery - let's dance!
 */
jQuery(document).ready(function($) {

	var codemirror_editor = CodeMirror.fromTextArea(document.getElementById("custom_css"), {
		lineNumbers: true,
		matchBrackets: true,
		styleActiveLine: true,
		lineWrapping: true,
		autoCloseBrackets: true,
		showTrailingSpace: true,
		indentUnit: 4,
		indentWithTabs: true,
		viewportMargin: Infinity,
		autofocus: true
	});

	setInterval(codemirror_editor.save, 10);

	// (un)fold options in a checkbox-group
  	jQuery('.fld').click(function() {
    	var $fold = '.f_' + this.id;
    	jQuery($fold).slideToggle('normal', "swing");
  	});

  	// Color picker
  	jQuery('.of-color').wpColorPicker();

	// hides warning if js is enabled
	jQuery('#js-warning').hide();

	// Tabify Options
	jQuery('.group').hide();

	// Get the URL parameter for tab
	function getURLParameter(name) {
	    return decodeURI(
	        (RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,''])[1]
	   );
	}

	// If the $_GET param of tab is set, use that for the tab that should be open
	if(getURLParameter('tab') != "") {
		jQuery.cookie('of_current_opt', '#' + getURLParameter('tab'), { expires: 7, path: '/' });
	}

	// Display last current tab
	if(jQuery.cookie("of_current_opt") === null) {
		jQuery('.group:first').fadeIn('fast');
		jQuery('#of-nav li:first').addClass('current');
	} else {

		var hooks = jQuery('#hooks').html();
		hooks = jQuery.parseJSON(hooks);

		jQuery.each(hooks, function(key, value) {

			if(jQuery.cookie("of_current_opt") == '#of-option-' + value) {
				jQuery('.group#of-option-' + value).fadeIn();
				jQuery('#of-nav li.' + value).addClass('current');
			}

		});

	}

	// Current Menu Class
	jQuery('#of-nav li a').click(function(evt) {
		// evt.preventDefault();

		jQuery('#of-nav li').removeClass('current');
		jQuery(this).parent().addClass('current');

		var clicked_group = jQuery(this).attr('href');

		jQuery.cookie('of_current_opt', clicked_group, { expires: 7, path: '/' });

		jQuery('.group').hide();

		jQuery(clicked_group).fadeIn('fast');
		return false;

	});

	// Expand Options
	var flip = 0;

	jQuery('#expand_options').click(function() {
		if(flip == 0) {
			flip = 1;
			jQuery('#of_container #of-nav').hide();
			jQuery('#of_container #content').width(755);
			jQuery('#of_container .group').add('#of_container .group h2').show(100);
			jQuery(this).removeClass('expand');
			jQuery(this).addClass('close');
			jQuery(this).text('Close');
		} else {
			flip = 0;
			jQuery('#of_container #of-nav').show();
			jQuery('#of_container #content').width(595);
			jQuery('#of_container .group').add('#of_container .group h2').hide(100);
			jQuery('#of_container .group:first').show();
			jQuery('#of_container #of-nav li').removeClass('current');
			jQuery('#of_container #of-nav li:first').addClass('current');
			jQuery(this).removeClass('close');
			jQuery(this).addClass('expand');
			jQuery(this).text('Expand');
		}
	});

	// Update Message popup
	jQuery.fn.center = function() {
		this.animate({"top":(jQuery(window).height() - this.height() - 200) / 2 + jQuery(window).scrollTop() + "px"}, 100);
		this.css("left", 250);
		return this;
	}


	jQuery('#of-popup-save').center();
	jQuery('#of-popup-reset').center();
	jQuery('#of-popup-fail').center();

	jQuery(window).scroll(function() {
		jQuery('#of-popup-save').center();
		jQuery('#of-popup-reset').center();
		jQuery('#of-popup-fail').center();
	});


	// Masked Inputs (images as radio buttons)
	jQuery('.of-radio-img-img').click(function() {
		jQuery(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		jQuery(this).addClass('of-radio-img-selected');
	});
	jQuery('.of-radio-img-label').hide();
	jQuery('.of-radio-img-img').show();
	jQuery('.of-radio-img-radio').hide();

	// Masked Inputs (background images as radio buttons)
	jQuery('.of-radio-tile-img').click(function() {
		jQuery(this).parent().parent().find('.of-radio-tile-img').removeClass('of-radio-tile-selected');
		jQuery(this).addClass('of-radio-tile-selected');
	});
	jQuery('.of-radio-tile-label').hide();
	jQuery('.of-radio-tile-img').show();
	jQuery('.of-radio-tile-radio').hide();

	// Style Select
	(function ($) {
		styleSelect = {
			init: function() {
			jQuery('.select_wrapper').each(function() {
				jQuery(this).prepend('<span>' + jQuery(this).find('.select option:selected').text() + '</span>');
			});
			jQuery('.select').live('change', function() {
				jQuery(this).prev('span').replaceWith('<span>' + jQuery(this).find('option:selected').text() + '</span>');
			});
			jQuery('.select').bind(jQuery.browser.msie ? 'click' : 'change', function(event) {
				jQuery(this).prev('span').replaceWith('<span>' + jQuery(this).find('option:selected').text() + '</span>');
			});
			}
		};
		jQuery(document).ready(function() {
			styleSelect.init()
		})
	})(jQuery);


	/** Aquagraphite Slider MOD */

	// Hide (Collapse) the toggle containers on load
	jQuery(".slide_body").hide();

	// Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
	jQuery(".slide_edit_button").live('click', function() {
		/*
		// display as an accordion
		jQuery(".slide_header").removeClass("active");
		jQuery(".slide_body").slideUp("fast");
		*/
		// toggle for each
		jQuery(this).parent().toggleClass("active").next().slideToggle("fast");
		return false; // Prevent the browser jump to the link anchor
	});

	// Update slide title upon typing
	function update_slider_title(e) {
		var element = e;
		if(this.timer) {
			clearTimeout(element.timer);
		}
		this.timer = setTimeout(function() {
			jQuery(element).parent().prev().find('strong').text(element.value);
		}, 100);
		return true;
	}

	jQuery('.of-slider-title').live('keyup', function() {
		update_slider_title(this);
	});


	// Remove individual slide
	jQuery('.slide_delete_button').live('click', function() {
	// event.preventDefault();
	var agree = confirm("Are you sure you wish to delete this slide?");
		if(agree) {
			var $trash = jQuery(this).parents('li');
			// $trash.slideUp('slow', function() { $trash.remove(); }); //chrome + confirm bug made slideUp not working...
			$trash.animate({
					opacity: 0.25,
					height: 0,
				}, 500, function() {
					jQuery(this).remove();
			});

			return false; // Prevent the browser jump to the link anchor
		} else {

			return false;
		}
	});

	// Add new slide
	jQuery(".slide_add_button").live('click', function() {
		var slidesContainer = jQuery(this).prev();
		var sliderId = slidesContainer.attr('id');

		var numArr = jQuery('#' + sliderId +' li').find('.order').map(function() {
			var str = this.id;
			str = str.replace(/\D/g,'');
			str = parseFloat(str);
			return str;
		}).get();

		var maxNum = Math.max.apply(Math, numArr);
		if(maxNum < 1) { maxNum = 0 };
		var newNum = maxNum + 1;

		var newSlide = '<li class="temphide"><div class="slide_header"><strong>Slide ' + newNum + '</strong><input type="hidden" class="slide of-input order" name="' + sliderId + '[' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><label>Title</label><input class="slide of-input of-slider-title" name="' + sliderId + '[' + newNum + '][title]" id="' + sliderId + '_' + newNum + '_slide_title" value=""><label>Image URL</label><input class="upload slide of-input" name="' + sliderId + '[' + newNum + '][url]" id="' + sliderId + '_' + newNum + '_slide_url" value=""><div class="upload_button_div"><span class="button media_upload_button" id="' + sliderId + '_' + newNum + '">Upload</span><span class="button remove-image hide" id="reset_' + sliderId + '_' + newNum + '" title="' + sliderId + '_' + newNum + '">Remove</span></div><div class="screenshot"></div><label>Link URL (optional)</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][link]" id="' + sliderId + '_' + newNum + '_slide_link" value=""><label>Description (optional)</label><textarea class="slide of-input" name="' + sliderId + '[' + newNum + '][description]" id="' + sliderId + '_' + newNum + '_slide_description" cols="8" rows="8"></textarea><a class="slide_delete_button" href="#">Delete</a><div class="clear"></div></div></li>';

		slidesContainer.append(newSlide);
		var nSlide = slidesContainer.find('.temphide');
		nSlide.fadeIn('fast', function() {
			jQuery(this).removeClass('temphide');
		});

		optionsframework_file_bindings(); // re-initialise upload image..

		return false; // prevent jumps, as always..
	});

	// Sort slides
	jQuery('.slider').find('ul').each(function() {
		var id = jQuery(this).attr('id');
		jQuery('#' + id).sortable({
			placeholder: "placeholder",
			opacity: 0.6,
			handle: ".slide_header",
			cancel: "a"
		});
	});


	/**	Sorter (Layout Manager) */
	jQuery('.sorter').each(function() {
		var id = jQuery(this).attr('id');
		jQuery('#'+ id).find('ul').sortable({
			items: 'li',
			placeholder: "placeholder",
			connectWith: '.sortlist_' + id,
			opacity: 0.6,
			update: function() {
				jQuery(this).find('.position').each(function() {
					var listID = jQuery(this).parent().attr('id');
					var parentID = jQuery(this).parent().parent().attr('id');
					parentID = parentID.replace(id + '_', '')
					var optionID = jQuery(this).parent().parent().parent().attr('id');
					jQuery(this).prop("name", optionID + '[' + parentID + '][' + listID + ']');
				});
			}
		});
	});


	/**	Ajax Backup & Restore MOD */
	// backup button
	jQuery('#of_backup_button').live('click', function() {

		var answer = confirm("Click OK to backup your current saved options.")

		if(answer) {

			var clickedObject = jQuery(this);
			var clickedID = jQuery(this).attr('id');

			var nonce = jQuery('#security').val();

			var data = {
				action: 'of_ajax_post_action',
				type: 'backup_options',
				security: nonce
			};

			jQuery.post(ajaxurl, data, function(response) {

				// check nonce
				if(response == -1) { // failed

					var fail_popup = jQuery('#of-popup-fail');
					fail_popup.fadeIn();
					window.setTimeout(function() {
						fail_popup.fadeOut();
					}, 2000);
				} else {
					var success_popup = jQuery('#of-popup-save');
					success_popup.fadeIn();
					window.setTimeout(function() {
						location.reload();
					}, 1000);
				}
			});
		}

		return false;
	});

	//restore button
	jQuery('#of_restore_button').live('click', function() {

		var answer = confirm("'Warning: All of your current options will be replaced with the data from your last backup! Proceed?")

		if(answer) {

			var clickedObject = jQuery(this);
			var clickedID = jQuery(this).attr('id');

			var nonce = jQuery('#security').val();

			var data = {
				action: 'of_ajax_post_action',
				type: 'restore_options',
				security: nonce
			};

			jQuery.post(ajaxurl, data, function(response) {

				//check nonce
				if(response==-1) { //failed

					var fail_popup = jQuery('#of-popup-fail');
					fail_popup.fadeIn();
					window.setTimeout(function() {
						fail_popup.fadeOut();
					}, 2000);
				}

				else {

					var success_popup = jQuery('#of-popup-save');
					success_popup.fadeIn();
					window.setTimeout(function() {
						location.reload();
					}, 1000);
				}

			});

		}

	return false;

	});

	/**	Ajax Transfer (Import/Export) Option */
	jQuery('#of_import_button').live('click', function() {

		var answer = confirm("Click OK to import options.")

		if(answer) {

			var clickedObject = jQuery(this);
			var clickedID = jQuery(this).attr('id');

			var nonce = jQuery('#security').val();

			var import_data = jQuery('#export_data').val();

			var data = {
				action: 'of_ajax_post_action',
				type: 'import_options',
				security: nonce,
				data: import_data
			};

			jQuery.post(ajaxurl, data, function(response) {
				var fail_popup = jQuery('#of-popup-fail');
				var success_popup = jQuery('#of-popup-save');

				//check nonce
				if(response==-1) { //failed
					fail_popup.fadeIn();
					window.setTimeout(function() {
						fail_popup.fadeOut();
					}, 2000);
				}
				else
				{
					success_popup.fadeIn();
					window.setTimeout(function() {
						location.reload();
					}, 1000);
				}

			});

		}

	return false;

	});

	/** AJAX Save Options */
	jQuery('#of_save').live('click',function() {

		var nonce = jQuery('#security').val();

		jQuery('.ajax-loading-img').fadeIn();

		//get serialized data from all our option fields
		var serializedReturn = jQuery('#of_form :input[name][name!="security"][name!="of_reset"]').serialize();

		jQuery('#of_form :input[type=checkbox]').each(function() {
		    if(!this.checked) {
		        serializedReturn += '&'+this.name+'=0';
		    }
		});

		var data = {
			type: 'save',
			action: 'of_ajax_post_action',
			security: nonce,
			data: serializedReturn
		};

		jQuery.post(ajaxurl, data, function(response) {
			var success = jQuery('#of-popup-save');
			var fail = jQuery('#of-popup-fail');
			var loading = jQuery('.ajax-loading-img');
			loading.fadeOut();

			if(response == 1) {
				success.fadeIn();
			} else {
				fail.fadeIn();
			}

			window.setTimeout(function() {
				success.fadeOut();
				fail.fadeOut();
			}, 2000);
		});

	return false;

	});


	/* AJAX Options Reset */
	jQuery('#of_reset').click(function() {

		//confirm reset
		var answer = confirm("Click OK to reset. All settings will be lost and replaced with default settings!");

		//ajax reset
		if(answer) {

			var nonce = jQuery('#security').val();

			jQuery('.ajax-reset-loading-img').fadeIn();

			var data = {

				type: 'reset',
				action: 'of_ajax_post_action',
				security: nonce,
			};

			jQuery.post(ajaxurl, data, function(response) {
				var success = jQuery('#of-popup-reset');
				var fail = jQuery('#of-popup-fail');
				var loading = jQuery('.ajax-reset-loading-img');
				loading.fadeOut();

				if(response==1)
				{
					success.fadeIn();
					window.setTimeout(function() {
						location.reload();
					}, 1000);
				}
				else
				{
					fail.fadeIn();
					window.setTimeout(function() {
						fail.fadeOut();
					}, 2000);
				}


			});

		}

	return false;

	});


	/**	Tipsy @since v1.3 */
	if(jQuery().tipsy) {
		jQuery('.tooltip, .typography-size, .typography-height, .typography-face, .typography-style, .of-typography-color').tipsy({
			fade: true,
			gravity: 's',
			opacity: 0.8,
		});
	}


	/**
	  * JQuery UI Slider function
	  * Dependencies 	 : jquery, jquery-ui-slider
	  * Feature added by : Smartik - http://smartik.ws/
	  * Date 			 : 03.17.2013
	  */
	jQuery('.smof_sliderui').each(function() {

		var obj   = jQuery(this);
		var sId   = "#" + obj.data('id');
		var val   = parseInt(obj.data('val'));
		var min   = parseInt(obj.data('min'));
		var max   = parseInt(obj.data('max'));
		var step  = parseInt(obj.data('step'));

		//slider init
		obj.slider({
			value: val,
			min: min,
			max: max,
			step: step,
			range: "min",
			slide: function(event, ui) {
				jQuery(sId).val(ui.value);
			}
		});

	});


	/**
	  * Switch
	  * Dependencies 	 : jquery
	  * Feature added by : Smartik - http://smartik.ws/
	  * Date 			 : 03.17.2013
	  */
	jQuery(".cb-enable").click(function() {
		var parent = jQuery(this).parents('.switch-options');
		jQuery('.cb-disable',parent).removeClass('selected');
		jQuery(this).addClass('selected');
		jQuery('.main_checkbox',parent).attr('checked', true);

		//fold/unfold related options
		var obj = jQuery(this);
		var $fold='.f_'+obj.data('id');
		jQuery($fold).slideDown('normal', "swing");
	});
	jQuery(".cb-disable").click(function() {
		var parent = jQuery(this).parents('.switch-options');
		jQuery('.cb-enable',parent).removeClass('selected');
		jQuery(this).addClass('selected');
		jQuery('.main_checkbox',parent).attr('checked', false);

		//fold/unfold related options
		var obj = jQuery(this);
		var $fold='.f_'+obj.data('id');
		jQuery($fold).slideUp('normal', "swing");
	});
	//disable text select(for modern chrome, safari and firefox is done via CSS)
	if((jQuery.browser.msie && jQuery.browser.version < 10) || jQuery.browser.opera) {
		jQuery('.cb-enable span, .cb-disable span').find().attr('unselectable', 'on');
	}


	/**
	  * Google Fonts
	  * Dependencies 	 : google.com, jquery
	  * Feature added by : Smartik - http://smartik.ws/
	  * Date 			 : 03.17.2013
	  */
	function GoogleFontSelect(slctr, mainID) {

		var _selected = jQuery(slctr).val(); 						// get current value - selected and saved
		var _linkclass = 'style_link_'+ mainID;
		var _previewer = mainID +'_ggf_previewer';

		if(_selected) { // if var exists and isset
			jQuery('.'+ _previewer).fadeIn();
			// Check if selected is not equal with "Select a font" and execute the script.
			if(_selected !== 'none' && _selected !== 'Select a font') {
				// remove other elements crested in <head>
				jQuery('.'+ _linkclass).remove();
				// replace spaces with "+" sign
				var the_font = _selected.replace(/\s+/g, '+');
				// add reference to google font family
				jQuery('head').append('<link href="http://fonts.googleapis.com/css?family=' + the_font + '" rel="stylesheet" type="text/css" class="'+ _linkclass +'">');
				// show in the preview box the font
				jQuery('.'+ _previewer).css('font-family', _selected +', sans-serif');
			} else {
				// if selected is not a font remove style "font-family" at preview box
				jQuery('.'+ _previewer).css('font-family', '');
				jQuery('.'+ _previewer).fadeOut();
			}

		}

	}

	// init for each element
	jQuery('.google_font_select').each(function() {
		var mainID = jQuery(this).attr('id');
		GoogleFontSelect(this, mainID);
	});

	// init when value is changed
	jQuery('.google_font_select').change(function() {
		var mainID = jQuery(this).attr('id');
		GoogleFontSelect(this, mainID);
	});


	/**
	  * Media Uploader
	  * Dependencies 	 : jquery, wp media uploader
	  * Feature added by : Smartik - http://smartik.ws/
	  * Date 			 : 05.28.2013
	  */
	function optionsframework_add_file(event, selector) {

		var upload = jQuery(".uploaded-file"), frame;
		var $el = jQuery(this);

		event.preventDefault();

		// If the media frame already exists, reopen it.
		if(frame) {
			frame.open();
			return;
		}

		// Create the media frame.
		frame = wp.media({
			// Set the title of the modal.
			title: $el.data('choose'),

			// Customize the submit button.
			button: {
				// Set the text of the button.
				text: $el.data('update'),
				// Tell the button not to close the modal, since we're
				// going to refresh the page when the image is selected.
				close: false
			}
		});

		// When an image is selected, run a callback.
		frame.on('select', function() {
			// Grab the selected attachment.
			var attachment = frame.state().get('selection').first();
			frame.close();
			selector.find('.upload').val(attachment.attributes.url);
			if(attachment.attributes.type == 'image') {
				selector.find('.screenshot').empty().hide().append('<img class="of-option-image" src="' + attachment.attributes.url + '">').slideDown('fast');
			}
			selector.find('.media_upload_button').unbind();
			selector.find('.remove-image').show().removeClass('hide');//show "Remove" button
			selector.find('.of-background-properties').slideDown();
			optionsframework_file_bindings();
		});

		// Finally, open the modal.
		frame.open();
	}

	function optionsframework_remove_file(selector) {
		selector.find('.remove-image').hide().addClass('hide');//hide "Remove" button
		selector.find('.upload').val('');
		selector.find('.of-background-properties').hide();
		selector.find('.screenshot').slideUp();
		selector.find('.remove-file').unbind();
		// We don't display the upload button if .upload-notice is present
		// This means the user doesn't have the WordPress 3.5 Media Library Support
		if(jQuery('.section-upload .upload-notice').length > 0) {
			jQuery('.media_upload_button').remove();
		}
		optionsframework_file_bindings();
	}

	function optionsframework_file_bindings() {
		jQuery('.remove-image, .remove-file').on('click', function() {
			optionsframework_remove_file(jQuery(this).parents('.section-upload, .section-media, .slide_body'));
        });

        jQuery('.media_upload_button').unbind('click').click(function(event) {
        	optionsframework_add_file(event, jQuery(this).parents('.section-upload, .section-media, .slide_body'));
        });
    }

    optionsframework_file_bindings();

}); //end doc ready