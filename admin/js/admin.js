jQuery(document).ready(function($) {

	var mediaUploader = null;

	fpdUpdateTooltip();

	/*----- MODAL ----------*/

	$('body').on('click', '.fpd-close-modal', function(evt) {
		closeModal($(this).parents('.fpd-modal-wrapper'));
		evt.preventDefault();
	});

	//Tabs in Modal
	var $modalWrapper = $('.fpd-modal-wrapper');
	$modalWrapper.find(".fpd-tabs-content").find("[id^='tab']").hide(); // Hide all content
    $modalWrapper.find(".fpd-tabs li:first").attr("id","current"); // Activate the first tab
    $modalWrapper.find(".fpd-tabs-content #tab1").fadeIn(); // Show first tab's content

    $modalWrapper.find('.fpd-tabs a').click(function(evt) {

        evt.preventDefault();

		if(jQuery().select2) {
			$modalWrapper.find('.fpd-select2').each(function() {
				jQuery(this).select2("close");
			});
		}

        if ($(this).closest("li").attr("id") == "current"){ //detection for current tab
	        return;
        }
        else{
			$modalWrapper.find(".fpd-tabs-content").find("[id^='tab']").hide(); // Hide all content
			$modalWrapper.find(".fpd-tabs li").attr("id",""); //Reset id's
			$(this).parent().attr("id","current"); // Activate this
			$('#' + $(this).attr('name')).fadeIn(); // Show content for the current tab
        }

    });


	/*----- SETTINGS ----------*/

	//hide labels tab when "use labels settings" is disabled
	$('#fpd_use_label_settings').change(function() {

		$('#radykal-nav-tab--labels').toggle($(this).is(':checked'));

	}).change();

	//bounding box control
	$('[name="bounding_box_control"]').change(function() {

		var $this = $(this),
			$tbody = $this.parents('tbody');

		$tbody.find('.custom-bb, .target-bb').hide().addClass('no-serialization');
		if(this.value != '') {
			$tbody.find('.'+$this.find(":selected").data('class')).show().removeClass('no-serialization');
		}

	});

});

var openModal = function( $modalWrapper ) {

	jQuery('body').addClass('fpd-modal-open');
	$modalWrapper.addClass('fpd-modal-visible');

};

var closeModal = function( $modalWrapper ) {

	$modalWrapper.removeClass('fpd-modal-visible');
	jQuery('body').removeClass('fpd-modal-open');
	if(jQuery().select2) {
		$modalWrapper.find('.fpd-select2').each(function() {
			jQuery(this).select2("close");
		});
	}
	fpdResetForm($modalWrapper);

};

var fpdMessage = function(text, type) {

	jQuery('.fpd-message-box').remove();

	var $messageBox = jQuery('body').append('<div class="fpd-message-box fpd-'+type+'"><p>'+text+'</p></div>').children('.fpd-message-box').hide();
	$messageBox.css('margin-left', -$messageBox.width() * 0.5).fadeIn(300);

	$messageBox.delay(6000).fadeOut(200, function() {
		jQuery(this).remove();
	});

};

var fpdUpdateTooltip = function() {

	jQuery('.fpd-admin-tooltip').each(function(i, tooltip) {

		var $tooltip = jQuery(tooltip);
		if($tooltip.hasClass('tooltipstered')) {
			$tooltip.tooltipster('reposition');
		}
		else {
			$tooltip.tooltipster({
				offsetY: 0,
				theme: '.fpd-admin-tooltip-theme'
			});
		}

	});

};

var fpdParseJson = function(file) {

	try {
	  json = JSON.parse(file);
	} catch (exception) {
	  json = null;
	}

	if(json == null) {
		fpdMessage(fpd_fancy_products_opts.noJSON, 'error');
		return false;
	}
	else {
		return json;
	}

};

var fpdFillFormWithObject = function(objectString, $form) {

	try {
		var settingsObject = JSON.parse(objectString);


		for(var prop in settingsObject) {
			if(settingsObject.hasOwnProperty(prop)) {

				var value = settingsObject[prop],
					$formElement = $form.find('[name="'+prop+'"]');


				if($formElement.is('input[type="radio"]') || $formElement.is('input[type="checkbox"]')) {
					$formElement.filter('[value="'+value+'"]').prop('checked', true);
				}
				else {
					$formElement.val(value);
				}

			}
		}
	}
	catch(e) {
	  // nothing
	}

};

var fpdResetForm = function($form) {

	$form.find('[type="text"], [type="number"], textarea, select').val('');
	$form.find('[type="checkbox"], option').removeAttr('checked').removeAttr('selected');

};

var fpdSerializeObject = function(fields) {
    var o = {};
    var a = fields.serializeArray();
    jQuery.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
			if(this.value) {
				o[this.name].push(this.value || '');
			}

        } else {
        	if(this.value) {
	        	o[this.name] = this.value || '';
        	}
        }
    });
    return o;
};

var fpdCheckTitleInput = function(title, errorMessage) {

	if(title == null) {
		return false;
	}
	else if(title.length == 0) {
		fpdMessage(errorMessage+'!', 'error');
		return false;
	}

	return title;

}

//add new product via ajax
var fpdAddProduct = function(callback) {

	var title = prompt(fpd_admin_opts.enterTitlePrompt+':', "");

	if(title == null) {
		callback(false);
		return false;
	}
	else if(title.length == 0) {
		fpdMessage(fpd_admin_opts.enterTitlePrompt+'!', 'error');
		callback(false);
		return false;
	}

	jQuery.ajax({
		url: fpd_admin_opts.adminAjaxUrl,
		data: {
			action: 'fpd_newproduct',
			_ajax_nonce: fpd_admin_opts.ajaxNonce,
			title: title
		},
		type: 'post',
		dataType: 'json',
		success: function(data) {

			if(data !== undefined || data.id !== undefined) {

				fpdMessage(data.message, data.id ? 'success' : 'error');


				if(callback !== undefined) {
					callback(data);
				}

				fpdUpdateTooltip();

			}

		}
	});

};

//add views to a product via ajax
var fpdAddViews = function(productId, views, addToLibrary, viewAdded, complete) {

	var keys = Object.keys(views),
		viewCount = 0;

	function _addView(view) {

		jQuery.ajax({
			url: fpd_admin_opts.adminAjaxUrl,
			data: {
				action: 'fpd_newview',
				_ajax_nonce: fpd_admin_opts.ajaxNonce,
				title: view.title,
				elements: JSON.stringify(view.elements),
				thumbnail: view.thumbnail,
				thumbnail_name: view.thumbnail_name ? view.thumbnail_name : view.title,
				add_images_to_library: addToLibrary ? 1 : 0,
				product_id: productId
			},
			type: 'post',
			dataType: 'json',
			success: function(data) {

				viewCount++;

				if(data !== 0) {
					if(viewAdded !== undefined) {
						viewAdded(data);
					}
				}

				if(viewCount < keys.length) {
					_addView(views[keys[viewCount]]);
				}
				else {

					if(complete !== undefined) {
						complete();
					}

					fpdUpdateTooltip();

				}

			},
			error: function() {
				complete(false);
				fpdAjaxError();
			}
		});

	}

	if(keys.length > 0) {
		_addView(views[keys[0]]);
	}
	else {
		if(complete !== undefined) {
			complete();
		}
	}

};

var fpdAjaxError = function() {

	fpdMessage(fpd_admin_opts.tryAgain, 'error');

};

var fpdBlockPanel = function($panel) {

	$panel.find('.fpd-ui-blocker').show();

};

var fpdUnblockPanel = function($panel) {

	$panel.find('.fpd-ui-blocker').hide();

};


//update the form fields
var fpdSetDesignFormFields = function(paramsInput, thumbnailInput) {

	var $designThumbnail = jQuery('#fpd-design-thumbnail'), //thumbnail img-element
		$modalWrapper = $designThumbnail.parents('.fpd-modal-wrapper:first');

	if(thumbnailInput) {
		jQuery('#fpd-set-design-thumbnail-wrapper').show();
		$designThumbnail.attr('src', thumbnailInput.val());
		thumbnailInput.val().length > 0 ? $designThumbnail.show() : $designThumbnail.hide();

	}
	else {
		jQuery('#fpd-set-design-thumbnail-wrapper').hide();
	}

	var parameter_str = paramsInput.val().length > 0 ? paramsInput.val() : 'enabled=0&x=0&y=0&z=-1&scale=1&price=0&replace=&bounding_box_control=0&boundingBoxClipping=0';

	jQuery.each(parameter_str.split('&'), function (index, elem) {
		var vals = elem.split('='),
			$targetElement = $modalWrapper.find("form [name='" + vals[0] + "']");

		if($targetElement.is(':checkbox')) {
			$targetElement.prop('checked', vals[1] == 1);
		}
		else {
			$targetElement.val(unescape(vals[1]));
		}

	});

	$modalWrapper.find('input[name="enabled"],[name="bounding_box_control"]').change();

	openModal($modalWrapper);

};