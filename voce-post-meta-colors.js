;(function ( $, window, document, undefined ) {

	function VoceColorPicker ( element ) {
		var colorOptions = {
			change: function(event, ui) {
				$(event.target).val(ui.color._color);
			},
			palettes: $(element).data('palettes')
		};
		$(element).wpColorPicker(colorOptions);
	}

	$(document).ready(function(){
		$('.voce-color-picker').each(function(){
			VoceColorPicker(this);
		});
	});

})( jQuery, window, document );