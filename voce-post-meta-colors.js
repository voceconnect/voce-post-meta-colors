jQuery(document).ready(function($) {
	var colorOptions = {
		change: function(event, ui) {
			$(event.target).val(ui.color._color);
		}
	};
	$('.voce-color-picker').wpColorPicker(colorOptions);
});