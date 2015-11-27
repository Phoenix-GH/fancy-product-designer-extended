jQuery(document).ready(function($) {


	var mediaUploader = null,
		$currentOptionsInput = null,
		$modalWrapper = $('#fpd-modal-edit-options');

	//select2 box
	$('[name="design_category"]').change(function() {

		$('#fpd-designs-form').submit();

	});

	//set images from media library
	$('#fpd-manage-designs').on('click', '.fpd-add-designs', function(evt) {
		evt.preventDefault();

		if (mediaUploader) {
	        mediaUploader.open();
	        return;
	    }

	    mediaUploader = wp.media({
	        title: fpd_fancy_designs_opts.chooseDesign,
	        multiple: true
	    });

		mediaUploader.on('select', function() {

			mediaUploader.state().get('selection').each(function(item) {

				var attachment = item.toJSON();
				$('#fpd-designs-list').append('<li><img src="'+attachment.url+'" /><a href="#" class="fpd-edit-parameters"><i class="fpd-admin-icon-settings"></i></a><a href="#" class="fpd-remove-design"><i class="fpd-admin-icon-close"></i></a><input type="hidden" value="'+attachment.id+'" name="image_ids[]" /><input type="hidden" value="" name="parameters[]" /><input type="hidden" value="" name="thumbnail[]" /></li>');

			});

	    });

	    mediaUploader.open();
	});

	//change parameters of design
	$('#fpd-designs-form').on('click', '#fpd-edit-category-options, .fpd-edit-parameters', function(evt) {

		evt.preventDefault();

		var $this = $(this),
			$thumbnailInput = false;

		if($this.attr('id') == 'fpd-edit-category-options' ) {
			$currentOptionsInput = $('[name="fpd_category_options"]');
		}
		else {
			$currentOptionsInput = $this.parent().children('input[name="parameters[]"]');
			$thumbnailInput = $this.parent().children('input[name="thumbnail[]"]');
		}

		fpdSetDesignFormFields($currentOptionsInput, $thumbnailInput);

	});

	//switch background color of list items
	$('#fpd-black-white-switcher > a').click(function(evt) {

		evt.preventDefault();
		$('#fpd-designs-list li').css('backgroundColor', this.id === 'fpd-white' ? '#ffffff' : '#000000');

	});

	//make image list draggable
	$( "#fpd-designs-list" ).sortable({
		placeholder: 'fpd-sortable-placeholder'
	}).disableSelection();


	//save and close modal
	$('#fpd-modal-edit-options').on('click', '.fpd-save-modal', function(evt) {

		evt.preventDefault();

		$currentOptionsInput
		.parent().children('[name="thumbnail[]"]').val($('#fpd-design-thumbnail').attr('src'));

		$currentOptionsInput.val($modalWrapper.find('form').serialize());

		$currentOptionsInput = null;

		closeModal($modalWrapper);

	})
	.on('click', '.fpd-close-modal', function(evt) {

		evt.preventDefault();
		$currentOptionsInput = null;

	});

	//remove design
	$('#fpd-manage-designs').on('click', '.fpd-remove-design', function(evt) {

		evt.preventDefault();
		$(this).parent('li:first').remove();

	});

});