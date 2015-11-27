jQuery(document).ready(function($) {

	//****** SETTINGS

	//Select2
	if($().select2) {
		$('.radykal-select2').select2({width: 'style'});
	}


	//Ace-Editor
	if(typeof ace !== undefined) {

		$('.radykal-ace-editor').each(function(i, item) {

			var editor = ace.edit(item);
			editor.setTheme("ace/theme/chrome");
			editor.setShowPrintMargin(false);
			editor.getSession().setMode("ace/mode/css");
			editor.getSession().on('change', function(evt) {
				$(editor.container).next('textarea').val(editor.getValue());
			});

		});

	}


	//Values Group
	$('.radykal-values-group-add').click(function(evt) {

		evt.preventDefault();

		var $this = $(this),
			$tbody = $this.parents('table:first').find('tbody'),
			$inputs = $this.parents('tr:first').find('input[type="text"]').removeClass('radykal-error'),
			valid = true;

		var valid = true;
		for(var i=0; i<$inputs.length; ++i) {
			var $input = $inputs.eq(i),
				regex = new RegExp($input.data('regex'), "i");

			if(regex.test($input.val()) === false) {
				$input.addClass('radykal-error');
				valid = false;
				break;
			}
		}

		if(valid) {
			var values = [];
			$inputs.each(function(i, item) {
				values.push(item.value);
			})
			_appendValuesGroupRow($tbody, values);
		}

		_saveValuesGroup($tbody);

	});

	$('.radykal-option-type--values-group .radykal-option-value').each(function(i, item) {

		var $tbody = $(this).parent().find('tbody'),
			value = item.value;

		if(value.trim().length <= 0) {
			return false;
		}

		var values = value.split(',');

		for(var i=0; i < values.length; ++i) {
			_appendValuesGroupRow($tbody, values[i].split(':'));
		}


	});

	function _appendValuesGroupRow($tbody, values) {

		var row = '<tr>',
			prefix = '';

		for(var i=0; i<values.length; ++i) {
			if( $tbody.prev('thead').find('input').eq(i).prev('span').size() > 0) {
				prefix = $tbody.prev('thead').find('input').eq(i).prev('span').html();
			}
			row += '<td>'+prefix+'<span class="radykal-values-group-td-value">'+values[i]+'</span></td>';
		};

		row += '<td><a href="#" class="radykal-values-group-remove">&times;</a></td></tr>';
		$tbody.append(row)
		.find('tr:last .radykal-values-group-remove').click(function(evt) {

			evt.preventDefault();
			$(this).parents('tr:first').remove();
			_saveValuesGroup($tbody);

		});

	};

	function _saveValuesGroup($tbody) {

		var inputValue = '',
			$rows = $tbody.find('tr');

		$rows.each(function(i, row) {

			var $tds = $(row).children('td:not(:last)');
			$tds.each(function(j, td) {
				inputValue += $(td).children('.radykal-values-group-td-value').text();
				if(j < $tds.size()-1) {
					inputValue += ':';
				}
			});

			if(i < $rows.size()-1) {
				inputValue += ',';
			}

		});

		$tbody.parents('.radykal-option-type--values-group:first')
		.children('.radykal-option-value').val(inputValue);

	};


	//Multi Values
	$('.radykal-multi-values input[type="hidden"]').each(function() {

		var $this = $(this),
			$container = $this.parents('.radykal-multi-values'),
			unserializedFields = radykalSerializedStringToObject($this.val());

		$container.find('input[type="number"]').each(function(i, item) {
			$(item).val(unserializedFields[item.name]);
		});

	});

	$('.radykal-multi-values input[type="number"]').on('change keyup', function() {

		var $container = $(this).parents('.radykal-multi-values');
		$container.find('input[type="hidden"]').val($container.find('input[type="number"]').serialize());

	});


	//Colorpicker
	if($().wpColorPicker) {
		 $('.radykal-color-picker').wpColorPicker();
	}


	//Relations
	$('input[data-relation]').change(function() {

		var $this = $(this),
			relationObj = radykalSerializedStringToObject($this.data('relation'));

		for (var key in relationObj) {
			if (relationObj.hasOwnProperty(key)) {
				var value = Boolean(parseInt(relationObj[key]));
				if($this.is(':checkbox')) {
					value = $this.is(':checked') ? value : !value;
				}
				$('#'+key).parents('tr:first').toggle(value);
			}
		}


	}).filter(':checked, :selected, :checkbox').change();

});

function radykalResetForm($form) {

	$form.find('[type="text"], [type="number"], textarea, select').val('');
	$form.find('[type="checkbox"], option').removeAttr('checked').removeAttr('selected');

};

function radykalFillForm($form, obj) {

	if(typeof obj === 'string') {

		try {
			//object string
			obj = JSON.parse(obj);
		}
		catch(e) {
			//if parameter string (serialized with $.serialize), create object
			obj = radykalSerializedStringToObject(obj);
		}

	}

	if($form) {

		radykalResetForm($form);

		for(var prop in obj) {
			if(obj.hasOwnProperty(prop)) {

				var value = obj[prop],
					$formElement = $form.find('[name="'+prop+'"]');

				if($formElement.is('[type="radio"]') || $formElement.is('[type="checkbox"]')) {
					$formElement.filter('[value="'+value+'"]').prop('checked', true);
				}
				else if($formElement.is('select')) {

					//multi values
					if(typeof value === 'object') {
						for(var i=0; i < value.length; ++i) {
							$formElement.children('[value="'+value[i]+'"]').prop('selected', true);
						}
					}
					//single value
					else {
						$formElement.children('[value="'+value+'"]').prop('selected', true);
					}

				}
				else {
					$formElement.val(value);
				}

			}
		}

	}

};

function radykalSerializedStringToObject(str) {

	var obj = new Object();

	var fields = str.split('&');
	for(var i=0; i < fields.length; ++i) {
		var field = fields[i].split('=');
		if(field[1] !== undefined) {
			obj[field[0]] = field[1];
		}

	}

	return obj;
};